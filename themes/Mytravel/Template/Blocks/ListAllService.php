<?php
namespace Themes\Mytravel\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;


class ListAllService extends BaseBlock
{
    function getOptions()
    {
        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            $list_service[] = ['value'   => $key,
                               'name' => ucwords($key)
            ];
            $arg[] = [
                'id'        => 'title_for_'.$key,
                'type'      => 'input',
                'inputType' => 'text',
                'label'     => __('Título for :service',['service'=>ucwords($key)])
            ];
        }
        $arg[] = [
            'id'            => 'service_types',
            'type'          => 'checklist',
            'listBox'          => 'true',
            'label'         => "<strong>".__('Service Type')."</strong>",
            'values'        => $list_service,
        ];

        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Título')
        ];

        $arg[] =  [
            'id'            => 'style',
            'type'          => 'radios',
            'label'         => __('Estilo de fundo'),
            'values'        => [
                [
                    'value'   => '',
                    'name' => __("Style 1")
                ],
            ]
        ];

        $arg[] =  [
            'id'        => 'number',
            'type'      => 'input',
            'inputType' => 'number',
            'label'     => __('Item numérico')
        ];

        $arg[] =  [
            'id'            => 'order',
            'type'          => 'radios',
            'label'         => __('Ordem'),
            'values'        => [
                [
                    'value'   => 'id',
                    'name' => __("Data de Criação")
                ],
                [
                    'value'   => 'title',
                    'name' => __("Título")
                ],
            ]
        ];

        $arg[] =  [
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
        ];

        return ([
            'settings' => $arg,
            'category'=>__("Other Block")
        ]);
    }

    public function getName()
    {
        return __('List All Service');
    }

    public function content($model = [])
    {
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        $model['order'] = !empty($model['order']) ? $model['order'] :  "id";
        $model['order_by'] = !empty($model['order_by']) ? $model['order_by'] :  "desc";
        $model['number'] = !empty($model['number']) ? $model['number'] :  8;
        $model['modelBlock'] = $model;
        $model['rows'] = [];
        if(!empty($model['service_types'])){
            foreach ($model['service_types'] as $service_type){
                $allServices = get_bookable_services();
                if(empty($allServices[$service_type])) continue;
                $module = new $allServices[$service_type];
                $table_name = $module->getTableName();
                $module = $module->with(['location','translation','hasWishList']);
                if(!empty($model['is_featured']))
                {
                    $module->where('is_featured',1);
                }
                $module = $module->orderBy($table_name.".".$model['order'], $model['order_by']);
                $module = $module->where($table_name.".status", "publish");
                $module = $module->with(['location']);
                if($service_type == 'tour'){
                    $module->with(['category_tour','category_tour.translation']);
                }

                $module = $module->groupBy($table_name.".id");
                $model['rows'][$service_type] = $module->limit($model['number'])->get();
            }
        }
        return $this->view('Template::frontend.blocks.list-all-service.'.$model['style'], $model);
    }

    public function contentAPI($model = []){
        return $model;
    }
}
