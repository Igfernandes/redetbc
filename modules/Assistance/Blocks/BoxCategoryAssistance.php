<?php
namespace Modules\Assistance\Blocks;

use Modules\Template\Blocks\BaseBlock;

use Modules\Media\Helpers\FileHelper;
use Modules\Assistance\Models\AssistanceCategory;

class BoxCategoryAssistance extends BaseBlock
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
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Descrição')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('Item(ns) da Lista'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'      => 'category_id',
                            'type'    => 'select2',
                            'label'   => __('Selecionar Categoria'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route('tour.admin.category.category.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'placeholder' => __('-- Selecione --')
                            ],
                            'pre_selected'=>route('tour.admin.category.category.getForSelect2',['pre_selected'=>1])
                        ],
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Imagem de Fundo')
                        ],
                    ]
                ],
            ],
            'category'=>__("Serviços")
        ];
    }

    public function getName()
    {
        return __('Serviços: Grupo de Categorias');
    }

    public function content($model = [])
    {
        if(!empty($model['list_item'])){
            $ids = collect($model['list_item'])->pluck('category_id');
            $categories = AssistanceCategory::query()->whereIn("id",$ids)->where('status','publish')->get();
            $model['categories'] = $categories;
        }
        return view('Assistance::frontend.blocks.box-category-assistance.index', $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach ( $model['list_item'] as &$item ){
                $item['image_id_url'] = FileHelper::url($item['image_id'], 'full');
            }
        }
        return $model;
    }
}