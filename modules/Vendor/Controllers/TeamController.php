<?php

namespace Modules\Vendor\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\FrontendController;
use Modules\Vendor\Events\VendorTeamRequestCreatedEvent;
use Modules\Vendor\Models\VendorTeam;

class TeamController extends FrontendController
{

    public function index(){

        $rows = auth()->user()->vendorTeams()->with('vendor')->paginate(30);
        $data = [
            'page_title'=>__("Membros da equipe"),
            'rows'=>$rows,
            'breadcrumbs'=>[
                [
                    'name'=>__("Membros da equipe")
                ]
            ]
        ];
        return view('Vendor::frontend.team.index',$data);
    }
    public function add(Request $request){
        $request->validate([
            'email'=>[
                'required',
                'email',
                Rule::exists('users','email')
            ],
            'permissions'=>'required|array'
        ]);

        $email = $request->input('email');
        $member = User::whereEmail($email)->first();
        if(!$member){
            return back()->with('danger',__("Membro não existe"));
        }

        $currentUser = auth()->user();

        if($currentUser->email == $email){
            return back()->with('danger',__("Você não pode se adicionar"));
        }

        $check = $currentUser->members()->where('member_id',$member->id)->first();
        if($check){
            return back()->with('danger',__("Solicitação existente"));
        }

        $check = new VendorTeam();
        $check->vendor_id = $currentUser->id;
        $check->member_id = $member->id;
        $check->status = setting_item('vendor_team_auto_approved') ? VendorTeam::STATUS_PUBLISH : VendorTeam::STATUS_PENDING;
        $check->permissions = $request->input('permissions',[]);
        $check->save();

        VendorTeamRequestCreatedEvent::dispatch($check);

        return back()->with('success',__("Solicitação criada"));

    }

    public function reSendRequest(Request $request,$id){
        $vendor_team = VendorTeam::find($id);
        if(!empty($vendor_team)){
            VendorTeamRequestCreatedEvent::dispatch($vendor_team);
        }
        return back()->with(['success'=>'Sent success']);
    }

    public function accept(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $vendor_team = \request()->input('vendor_team');
        if(!empty($vendor_team)){
            $vendor_team = VendorTeam::find($vendor_team);
            if(!empty($vendor_team)){
                $vendor_team->status = VendorTeam::STATUS_PUBLISH;
                $vendor_team->save();
            }
        }
        return redirect(route('home'));
    }
}