<?php
namespace Modules\Template\Blocks;

use Modules\Media\Helpers\FileHelper;

class CallToAction extends BaseBlock
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
                    'id'        => 'link_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título do Link Mais')
                ],
                [
                    'id'        => 'link_more',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link Mais')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Estilo'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Estilo Normal")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Estilo 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Estilo 3")
                        ],
                    ]
                ],
                [
                    'id'        => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('- Layout Normal: Cor de Fundo - pegue o código em <a href="https://html-color-codes.info" target="_blank">https://html-color-codes.info</a>'),
                    'placeholder'=> "#f6b756",
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('- Layout 2&3 : Upload de Imagem de Fundo')
                ],
            ],
            'category'=>__("Outros Blocos")
        ];
    }

    public function getName()
    {
        return __('Chamada para Ação');
    }

    public function content($model = [])
    {
        $model['style'] = $model['style'] ?? "";
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return view('Template::frontend.blocks.call-to-action.index', $model);
    }
}