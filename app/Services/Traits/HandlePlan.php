<?php

namespace App\Services\Traits;

use Modules\User\Events\CreatePlanRequest;
use Modules\User\Models\PlanPayment;
use Modules\User\Models\UserPlan;

trait HandlePlan
{

    private function updatePlan(UserPlan $userPlan)
    {
        UserPlan::where("user_id", $userPlan->user_id)->whereNot("id", $userPlan->id)->delete();
        $userPlan->status = 1;
        $userPlan->save();
        $userPlan->user->role_id = $userPlan->plan->role_id;
    }

    public function plan(array $payment)
    {
        $checkoutId = $payment['checkoutSession'];

        $userPlan = UserPlan::where("checkout_session", $checkoutId)->first();

        if (empty($userPlan))
            return response()->json(['status' => 'invalid']);

        $plan = $userPlan->plan;

        $planPayment = new PlanPayment();
        $savedPlan = $planPayment->where([
            "object_id" => (string)$plan->id,
            "user_id" => $userPlan->user_id,
            "code" => $checkoutId
        ])->first();

        switch ((string)$payment['status']) {
            case "CONFIRMED":
                $this->updatePlan($userPlan);
            case "ACTIVE":
                if ($plan->days_gratuity && $plan->days_gratuity > 0) {
                    $this->updatePlan($userPlan);
                }
                break;
        }

        $planPayment = !empty($savedPlan) ? $savedPlan : new PlanPayment();
        $planPayment->object_model = 'plan';
        $planPayment->code = $checkoutId;
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
        \Log::info('Webhook Asaas recebido', $payment);
        return response()->json(['status' => 'ok']);
    }
}
