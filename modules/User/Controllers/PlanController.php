<?php


namespace Modules\User\Controllers;


use App\Services\AsaasService;
use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\User\Events\CreatePlanRequest;
use Modules\User\Models\Plan;
use Modules\User\Models\PlanPayment;
use Modules\User\Models\UserPlan;

class PlanController extends FrontendController
{
    public function index()
    {

        if (!is_enable_plan()) {
            return redirect('/');
        }
        if (!auth()->check()) {
            return redirect(route('login'));
        }
        $plans = Plan::query()->where('role_id', auth()->user()->role_id)->whereStatus('publish')->get();

        $plansAnnual = \array_filter($plans->toArray(), fn($plan) => !empty($plan['annual_price']) && $plan['annual_price'] > 0);

        $data = [
            'page_title' => __('Pacotes de Preços'),
            'plans' => $plans,
            'has_annual' => \count($plansAnnual) > 0,
            'user' => auth()->user(),
        ];
        return view("User::frontend.plan.index", $data);
    }

    public function myPlan()
    {
        if (!is_enable_plan()) {
            return redirect('/');
        }
        if (!auth()->user()->user_plan) {
            return redirect(route('plan'));
        }
        $data = [
            'user' => auth()->user(),
            'page_title'       => __("Meu Plano"),
            'menu_active' => 'my_plan',
            'breadcrumbs'      => [
                [
                    'name'  => __('Meus planos'),
                    'class' => 'active'
                ]
            ]
        ];
        return view("User::frontend.plan.my-plan", $data);
    }

    public function buy(Request $request, $id)
    {
        if (!is_enable_plan()) {
            return redirect('/');
        }

        $plan = Plan::findOrFail((int) $id);

        if (!$plan) return;

        $user = auth()->user();
        $plan_page = route('plan');

        if ($user->role_id != $plan->role_id) {
            return redirect()->to($plan_page)->with("warning", __("Este plano não é adequado para sua função."));
        }
        if ($request->query('annual') and !$plan->annual_price) {
            return redirect()->to($plan_page)->with("warning", __("Este plano não tem preço anual"));
        }

        $asaas = new AsaasService();

        if ($request->input('annual') == 1) {
            $data = $asaas->checkout($plan);
        } else
            $data = $asaas->subscribe($plan);


        return \redirect()->to($data["link"] ?? $plan_page)->with("warning", __("Estamos enfrentando problemas técnicos para prosseguir com o pagamento. Por favor, tente novamente mais tarde."));
    }

 
    public function webhook(Request $request)
    {
        // Pega todo o payload enviado pelo Asaas
        $webhookData = $request->all();
        $payment = $webhookData['payment'] ?? $webhookData['subscription'];

        if (!isset($payment['checkoutSession']) || empty($payment['checkoutSession']))
            return response()->json(['status' => false]);

        $checkoutId = $payment['checkoutSession'];

        $userPlan = UserPlan::where("checkout_session", $checkoutId)->first();

        if (empty($userPlan))
            return response()->json(['status' => 'invalid']);

        $plan = $userPlan->plan;

        $planPayment = new PlanPayment();
        $savedPlan = $planPayment->where([
            "object_id" => (string)$plan->id
        ])->first();


        switch ((string)$payment['status']) {
            case "CONFIRMED":
                $userPlan->status = 1;
                $userPlan->save();
                break;
            case "ACTIVE":
                if ($plan->days_gratuity && $plan->days_gratuity > 0) {
                    $userPlan->status = 1;
                    $userPlan->save();
                }
                break;
        }

        $planPayment = !empty($savedPlan) ? $savedPlan : new PlanPayment();
        $planPayment->object_model = 'plan';
        $planPayment->meta = $payment['id'];
        $planPayment->object_id = $plan->id;
        $planPayment->status = 'publish';
        $planPayment->payment_gateway = "Asaas";
        $planPayment->amount = floatval($payment['value']);
        $planPayment->currency = "Real";
        $planPayment->user_id = $userPlan->user->id;
        $planPayment->save();

        if (isset($payment['customer']) && $userPlan->user) {
            $user = $userPlan->user;
            $user->gateway_customer_id = $payment['customer'];
            $user->save();
        }

        event(new CreatePlanRequest($user));
        \Log::info('Webhook Asaas recebido', $webhookData);
        // Opcional: retorna resposta para o Asaas
        return response()->json(['status' => 'ok']);
    }

    public function thankYou(Request $request)
    {
        return view('User::frontend.plan.thankyou');
    }
}
