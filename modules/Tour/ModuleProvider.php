<?php
namespace Modules\Tour;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Tour\Models\Tour;
use Modules\User\Helpers\PermissionHelper;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Tour::isEnable()){
            $sitemapHelper->add("tour",[app()->make(Tour::class),'getForSitemap']);
        }

        PermissionHelper::add([
            // Tour
            'tour_view',
            'tour_create',
            'tour_update',
            'tour_delete',
            'tour_manage_others',
            'tour_manage_attributes',
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
        if(!Tour::isEnable()) return [];
        return [
            'tour' => Tour::class,
        ];
    }

    public static function getAdminMenu()
    {
        $res = [];
        if(Tour::isEnable()){
            $res['tour'] = [
                "position"=>40,
                'url'        => route('tour.admin.index'),
                'title'      => __("Passeio"),
                'icon'       => 'icon ion-md-umbrella',
                'permission' => 'tour_view',
                'children'   => [
                    'tour_view'=>[
                        'url'        => route('tour.admin.index'),
                        'title'      => __('Todos Passeios'),
                        'permission' => 'tour_view',
                    ],
                    'tour_create'=>[
                        'url'        => route('tour.admin.create'),
                        'title'      => __("Adicionar Passeio"),
                        'permission' => 'tour_create',
                    ],
                    'tour_category'=>[
                        'url'        => route('tour.admin.category.index'),
                        'title'      => __('Categorias'),
                        'permission' => 'tour_manage_others',
                    ],
                    'tour_attribute'=>[
                        'url'        => route('tour.admin.attribute.index'),
                        'title'      => __('Atributos'),
                        'permission' => 'tour_manage_attributes',
                    ],
                    'tour_availability'=>[
                        'url'        => route('tour.admin.availability.index'),
                        'title'      => __('Disponibilidade'),
                        'permission' => 'tour_create',
                    ],
                    'tour_booking'=>[
                        'url'        => route('tour.admin.booking.index'),
                        'title'      => __('Calendário de Reservas'),
                        'permission' => 'tour_create',
                    ],
                    'recovery'=>[
                        'url'        => route('tour.admin.recovery'),
                        'title'      => __('Recuperação'),
                        'permission' => 'tour_view',
                    ],
                ]
            ];
        }
        return $res;
    }


    public static function getUserMenu()
    {
        $res = [];
        if(Tour::isEnable()){
            $res['tour'] = [
                'url'   => route('tour.vendor.index'),
                'title'      => __("Gerenciar Passeio"),
                'icon'       => Tour::getServiceIconFeatured(),
                'permission' => 'tour_view',
                'position'   => 40,
                'children'   => [
                    [
                        'url'   => route('tour.vendor.index'),
                        'title' => __("Todos Passeios"),
                    ],
                    [
                        'url'        => route('tour.vendor.create'),
                        'title'      => __("Adicionar Passeio"),
                        'permission' => 'tour_create',
                    ],
                    [
                        'url'        => route('tour.vendor.availability.index'),
                        'title'      => __("Disponibilidade"),
                        'permission' => 'tour_create',
                    ],
                    [
                        'url'   => route('tour.vendor.recovery'),
                        'title'      => __("Recuperação"),
                        'permission' => 'tour_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getMenuBuilderTypes()
    {
        if(!Tour::isEnable()) return [];

        return [
            [
                'class' => \Modules\Tour\Models\Tour::class,
                'name'  => __("Passeio"),
                'items' => \Modules\Tour\Models\Tour::searchForMenu(),
                'position'=>20
            ],
            [
                'class' => \Modules\Tour\Models\TourCategory::class,
                'name'  => __("Passeio Categoria"),
                'items' => \Modules\Tour\Models\TourCategory::searchForMenu(),
                'position'=>30
            ],
        ];
    }

    public static function getTemplateBlocks(){
        if(!Tour::isEnable()) return [];

        return [
            'list_tours'=>"\\Modules\\Tour\\Blocks\\ListTours",
            'form_search_tour'=>"\\Modules\\Tour\\Blocks\\FormSearchTour",
            'box_category_tour'=>"\\Modules\\Tour\\Blocks\\BoxCategoryTour",
        ];
    }
}
