<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Media\Helpers\FileHelper;
use Modules\Template\Blocks\BaseBlock;

class VideoPlayer extends BaseBlock
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
                    'id'        => 'youtube',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link do Youtube')
                ],
                [
                    'id'        => 'caption',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Legenda do Vídeo')
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Imagem de Fundo')
                ],
                [
                    'id'    => 'bg_gradient',
                    'type'  => 'radios',
                    'label' => __('Sobreposição de Gradiente de Fundo'),
                    'values' => [
                        [
                            'value'   => 'gradient_overlay_half_bg_grayish_blue',
                            'name' => __("Azul Acinzentado")
                        ],
                        [
                            'value'   => 'gradient_overlay_half_bg_blue_light',
                            'name' => __("Azul Claro")
                        ],
                    ],
                ],
            ],
            'category'=>__("Outros Blocos")
        ]);
    }

    public function getName()
    {
        return __('Player de Vídeo');
    }

    public function content($model = [])
    {
        $model['id'] = time();
        $model['bg_gradient'] = (!empty($model['bg_gradient'])) ? $model['bg_gradient'] : 'gradient_overlay_half_bg_grayish_blue';
        return $this->view('Template::frontend.blocks.video-player', $model);
    }

    public function contentAPI($model = []){
        if (!empty($model['bg_image'])) {
            $model['bg_image_url'] = FileHelper::url($model['bg_image'], 'full');
        }
        return $model;
    }
}