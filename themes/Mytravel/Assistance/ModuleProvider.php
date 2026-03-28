<?php


namespace Themes\Mytravel\Assistance;


use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Assistance\Hook;
use Modules\Assistance\Models\Assistance;

class ModuleProvider extends ServiceProvider
{

    public function boot(){
        add_action(Hook::FORM_AFTER_MAX_PEOPLE,[$this,'assistance_extra_info']);
        add_action(Hook::AFTER_SAVING,[$this,'save_assistance_extra_info']);
    }

    public function assistance_extra_info(Assistance $assistance){
        echo view("Assistance::admin.assistance.extra_mytravel",['row'=>$assistance])->render();
    }

    public function save_assistance_extra_info(Assistance $assistance,Request $request){
        if($request->input('mytravel_save_extra'))
        {
            if(is_default_lang($request->query('lang'))) {
                $data = [
                    'date_form_to' => $request->input('date_form_to'),
                    'min_age' => $request->input('min_age'),
                    'pickup' => $request->input('pickup'),
                    'wifi_available' => $request->input('wifi_available'),
                ];
                $assistance->fillByAttr(array_keys($data), $data);
                $assistance->save();
            }
        }
    }
}
