<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class CallToAction extends BaseBlock
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
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Subtítulo')
                ],
                [
                    'id'        => 'link_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Título Link More')
                ],
                [
                    'id'        => 'link_more',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link More')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Estilo'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1")
                        ]
                    ]
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Carregador de Imagem de Fundo')
                ],
                [
                    'id'    => 'bg_gradient',
                    'type'  => 'radios',
                    'label' => __('Background Gradient overlay'),
                    'values' => [
                        [
                            'value'   => 'gradient_overlay_half_bg_dark',
                            'name' => __("Dark")
                        ],
                        [
                            'value'   => 'gradient_overlay_half_bg_grayish_blue',
                            'name' => __("Grayish Blue")
                        ],
                        [
                            'value'   => 'gradient_overlay_half_bg_blue_light',
                            'name' => __("Blue Light")
                        ],
                        [
                            'value'   => 'gradient_overlay_half_bg_orange',
                            'name' => __("Orange")
                        ]
                    ],
                ],
            ],
            'category'=>__("Other Block")
        ]);
    }

    public function getName()
    {
        return __('Call To Action');
    }

    public function content($model = [])
    {
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $this->view('Template::frontend.blocks.call-to-action.'.$model['style'], $model);
    }
}
