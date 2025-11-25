<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ListFeaturedItem extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Lista de Item(ns)'),
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
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ],
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('- Estilo 1 : Upload de Imagem')
                        ],
                        [
                            'id'    => 'icon',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('- Estilo 2, Estilo 3 : Classe de Ícone')
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
                            'value'   => '',
                            'name' => __("Estilo 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Estilo 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Estilo 3")
                        ]
                    ]
                ],
                [
                    'id'            => 'border_none',
                    'type'          => 'checkbox',
                    'label'         => "Border None",
                    'values'        => false,
                ]
            ],
            'category'=>__("Outros Blocos")
        ]);
    }

    public function getName()
    {
        return __('Listar Item em Destaque');
    }

    public function content($model = [])
    {
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        return $this->view('Template::frontend.blocks.list-featured-item.'.$model['style'], $model);
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