<?php
namespace Modules\Boat;
use Modules\Boat\Models\Boat;
use Modules\ModuleServiceProvider;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->mergeConfigFrom(__DIR__ . '/Configs/boat.php','boat');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        PermissionHelper::add([
            // Boat
            'boat_view',
            'boat_create',
            'boat_update',
            'boat_delete',
            'boat_manage_others',
            'boat_manage_attributes',
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
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>[
                "position"=>45,
                'url'        => route('boat.admin.index'),
                'title'      => __('Serviços'),
                'icon'       => 'ion-md-boat',
                'permission' => 'boat_view',
                'children'   => [
                    'add'=>[
                        'url'        => route('boat.admin.index'),
                        'title'      => __('Todos os serviços'),
                        'permission' => 'boat_view',
                    ],
                    'create'=>[
                        'url'        => route('boat.admin.create'),
                        'title'      => __('Adicionar novo barco'),
                        'permission' => 'boat_create',
                    ],
                    'attribute'=>[
                        'url'        => route('boat.admin.attribute.index'),
                        'title'      => __('Atributos'),
                        'permission' => 'boat_manage_attributes',
                    ],
                    'availability'=>[
                        'url'        => route('boat.admin.availability.index'),
                        'title'      => __('Disponibilidade'),
                        'permission' => 'boat_create',
                    ],
                    'recovery'=>[
                        'url'        => route('boat.admin.recovery'),
                        'title'      => __('Recuperação'),
                        'permission' => 'boat_view',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>Boat::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>[
                'class' => Boat::class,
                'name'  => __("Barco"),
                'items' => Boat::searchForMenu(),
                'position'=>51
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if(Boat::isEnable()){
            $res['boat'] = [
                'url'   => route('boat.vendor.index'),
                'title'      => __("Gerenciar barco"),
                'icon'       => Boat::getServiceIconFeatured(),
                'position'   => 70,
                'permission' => 'boat_view',
                'children' => [
                    [
                        'url'   => route('boat.vendor.index'),
                        'title'  => __("Todos os barcos"),
                    ],
                    [
                        'url'   => route('boat.vendor.create'),
                        'title'      => __("Adicionar barco"),
                        'permission' => 'boat_create',
                    ],
                    [
                        'url'        => route('boat.vendor.availability.index'),
                        'title'      => __("Disponibilidade"),
                        'permission' => 'boat_create',
                    ],
                    [
                        'url'   => route('boat.vendor.recovery'),
                        'title'      => __("Recuperação"),
                        'permission' => 'boat_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!Boat::isEnable()) return [];
        return [
            'form_search_boat'=>"\\Modules\\Boat\\Blocks\\FormSearchBoat",
            'list_boat'=>"\\Modules\\Boat\\Blocks\\ListBoat",
        ];
    }
}
