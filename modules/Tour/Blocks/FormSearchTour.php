<?php
namespace Modules\Tour\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;
use Modules\Tour\Models\TourCategory;

class  FormSearchTour extends BaseBlock
{
    public function getOptions(){
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
                    'label'     => __('Subtítulo')
                ],
                [
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
                ]
            ],
            'category'=>__("Service Tour")
        ];
    }

    public function getName()
    {
        return __('Tour: Form Search');
    }

    public function content($model = [])
    {
        $limit_location = 15;
        if( empty(setting_item("tour_location_search_style")) or setting_item("tour_location_search_style") == "normal" ){
            $limit_location = 1000;
        }
        $data = [
            'tour_location' => Location::where("status","publish")->limit($limit_location)->with(['translation'])->get()->toTree(),
            'bg_image_url'  => '',
        ];
        $data = array_merge($model, $data);
        if (!empty($model['bg_image'])) {
            $data['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        $data['style'] = $model['style'] ?? "";
        $data['list_slider'] = $model['list_slider'] ?? "";
        $data['tour_category'] = TourCategory::where('status', 'publish')->with(['translation'])->get()->toTree();
        return view('Tour::frontend.blocks.form-search-tour.index', $data);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}
