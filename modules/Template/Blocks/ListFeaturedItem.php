<?php
namespace Modules\Template\Blocks;

use Modules\Media\Helpers\FileHelper;

class ListFeaturedItem extends BaseBlock
{
    public function getOptions(){
        return [
            'settings' => [
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Listar item(ns)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Título')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Subtítulo')
                        ],
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'        => 'order',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Ordem')
                        ],
                    ]
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Estilo'),
                    'values'        => [
                        [
                            'value'   => 'normal',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'style2',
                            'name' => __("Estilo 2")
                        ],
                        [
                            'value'   => 'style3',
                            'name' => __("Estilo 3")
                        ],
                        [
                            'value'   => 'style4',
                            'name' => __("Style 4")
                        ],
                        [
                            'value'   => 'style5',
                            'name' => __("Style 5")
                        ]
                    ]
                ]
            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function getName()
    {
        return __('Listar item em destaque');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.list-featured-item.index', $model);
    }
    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach (  $model['list_item'] as &$item ){
                $item['icon_image_url'] = FileHelper::url($item['icon_image'], 'full');
            }
        }
        return $model;
    }
}
