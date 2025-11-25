<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;

class BrandsList extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Listar Item(ns) da Marca'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Título')
                        ],
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Imagem Destacada')
                        ],
                    ]
                ],
            ],
            'category'=>__("Outro Bloco")
        ]);
    }

    public function getName()
    {
        return __('Lista de Marcas');
    }

    public function content($model = [])
    {
        if(!empty($model['image_id'])){
            $model['image_url'] = get_file_url($model['image_id'] , 'full');
        }
        return $this->view('Template::frontend.blocks.brands-list.index', $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['image_id'])){
            $model['image_url'] = get_file_url($model['image_id'] , 'full');
        }
        return $model;
    }
}