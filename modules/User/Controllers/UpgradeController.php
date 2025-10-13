<?php

namespace Modules\User\Controllers;

use App\Services\AsaasService;
use Modules\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Modules\User\Models\Plan;

class UpgradeController extends FrontendController
{
    use AuthenticatesUsers;

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
        $plans = Plan::query()->where('role_id', '!=', auth()->user()->role_id)->whereStatus('publish')->get();
        $plansAnnual = \array_filter($plans->toArray(), fn($plan) => !empty($plan['annual_price']) && $plan['annual_price'] > 0);

        $data = [
            'page_title' => __('Pricing Packages'),
            'plans' => $plans,
            'has_annual' => \count($plansAnnual) > 0,
            'user' => auth()->user(),
        ];
        return view('User::frontend.upgrade.index', $data);
    }

    public function store(Request $request)
    {
        $id = $request->get("id");

        $plan = Plan::findOrFail((int) $id);
        if (!$plan)
            return redirect()->back()->with("warning", __("This plan is not available."));;

        $user = auth()->user();
        $plan_page = route('plan');

        if ($user->role_id === $plan->role_id) {
            return redirect()->to($plan_page)->with("warning", __("This plan already used by you."));
        }

        if ($request->query('annual') and !$plan->annual_price) {
            return redirect()->to($plan_page)->with("warning", __("This plan doesn't have annual pricing"));
        }

        $asaas = new AsaasService();
        $host = env('APP_URL');

        $options['callback'] =  [
            "cancelUrl" =>  "$host/user/booking-history",
            "expiredUrl" => "$host/user/upgrade",
            "successUrl" => "$host/user/upgrade"
        ];

        if (!empty($user->gateway_customer_id))
            $options['customer'] = $user->gateway_customer_id;

        if ($request->input('annual') == 1) {
            $data = $asaas->checkout($plan, $options);
        } else
            $data = $asaas->subscribe($plan, $options);

        return \redirect()->to($data["link"] ?? $plan_page)->with("warning", __("We are experiencing technical issues to proceed with the payment. Please try again later."));
    }
}
