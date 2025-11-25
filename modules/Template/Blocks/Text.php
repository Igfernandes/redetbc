<?php
namespace Modules\Template\Blocks;
class Text extends BaseBlock
{

    public function getName()
    {
        return __('Texto');
    }

    public function getOptions()
    {
        return [
            'setting_tabs' => [
                'content' => [
                    'label' => __("Conteúdo"),
                    'icon'  => 'fa fa-pencil',
                    'order' => 1
                ],
                'style'   => [
                    'label' => __("Estilo"),
                    'order' => 2,
                    'icon'  => 'fa fa-object-group',
                ],
            ],
            'settings' => [
                [
                    'id'    => 'content',
                    'type'  => 'editor',
                    'label' => __('Editor'),
                    'tab'   => 'content'
                ],
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label' => __('Classe Wrapper (opc)'),
                    'tab'   => 'content'
                ],
                [
                    'id'    => 'padding',
                    'type'  => 'spacing',
                    'label' => __('Preenchimento'),
                    'tab'   => 'style'
                ],
            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function content($model = [])
    {
        return $this->view('Template::frontend.blocks.text', $model);
    }
}