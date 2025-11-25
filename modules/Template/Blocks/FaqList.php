<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;

class FaqList extends BaseBlock
{

    public function getName()
    {
        return __('Lista de FAQ');
    }

    public function getOptions()
    {
        return [
            'settings' => [
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
                    ]
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Item(s) da Lista'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Pergunta')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'editor',
                            'inputType' => 'textArea',
                            'label'     => __('Resposta')
                        ],
                    ]
                ],
            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function content($model = [])
    {
        if(($model['style'] ?? '') === 'style_2'){
            return $this->view('Template::frontend.blocks.faq.style2', $model);
        }
        return $this->view('Template::frontend.blocks.faq-list', $model);
    }
}