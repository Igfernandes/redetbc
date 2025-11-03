<?php
namespace Modules\Assistance;
use Modules\Assistance\Models\Assistance;
use Modules\ModuleServiceProvider;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->mergeConfigFrom(__DIR__ . '/Configs/assistance.php','assistance');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        PermissionHelper::add([
            // Assistance
            'assistance_view',
            'assistance_create',
            'assistance_update',
            'assistance_delete',
            'assistance_manage_others',
            'assistance_manage_attributes',
        ]);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if(!Assistance::isEnable()) return [];
        return [
            'assistance'=>[
                "position"=>45,
                'url'        => route('assistance.admin.index'),
                'title'      => __('Serviços'),
                'icon'       => 'ion-ios-bookmarks',
                'permission' => 'assistance_view',
                'children'   => [
                    'add'=>[
                        'url'        => route('assistance.admin.index'),
                        'title'      => __('Todos os Serviços'),
                        'permission' => 'assistance_view',
                    ],
                    'create'=>[
                        'url'        => route('assistance.admin.create'),
                        'title'      => __('Todos os Novos serviços'),
                        'permission' => 'assistance_create',
                    ],
                    'attribute'=>[
                        'url'        => route('assistance.admin.attribute.index'),
                        'title'      => __('Atributos'),
                        'permission' => 'assistance_manage_attributes',
                    ],
                    'availability'=>[
                        'url'        => route('assistance.admin.availability.index'),
                        'title'      => __('Disponibilidade'),
                        'permission' => 'assistance_create',
                    ],
                    'recovery'=>[
                        'url'        => route('assistance.admin.recovery'),
                        'title'      => __('Recuperação'),
                        'permission' => 'assistance_view',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!Assistance::isEnable()) return [];
        return [
            'assistance'=>Assistance::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if(!Assistance::isEnable()) return [];
        return [
            'assistance'=>[
                'class' => Assistance::class,
                'name'  => __("Serviços"),
                'items' => Assistance::searchForMenu(),
                'position'=>51
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if(Assistance::isEnable()){
            $res['assistance'] = [
                'url'   => route('assistance.vendor.index'),
                'title'      => __("Gerenciar serviços"),
                'icon'       => Assistance::getServiceIconFeatured(),
                'position'   => 70,
                'permission' => 'assistance_view',
                'children' => [
                    [
                        'url'   => route('assistance.vendor.index'),
                        'title'  => __("Todos os serviços"),
                    ],
                    [
                        'url'   => route('assistance.vendor.create'),
                        'title'      => __("Adicionar serviços"),
                        'permission' => 'assistance_create',
                    ],
                    [
                        'url'        => route('assistance.vendor.availability.index'),
                        'title'      => __("Disponibilidade"),
                        'permission' => 'assistance_create',
                    ],
                    [
                        'url'   => route('assistance.vendor.recovery'),
                        'title'      => __("Recuperação"),
                        'permission' => 'assistance_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!Assistance::isEnable()) return [];
        return [
            'form_search_assistance'=>"\\Modules\\Assistance\\Blocks\\FormSearchAssistance",
            'list_assistance'=>"\\Modules\\Assistance\\Blocks\\ListAssistance",
        ];
    }
}
