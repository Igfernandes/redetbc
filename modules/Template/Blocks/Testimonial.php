<?php
namespace Modules\Template\Blocks;

use Modules\Media\Helpers\FileHelper;

class Testimonial extends BaseBlock
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
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Item(ns) da Lista'),
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
                            'label' => __('Descrição')
                        ],
                        [
                            'id'        => 'number_star',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Número de estrelas')
                        ],
                        [
                            'id'    => 'avatar',
                            'type'  => 'uploader',
                            'label' => __('Imagem do Avatar')
                        ],
                    ]
                ],
            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function getName()
    {
        return __('Lista de Depoimentos');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.testimonial.index', $model);
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