<?php
namespace Modules\Template\Blocks;

use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;
use Modules\Tour\Models\TourCategory;

class FormSearchAllService extends BaseBlock
{
    public function getName()
    {
        return __('Formulário de Pesquisa Todos os Serviços');
    }

    public function getOptions()
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
            'label'         => "<strong>".__('Tipo de serviço')."</strong>",
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
                    'name' => __("Normal")
                ],
                [
                    'value'   => 'carousel',
                    'name' => __("Carrossel deslizante")
                ],
                [
                    'value'   => 'carousel_v2',
                    'name' => __("Slider Carousel Ver 2")
                ],
                [
                    'value'   => 'bg_video',
                    'name' => __("Background Video")
                ],
            ]
        ];

        $arg[] = [
            'id'    => 'bg_image',
            'type'  => 'uploader',
            'label' => __('- Layout Normal: Carregador de Imagem de Fundo')
        ];

        $arg[] = [
            'id'        => 'video_url',
            'type'      => 'input',
            'inputType' => 'text',
            'label' => __('- Layout Video: Youtube Url')
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
                    'label'     => __('Título (using for slider ver 2)')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc (using for slider ver 2)')
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
            'label'=>__("Ocultar serviço de pesquisa de formulário?"),
            'id'=> "hide_form_search",
            'default'=>false
        ];

        return [
            'settings' => $arg,
            'category'=>__("Outro Bloco")
        ];
    }

    public function content($model = [])
    {
        $model['bg_image_url'] = FileHelper::url($model['bg_image'] ?? "", 'full') ?? "";
        $model['list_location'] = $model['tour_location'] = Location::where("status", "publish")->limit(1000)->orderBy('name', 'asc')->with(['translation'])->get()->toTree();
        $model['tour_category'] = TourCategory::where('status', 'publish')->with(['translation'])->get()->toTree();
        $model['style'] = $model['style'] ?? "";
        $model['list_slider'] = $model['list_slider'] ?? "";
        $model['modelBlock'] = $model;
        return $this->view('Template::frontend.blocks.form-search-all-service.index', $model);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}
