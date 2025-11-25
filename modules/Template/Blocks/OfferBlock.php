<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class OfferBlock extends BaseBlock
{
    public function getName()
    {
        return __('Bloco de Oferta');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Item(ns) da Lista'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Título')
                        ],
                        [
                            'id'        => 'desc',
                            'type'      => 'textArea',
                            'inputType' => 'textArea',
                            'label'     => __('Descrição')
                        ],
                        [
                            'id'    => 'background_image',
                            'type'  => 'uploader',
                            'label' => __('Carregador de Imagem de Fundo')
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
                            'id'        => 'featured_text',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Texto em destaque')
                        ],
                        [
                            'id'        => 'featured_icon',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Ícone em destaque (encontre a classe do ícone em : https://icofont.com/icons)')
                        ],
                    ]
                ],

            ],
            'category'=>__("Outro Bloco")
        ];
    }

    public function content($model = [])
    {
        return $this->view('Template::frontend.blocks.offer-block.index', $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach (  $model['list_item'] as &$item ){
                $item['background_image_url'] = FileHelper::url($item['background_image'], 'full');
            }
        }
        return $model;
    }
}