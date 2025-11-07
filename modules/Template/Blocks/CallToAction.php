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
                    'label'     => __('Título Link Mais')
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
                            'name' => __("Style Normal")
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
                    'label'     => __('- Layout Normal: Background Color - get code in <a href="https://html-color-codes.info" target="_blank">https://html-color-codes.info</a>'),
                    'placeholder'=> "#f6b756",
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('- Layout 2&3 : Background Image Uploader')
                ],
            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function getName()
    {
        return __('Chamada para ação');
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
