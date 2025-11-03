<?php
namespace Modules\Event\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class FormSearchEvent extends BaseBlock
{

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título')
                ],
                [
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Título')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Fundo de estilo'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'carousel',
                            'name' => __("Carrossel deslizante")
                        ]
                    ]
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('- Layout Normal: Carregador de Imagem de Fundo')
                ],
                [
                    'id'          => 'list_slider',
                    'type'        => 'listItem',
                    'label'       => __('- Controle deslizante de layout: listar itens'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'    => 'bg_image',
                            'type'  => 'uploader',
                            'label' => __('Carregador de imagem de fundo')
                        ]
                    ]
                ]
            ],
            'category'=>__("Evento de serviço")
        ];
    }

    public function getName()
    {
        return __('Evento: Pesquisa de formulário');
    }

    public function content($model = [])
    {
        $limit_location = 15;
        if( empty(setting_item("event_location_search_style")) or setting_item("event_location_search_style") == "normal" ){
            $limit_location = 1000;
        }
        $data = [
            'list_location' => Location::where("status","publish")->limit($limit_location)->with(['translation'])->get()->toTree(),
            'bg_image_url'  => '',
        ];
        $data = array_merge($model, $data);
        if (!empty($model['bg_image'])) {
            $data['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        $data['style'] = $model['style'] ?? "";
        $data['list_slider'] = $model['list_slider'] ?? "";
        return view('Event::frontend.blocks.form-search-event.index', $data);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}
