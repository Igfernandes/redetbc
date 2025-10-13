<?php

namespace Modules\User\Traits\Network;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Payment;

trait CardsNetwork
{
    public static function getCards($user_id)
    {
        $res = [];
        $commission =  Auth::user()->commission_amount;

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
        $pendentAmount = ($pendents / $commission) - $received;

        $res[] = [
            'title'  => __("Membros Diretos"),
            'amount' => $usersLinked->count(),
            'desc'   => __("Members direct"),
            'class'  => 'purple',
            'icon'   => 'icon ion-ios-cart'
        ];
        $res[] = [
            'title'  => __("Membros Indiretos"),
            'amount' => $usersIndirectLinked->count(),
            'desc'   => __("Members Indirect"),
            'class'  => 'info',
            'icon'   => 'icon ion-ios-gift'
        ];
        $res[] = [
            'title'  => __("Saldo Pendente"),
            'amount' => format_money_main($pendentAmount < 0 ? 0 : $pendentAmount),
            'desc'   => __("Total pendents"),
            'class'  => 'info',
            'icon'   => 'icon ion-ios-gift'
        ];
        $res[] = [
            'title'  => __("Saldo Debitado"),
            'amount' => format_money_main($received ?? 0),
            'desc'   => __("Total earnings"),
            'class'  => 'info',
            'icon'   => 'icon ion-ios-gift'
        ];

        return $res;
    }
}
