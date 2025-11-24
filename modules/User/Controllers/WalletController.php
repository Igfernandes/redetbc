<?php

namespace Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Models\Payment;
use Modules\FrontendController;
use Modules\User\Events\RequestCreditPurchase;
use Modules\User\Models\Wallet\DepositPayment;

class WalletController extends FrontendController
{
    // Mostra a carteira do usuário
    public function wallet()
    {
        // Verifica se o módulo de carteira está desativado
        if (setting_item('wallet_module_disable')) {
            return redirect(route("user.profile.index"));
        }

        $row = auth()->user(); // Obtém o usuário autenticado

        $data = [
            'row' => $row,
            'page_title' => __('Carteira'),
            'breadcrumbs' => [
                [
                    'name' => __('Carteira'),
                    'class' => 'active'
                ]
            ],
            // Lista de transações do usuário
            'transactions' => $row->transactions()->with(['payment', 'author'])->orderBy('id', 'desc')->paginate(15)
        ];

        return view('User::frontend.wallet.index', $data);
    }

    // Mostra a página de compra de créditos
    public function buy()
    {
        if (setting_item('wallet_module_disable')) {
            return redirect(route("user.profile.index"));
        }

        $row = auth()->user();

        $data = [
            'row' => $row,
            'page_title' => __("Comprar créditos"),
            'breadcrumbs' => [
                [
                    'name' => __('Carteira'),
                    'url' => route('user.wallet')
                ],
                [
                    'name' => __('Comprar créditos'),
                    'class' => 'active'
                ],
            ],
            // Lista de opções de depósito configuradas
            'wallet_deposit_lists' => setting_item_array('wallet_deposit_lists', []),
            'gateways' => get_available_gateways()
        ];

        return view('User::frontend.wallet.buy', $data);
    }

    // Processa a compra de créditos
    public function buyProcess(Request $request)
    {
        if (setting_item('wallet_module_disable')) {
            return redirect(route("user.profile.index"));
        }

        $row = auth()->user(); // usuário autenticado

        $rules = [];
        $message = [];

        // Regras de validação
        if (setting_item('wallet_deposit_type') == 'list') {
            $rules['deposit_option'] = 'required';
        } else {
            $rules['deposit_amount'] = 'required';
        }

        $payment_gateway = $request->input('payment_gateway');
        $gateways = get_payment_gateways();

        // Validação do gateway
        if (empty($payment_gateway)) {
            return redirect()->back()->with("error", __("Por favor, selecione um método de pagamento"));
        }
        if (empty($payment_gateway) or empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway])) {
            return redirect()->back()->with("error", __("Método de pagamento não encontrado"));
        }

        $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);

        if (!$gatewayObj->isAvailable()) {
            return redirect()->back()->with("error", __("Método de pagamento indisponível"));
        }

        // Regras extras do gateway
        if ($gRules = $gatewayObj->getValidationRules()) {
            $rules = array_merge($rules, $gRules);
        }
        if ($gMessages = $gatewayObj->getValidationMessages()) {
            $message = array_merge($message, $gMessages);
        }

        $rules['payment_gateway'] = 'required';
        $rules['term_conditions'] = 'required';

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            if (is_array($validator->errors()->messages())) {
                $msg = '';
                foreach ($validator->errors()->messages() as $oneMessage) {
                    $msg .= implode('<br/>', $oneMessage) . '<br/>';
                }
                return redirect()->back()->with('error', $msg);
            }
            return redirect()->back()->with('error', $validator->errors());
        }

        $deposit_option = [];

        // Valores do depósito
        if (setting_item('wallet_deposit_type') == 'list') {
            $wallet_deposit_lists = setting_item_array('wallet_deposit_lists', []);
            $deposit_option = $request->input('deposit_option');

            if (empty($wallet_deposit_lists[$deposit_option])) {
                return redirect()->back()->with("error", __("Opção de depósito inválida"));
            }
            if (empty($wallet_deposit_lists[$deposit_option]['amount'])) {
                return redirect()->back()->with("error", __("O valor do depósito é inválido"));
            }
            if (empty($wallet_deposit_lists[$deposit_option]['credit'])) {
                return redirect()->back()->with("error", __("O crédito do depósito é inválido"));
            }

            $deposit_amount = $wallet_deposit_lists[$deposit_option]['amount'];
            $deposit_credit = $wallet_deposit_lists[$deposit_option]['credit'];
            $deposit_option = $wallet_deposit_lists[$deposit_option];
        } else {
            $deposit_amount = $request->input('deposit_amount');
            $deposit_credit = $deposit_amount * setting_item('wallet_deposit_rate', 1);

            if ($deposit_amount < 0) {
                return redirect()->back()->with("error", __("O valor do depósito é inválido"));
            }
        }

        // Cria o pagamento
        $payment = new DepositPayment();
        $payment->object_model = 'wallet_deposit';
        $payment->object_id = $row->id;
        $payment->status = 'draft';
        $payment->payment_gateway = $payment_gateway;
        $payment->amount = $deposit_amount;
        $payment->save();

        // Metadados
        $payment->addMeta('credit', $deposit_credit);
        $payment->addMeta('deposit_option', $deposit_option);

        // Processa pagamento no gateway
        $res = $gatewayObj->processNormal($payment);

        $success = $res[0] ?? null;
        $message = $res[1] ?? null;
        $redirect_url = $res[2] ?? null;

        if ($success) {
            // Cria transação temporária
            $transaction = $row->draftDeposit($deposit_credit, $payment->id);
            $payment->wallet_transaction_id = $transaction->id;
            $payment->save();

            // Dispara evento de compra
            event(new RequestCreditPurchase($row, $payment));
        }

        if ($success and $payment->status == 'completed') {
            $redirect_url = route('user.wallet');
        }

        if ($redirect_url) {
            return redirect()->to($redirect_url)->with($success ? "success" : "error", $message);
        }

        return redirect()->back()->with($success ? "success" : "error", $message);
    }
}
