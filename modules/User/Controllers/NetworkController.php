<?php

namespace Modules\User\Controllers;

use App\Models\User;
use App\Services\AsaasService;
use Modules\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Modules\Booking\Models\Payment;
use Modules\User\Models\PlanPayment;
use Modules\User\Models\WithdrawAccount;
use Modules\User\Traits\Network\CardsNetwork;
use Modules\User\Traits\Network\GraphicNetwork;
use Modules\User\Traits\Network\GraphicNetworkReceived;

class NetworkController extends FrontendController
{
    use AuthenticatesUsers, CardsNetwork, GraphicNetwork, GraphicNetworkReceived;

    protected $enquiryClass;
    private Booking $booking;

    public function __construct(Booking $booking, Enquiry $enquiry)
    {
        $this->enquiryClass = $enquiry;
        parent::__construct();
        $this->booking = $booking;
    }

    public function index()
    {
        $user_id = Auth::id();

        $commission = Auth::user()->commission_amount;

        $affiliates = User::where("owner_id", $user_id)
            ->get()
            ->map(function ($affiliate) use ($commission) {

                // Total gerado pelo afiliado (ex: planos)
                $generated = Payment::where([
                    'user_id' => $affiliate->id,
                    'object_model' => 'plan'
                ])->sum('amount');

                // Total já sacado referente a ele (se existir esse vínculo)
                $received = Payment::where([
                    'user_id' => $affiliate->id,
                    'object_model' => 'withdraw'
                ])->sum('amount');

                $toReceive = ($generated / $commission) - $received;

                return [
                    'id'            => $affiliate->id,
                    'name'          => $affiliate->name,
                    'email'         => $affiliate->email,
                    'started_at'    => $affiliate->created_at->format('d/m/Y'),
                    'amount'        => format_money_main($toReceive < 0 ? 0 : $toReceive),
                    'raw_amount'    => $toReceive < 0 ? 0 : $toReceive,
                ];
            });

        $data = [
            'cards_report'       => $this->getCards($user_id),
            'earning_chart_data' => $this->getUserNetworkChartData(strtotime('monday this week'), time(), $user_id),
            'page_title'         => __("Painel"),
            'withdraws' =>   Payment::where([
                "user_id" => $user_id,
                "object_model" => "withdraw"
            ])->get(),
            'breadcrumbs'        => [
                [
                    'name'  => __('Afiliado de rede'),
                    'class' => 'active'
                ]
            ],
            'affiliates' =>  $affiliates,
        ];
        return view('User::frontend.network.index', $data);
    }

    public function wallet()
    {
        $user_id = Auth::id();
        $from = strtotime(date('Y-m-01 00:00:00'));
        $to   = strtotime(date('Y-m-t 23:59:59'));

        $solicitations = PlanPayment::where([
            "object_model" => 'withdraw',
            'user_id' => $user_id
        ])->get();

        $data = [
            'cards_report'       => $this->getCards($user_id),
            'earning_chart_data' => $this->getUserWithdrawChartDataReceived($from, $to, $user_id),
            'page_title'         => __("Painel"),
            'withdrawAccount' => WithdrawAccount::where("user_id", $user_id)->first(),
            'breadcrumbs'        => [
                [
                    'name'  => __('Afiliado de rede'),
                    'class' => 'active'
                ]
            ],
            'solicitations' =>  $solicitations
        ];

        return view('User::frontend.network.wallet', $data);
    }


    // 🔄 Recarrega gráfico via AJAX (daterangepicker)
    public function reloadChart(Request $request)
    {
        $from = strtotime($request->input('from'));
        $to   = strtotime($request->input('to'));
        $user_id = auth()->id();

        $data = GraphicNetwork::getUserWithdrawChartData($from, $to, $user_id);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'owner_name' => 'required|string|max:255',
            'document' => 'required|string|max:20',
            'owner_birthdate' => 'nullable|date',
            'bank_name' => 'nullable|string|max:255',
            'agency' => 'nullable|string|max:50',
            'account' => 'nullable|string|max:50',
            'account_digit' => 'nullable|string|max:10',
            'bank_account_type' => 'nullable|string|in:CONTA_CORRENTE,CONTA_POUPANCA',
            'operation_type' => 'nullable|string|in:PIX,TED',
            'pix_address_key' => 'nullable|string|max:255',
            'pix_address_key_type' => 'nullable|string|in:CPF,CNPJ,EMAIL,PHONE,EVP',
            'description' => 'nullable|string|max:500',
        ]);

        WithdrawAccount::storeOrUpdate($data);

        return redirect()->back()->with('success', __('Dados bancários atualizados com sucesso!'));
    }

    public function request()
    {
        $user_id = auth()->id();
        $commission =  Auth::user()->commission_amount;
        $wallet =  WithdrawAccount::where("user_id", $user_id)->first();

        $usersLinked = User::where("owner_id", $user_id)->get();
        $usersLinkedIds = $usersLinked->pluck('id')->toArray();

        $usersIndirectLinked = User::whereIn("owner_id", $usersLinkedIds)->get();
        $usersIndirectLinkedIds = $usersIndirectLinked->pluck('id')->toArray();

        $payments = Payment::where([
            "user_id" => $user_id,
            "object_model" => "withdraw"
        ])->get();

        $pendents = Payment::whereIn("user_id", [...$usersLinkedIds, ...$usersIndirectLinkedIds])->where([
            "object_model" => "plan"
        ])->get()->sum('amount');

        $received = $payments->sum('amount');
        $pendentAmount = $commission > 0 && $pendents > 0 ? ($pendents / $commission) - $received  : 0;

        if ($pendentAmount <= 0)
            return back()->with('error', 'Não há saldo disponível para solicitar saque');

        $asaasService = new AsaasService();

        $response = $asaasService->transferAccount(
            value: $pendentAmount,
            wallet: $wallet,
            scheduleDate: now()->addDays(30)->format('Y-m-d'),
            description: "Saque solicitado em " . now()->format('d/m/Y')
        );


        if (isset($response['error']) && !empty($response['error'])) {
            return back()->with('error', $response['error'] ?? 'Erro ao solicitar o saque.');
        }

        return back()->with('success', 'Saque solicitado com sucesso!');
    }
}
