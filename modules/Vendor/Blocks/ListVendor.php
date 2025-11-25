<?php
namespace Modules\Vendor\Blocks;

use App\User;
use Modules\Template\Blocks\BaseBlock;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Location\Models\Location;

class ListVendor extends BaseBlock
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
                    'label'     => __('Desc')
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Item numérico')
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Ordem'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Data de Criação")
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
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('Listar por IDs'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('user.admin.getForSelect2',['user_type'=>'vendor']),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                        'placeholder' => __('-- Selecione --')
                    ],
                    'pre_selected' => route('user.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ],
            ],
            'category'=>__("Outro Bloco")
        ]);
    }

    public function getName()
    {
        return __('Listar fornecedor');
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'desc'      => $model['desc'] ?? "",
        ];
        return view('Vendor::frontend.blocks.list-vendor.index', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows;
        return $model;
    }

    public function query($model){
        $list_user = User::query();
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if(!empty( $model['custom_ids'] )){
            $list_user->whereIn("id",$model['custom_ids']);
        }
        $list_user->role("vendor");
        $list_user->where("status", "publish");
        $list_user->groupBy("id");
        $list_user->orderBy($model['order'], $model['order_by']);
        return $list_user->limit($model['number'])->get();
    }
}
