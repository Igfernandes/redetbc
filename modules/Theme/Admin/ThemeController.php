<?php

namespace Modules\Theme\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\AdminController;
use Modules\Theme\ThemeManager;

class ThemeController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu(route('theme.admin.index'));
    }

    public function index(Request $request){
        $this->checkPermission("theme_manage");
        if(Session::get('success')){
            Artisan::call('migrate', [
                '--force' => true,
            ]);
        }

        $data = [
            "rows"=>ThemeManager::all(),
            "page_title"=>__("Gerenciamento de tema")
        ];

        return view('Theme::admin.index',$data);
    }

    public function upload(Request $request){
        $this->checkPermission("theme_manage");

        $data = [
            "page_title"=>__("Upload de Tema")
        ];

        return view('Theme::admin.upload',$data);
    }


    public function activate($theme){
        if(is_demo_mode()){
            return back()->with('error',__("Desativado para modo de demonstração"));
        }
        $this->checkPermission("theme_manage");

        $content = "<?php
        define('BC_INIT_THEME','{$theme}');";

        Storage::disk('root')->put('bc.php', $content);

        return back()->with('success',__("Tema ativado"));
    }
    public function seeding($theme){

        if(is_demo_mode()){
            return back()->with('danger',__("MODO DE DEMONSTRAÇÃO: Você não tem permissão para fazer isso"));
        }

        $this->checkPermission("theme_manage");

        $provider = ThemeManager::theme($theme);

        if(class_exists($provider))
        {
            $seeder = $provider::$seeder;
            if(!class_exists($seeder)) return back()->with('error',__("Este tema não possui classe seeder"));

            $provider::runSeeder();

            return back()->with('success',__("Dados de demonstração foram importados"));

        }

        return back()->with('error',__("Não foi possível executar a importação de dados"));
    }
}