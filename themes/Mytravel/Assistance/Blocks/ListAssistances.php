<?php
namespace Themes\Mytravel\Assistance\Blocks;

use Modules\Assistance\Models\Assistance;
use Modules\Template\Blocks\BaseBlock;
use Modules\Assistance\Models\AssistanceCategory;
use Modules\Location\Models\Location;

class ListAssistances extends BaseBlock
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
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Descrição') // Traduzido: Desc
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Número de Itens') // Traduzido: Item numérico
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Estilo'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Estilo 1") // Traduzido: Style 1
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Estilo 2") // Traduzido: Style 2
                        ],
                    ]
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filtrar por Categoria'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => url('/admin/module/assistance/category/getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'placeholder' => __('-- Selecione --')
                    ],
                    'pre_selected'=>url('/admin/module/assistance/category/getForSelect2?pre_selected=1')
                ],
                [
                    'id'      => 'location_id',
                    'type'    => 'select2',
                    'label'   => __('Filtrar por Localização'), // Traduzido: Filtrar por localização
                    'select2' => [
                        'ajax'  => [
                            'url'      => url('/admin/module/location/getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'placeholder' => __('-- Selecione --')
                    ],
                    'pre_selected'=>url('/admin/module/location/getForSelect2?pre_selected=1')
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Ordem'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Data de Criação") // Traduzido: Data de Criação
                        ],
                        [
                            'value'   => 'title',
                            'name' => __("Título") // Traduzido: Título
                        ],
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'radios',
                    'label'         => __('Ordenar por'),
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
                    'label'=>__("Apenas itens em destaque?"), // Traduzido: Somente itens em destaque?
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('Listar Serviços pelos IDs'), // Traduzido: Listar Serviços pelo IDs
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('assistance.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                    ],
                    'pre_selected' => route('assistance.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ]
            ],
            'category'=>__("Blocos de Serviços") // Traduzido: Blocos dos Serviços
        ]);
    }

    public function getName()
    {
        return __('Serviços: Listar Itens'); // Traduzido: Serviços: List Items
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'desc'      => $model['desc'] ?? "",
        ];
        return $this->view('Assistance::frontend.blocks.list-assistance.'.$model['style'], $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        $model_Assistance = Assistance::select(Assistance::getTableName().".*")->with(['location','translation','hasWishList']);
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (!empty($model['location_id'])) {
            $location = Location::where('id', $model['location_id'])->where("status","publish")->first();
            if(!empty($location)){
                $model_Assistance->join(Location::getTableName(), function ($join) use ($location) {
                    $join->on(Location::getTableName().'.id', '=', Assistance::getTableName().'.location_id')
                        ->where(Location::getTableName().'._lft', '>=', $location->_lft)
                        ->where(Location::getTableName().'._rgt', '<=', $location->_rgt);
                });
            }
        }
        if (!empty($model['category_id'])) {
            $category_ids = [$model['category_id']];
            $list_cat = AssistanceCategory::whereIn('id', $category_ids)->where("status","publish")->get();
            if(!empty($list_cat) and $list_cat->count() > 0)
            {
                $where_left_right = [];
                $params = [];
                foreach ($list_cat as $cat){
                    $where_left_right[] = " ( ".AssistanceCategory::getTableName()."._lft >= ? AND ".AssistanceCategory::getTableName()."._rgt <= ? ) ";
                    $params[] = $cat->_lft;
                    $params[] = $cat->_rgt;
                }
                $sql_where_join = " ( ".implode("OR" , $where_left_right)." )  ";
                $model_Assistance
                    ->join(AssistanceCategory::getTableName(), function ($join) use($sql_where_join,$params) {
                        $join->on(AssistanceCategory::getTableName().'.id', '=', Assistance::getTableName().'.category_id')
                            ->WhereRaw($sql_where_join,$params);
                    });
            }
        }
        if(!empty($model['is_featured']))
        {
            $model_Assistance->where(Assistance::getTableName().'.is_featured',1);
        }

        if(!empty( $model['custom_ids'] )){
            $model_Assistance->whereIn(Assistance::getTableName().".id",$model['custom_ids']);
        }
        $model_Assistance->orderBy(Assistance::getTableName().".".$model['order'], $model['order_by']);
        $model_Assistance->where(Assistance::getTableName().".status", "publish");
        $model_Assistance->with(['location','category_assistance','category_assistance']);
        $model_Assistance->groupBy(Assistance::getTableName().".id");
        return $model_Assistance->limit($model['number'])->get();
    }
}