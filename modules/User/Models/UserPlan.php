<?php


namespace Modules\User\Models;


use App\BaseModel;
use Modules\User\Events\UpdatePlanRequest;

class UserPlan extends BaseModel
{
    protected $table  = 'bravo_user_plan';

    protected $casts = [
        'end_date' => 'datetime',
        'plan_data' => 'array'
    ];

    public function getIsValidAttribute()
    {
        if (!$this->end_date and $this->status == 1) return true;

        return $this->end_date->timestamp > time() and $this->status == 1;
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUsedAttribute()
    {
        if (!empty($this->user)) {
            return $this->user->service()->where('status', 'publish')->count('id');
        }
        return 0;
    }

    public function isValid(): int
    {
        return (int) UserPlan::where('user_id', auth()->id())
            ->where('status', 1)
            ->where(function ($query) {
                $query->where('end_date', '>=', now())
                    ->orWhereNull('end_date');
            })
            ->exists();
    }
    
    public function store(Plan $plan, array $options = [
        "status" => 1,
        "gateway_key" => null,
        "is_annuity" => 0
    ])
    {
        $user = auth()->user();

        $userPlan = new UserPlan();

        $currentPlan = UserPlan::where([
            "user_id" => $user->id,
            "status" => 0
        ])->first();

        if ($currentPlan) {
            $userPlan = $currentPlan;
        }

        $userPlan->plan_id = $plan->id;
        $userPlan->price = $options['is_annuity'] === 1 ? $plan->annual_price : $plan->price;
        $userPlan->start_date = now();
        $userPlan->end_date = now()->add($plan->duration, $plan->duration_type);
        $userPlan->max_service = $plan->max_service;
        $userPlan->checkout_session = $options['gateway_key'];
        $userPlan->user_id = $user->id;
        $userPlan->status = $options['status'];

        $userPlan->save();

        event(new UpdatePlanRequest($user));
    }
}
