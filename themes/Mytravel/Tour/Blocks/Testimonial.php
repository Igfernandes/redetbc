<?php
namespace Themes\Mytravel\Tour\Blocks;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class Testimonial extends BaseBlock
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
                    'label'       => __('Listar item(ns)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'name',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Nome')
                        ],
                        [
                            'id'    => 'desc',
                            'type'  => 'textArea',
                            'label' => __('Desc')
                        ],
                        [
                            'id'        => 'position',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Posição')
                        ],
                        [
                            'id'    => 'avatar',
                            'type'  => 'uploader',
                            'label' => __('Imagem de Avatar')
                        ],
                    ]
                ],
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Estilo'),
                    'values' => [
                        [
                            'value'   => 'index',
                            'name' => __("Estilo 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Estilo 2")
                        ],
                    ],
                ],
            ],
            'category'=>__("Outro Bloco")
        ]);
    }

    public function getName()
    {
        return __('Listar depoimentos');
    }

    public function content($model = [])
    {
        $blade = (!empty($model['style'])) ? $model['style'] : 'index';
        return $this->view("Tour::frontend.blocks.testimonial.{$blade}", $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach (  $model['list_item'] as &$item ){
                $item['avatar_url'] = FileHelper::url($item['avatar'], 'full');
            }
        }
        return $model;
    }
}
