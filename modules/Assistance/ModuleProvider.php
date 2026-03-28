<?php
namespace Modules\Assistance;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Assistance\Models\Assistance;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Assistance::isEnable()){
            $sitemapHelper->add("assistance",[app()->make(Assistance::class),'getForSitemap']);
        }

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

    public static function getBookableServices()
    {
        if(!Assistance::isEnable()) return [];
        return [
            'assistance' => Assistance::class,
        ];
    }

    public static function getAdminMenu()
    {
        $res = [];
        if(Assistance::isEnable()){
            $res['assistance'] = [
                "position"=>40,
                'url'        => route('assistance.admin.index'),
                'title'      => __("Serviços"),
                'icon'       => 'icon ion-md-umbrella',
                'permission' => 'assistance_view',
                'children'   => [
                    'assistance_view'=>[
                        'url'        => route('assistance.admin.index'),
                        'title'      => __('Todos Serviços'),
                        'permission' => 'assistance_view',
                    ],
                    'assistance_create'=>[
                        'url'        => route('assistance.admin.create'),
                        'title'      => __("Adicionar Serviço"),
                        'permission' => 'assistance_create',
                    ],
                    'assistance_category'=>[
                        'url'        => route('assistance.admin.category.index'),
                        'title'      => __('Categorias'),
                        'permission' => 'assistance_manage_others',
                    ],
                    'assistance_attribute'=>[
                        'url'        => route('assistance.admin.attribute.index'),
                        'title'      => __('Atributos'),
                        'permission' => 'assistance_manage_attributes',
                    ],
                    'assistance_availability'=>[
                        'url'        => route('assistance.admin.availability.index'),
                        'title'      => __('Disponibilidade'),
                        'permission' => 'assistance_create',
                    ],
                    'assistance_booking'=>[
                        'url'        => route('assistance.admin.booking.index'),
                        'title'      => __('Calendário de Reservas'),
                        'permission' => 'assistance_create',
                    ],
                    'recovery'=>[
                        'url'        => route('assistance.admin.recovery'),
                        'title'      => __('Recuperação'),
                        'permission' => 'assistance_view',
                    ],
                ]
            ];
        }
        return $res;
    }


    public static function getUserMenu()
    {
        $res = [];
        if(Assistance::isEnable()){
            $res['assistance'] = [
                'url'   => route('assistance.vendor.index'),
                'title'      => __("Gerenciar Serviços"),
                'icon'       => Assistance::getServiceIconFeatured(),
                'permission' => 'assistance_view',
                'position'   => 40,
                'children'   => [
                    [
                        'url'   => route('assistance.vendor.index'),
                        'title' => __("Todos Serviços"),
                    ],
                    [
                        'url'        => route('assistance.vendor.create'),
                        'title'      => __("Adicionar Serviço"),
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

    public static function getMenuBuilderTypes()
    {
        if(!Assistance::isEnable()) return [];

        return [
            [
                'class' => \Modules\Assistance\Models\Assistance::class,
                'name'  => __("Serviço"),
                'items' => \Modules\Assistance\Models\Assistance::searchForMenu(),
                'position'=>20
            ],
            [
                'class' => \Modules\Assistance\Models\AssistanceCategory::class,
                'name'  => __("Serviço Categoria"),
                'items' => \Modules\Assistance\Models\AssistanceCategory::searchForMenu(),
                'position'=>30
            ],
        ];
    }

    public static function getTemplateBlocks(){
        if(!Assistance::isEnable()) return [];

        return [
            'list_assistances'=>"\\Modules\\Assistance\\Blocks\\ListAssistances",
            'form_search_assistance'=>"\\Modules\\Assistance\\Blocks\\FormSearchAssistance",
            'box_category_assistance'=>"\\Modules\\Assistance\\Blocks\\BoxCategoryAssistance",
        ];
    }
}
