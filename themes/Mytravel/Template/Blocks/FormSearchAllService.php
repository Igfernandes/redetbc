<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;
use Modules\Tour\Models\TourCategory;

class FormSearchAllService extends BaseBlock
{
    function getOptions()
    {
        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            $list_service[] = ['value'   => $key,
                               'name' => ucwords($key)
            ];
            $arg[] = [
                'id'        => 'title_for_'.$key,
                'type'      => 'input',
                'inputType' => 'text',
                'label'     => __('Título for :service',['service'=>ucwords($key)])
            ];
        }
        $arg[] = [
            'id'            => 'service_types',
            'type'          => 'checklist',
            'listBox'          => 'true',
            'label'         => "<strong>".__('Service Type')."</strong>",
            'values'        => $list_service,
        ];

        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Título')
        ];
        $arg[] = [
            'id'        => 'sub_title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Subtítulo')
        ];

        $arg[] =  [
            'id'            => 'style',
            'type'          => 'radios',
            'label'         => __('Estilo de fundo'),
            'values'        => [
                [
                    'value'   => '',
                    'name' => __("Tab button Pills")
                ],
                [
                    'value'   => 'style_2',
                    'name' => __("Tab button Boxed")
                ],
                [
                    'value'   => 'style_3',
                    'name' => __("Tab button Shadow")
                ],
                [
                    'value'   => 'style_slider',
                    'name' => __("Carrossel deslizante")
                ],
            ]
        ];

        $arg[] = [
            'id'    => 'bg_image',
            'type'  => 'uploader',
            'label' => __('- Style 1: Background Image Uploader')
        ];

        $arg[] = [
            'id'          => 'list_slider',
            'type'        => 'listItem',
            'label'       => __('- Controle deslizante de layout: Listar item(ns)'),
            'title_field' => 'title',
            'settings'    => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Carregador de Imagem de Fundo')
                ]
            ]
        ];

        $arg[] = [
            'type'=> "checkbox",
            'label'=>__("Deseja ocultar o formulário?"),
            'id'=> "hide_form_search",
            'default'=>false
        ];

        $arg[] = [
            'type'=> "checkbox",
            'label'=>__("formulário de pesquisa único"),
            'id'=> "single_form_search",
            'default'=>false
        ];


        return ([
            'settings' => $arg,
            'category'=>__("Outros Blocos")
        ]);
    }

    public function getName()
    {
        return __('Formulário de Pesquisa de Todos os Serviços');
    }

    public function content($model = [])
    {
        $model['bg_image_url'] = FileHelper::url($model['bg_image'] ?? "", 'full') ?? "";
        $model['list_location'] = $model['tour_location'] =  Location::where("status","publish")->limit(1000)->orderBy('name', 'asc')->with(['translation'])->get()->toTree();
        $model['tour_category'] = TourCategory::where('status', 'publish')->with(['translation'])->get()->toTree();
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        $model['list_slider'] = $model['list_slider'] ?? "";
        $model['modelBlock'] = $model;

        return $this->view('Template::frontend.blocks.form-search-all-service.'.$model['style'], $model);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}
