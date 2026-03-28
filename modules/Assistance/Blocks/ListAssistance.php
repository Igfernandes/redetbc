<?php
namespace Modules\Tour\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Assistance\Models\Assistance;

class ListAssistance extends BaseBlock
{
    protected $assistanceClass;

    public function __construct(Assistance $assistanceClass)
    {
        $this->assistanceClass = $assistanceClass;
    }

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
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Número de Itens')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Estilo'),
                    'values'        => [
                        [
                            'value'   => 'normal',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'carousel',
                            'name' => __("Carrossel")
                        ],
                        [
                            'value'   => 'box_shadow',
                            'name' => __("Sombra da Caixa")
                        ],
                        [
                            'value'   => 'carousel_simple',
                            'name' => __("Carrossel Deslizante Simples")
                        ],
                    ]
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filtrar por Categoria'),
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
                    'id'      => 'location_id',
                    'type'    => 'select2',
                    'label'   => __('Filtrar por Localização'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route('location.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'placeholder' => __('-- Selecione --')
                    ],
                    'pre_selected'=>route('location.admin.getForSelect2',['pre_selected'=>1])
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Ordenar por Campo'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("ID")
                        ],
                        [
                            'value'   => 'title',
                            'name' => __("Título")
                        ],
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'radios',
                    'label'         => __('Ordem'),
                    'values'        => [
                        [
                            'value'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'value'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ]
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Somente itens em Destaque?"),
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('Listar por IDs Personalizados'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('tour.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                        'placeholder' => __('-- Selecione --')
                    ],
                    'pre_selected' => route('tour.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ],
            ],
            'category'=>__("Serviços")
        ];
    }

    public function getName()
    {
        return __('Serviços: Lista de Itens');
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'       => $list,
            'style_list' => $model['style'],
            'title'      => $model['title'] ?? "",
            'desc'      => $model['desc'] ?? "",
        ];
        return view('Assistance::frontend.blocks.list-assistance.index', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        $listAssistance = $this->assistanceClass->search($model);
        $limit = $model['number'] ?? 5;
        return $listAssistance->paginate($limit);
    }
}