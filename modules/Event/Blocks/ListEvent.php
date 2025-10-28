<?php
namespace Modules\Event\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Event\Models\Event;
use Modules\Location\Models\Location;

class ListEvent extends BaseBlock
{

    protected $eventClass;
    public function __construct(Event $eventClass)
    {
        $this->eventClass = $eventClass;
    }

    public function getName()
    {
        return __('Evento: Listar itens');
    }
    public function getOptions(): array
    {
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
                'label'     => __('Desc')
            ],
            [
                'id'        => 'number',
                'type'      => 'input',
                'inputType' => 'number',
                'label'     => __('Item numérico')
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
                        'name' => __("Carrossel deslizante")
                    ]
                ]
            ],
            [
                'id'      => 'location_id',
                'type'    => 'select2',
                'label'   => __('Filtrar por localização'),
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
                'label'         => __('Ordem'),
                'values'        => [
                    [
                        'value'   => 'id',
                        'name' => __("Data de criação")
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
                'label'=>__("Apenas itens em destaque?"),
                'id'=> "is_featured",
                'default'=>true
            ],
            [
                'id'           => 'custom_ids',
                'type'         => 'select2',
                'label'        => __('Listar por IDs'),
                'select2'      => [
                    'ajax'        => [
                        'url'      => route('event.admin.getForSelect2'),
                        'dataType' => 'json'
                    ],
                    'width'       => '100%',
                    'multiple'    => "true",
                    'placeholder' => __('-- Selecione --')
                ],
                'pre_selected' => route('event.admin.getForSelect2', [
                    'pre_selected' => 1
                ])
            ],
        ],
            'category'=>__("Evento de serviço")
        ];
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'       => $list,
            'style_list' => $model['style'],
            'title'      => $model['title'],
            'desc'       => $model['desc'],
        ];
        return view('Event::frontend.blocks.list-event.index', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        $listCar = $this->eventClass->search($model);
        $limit = $model['number'] ?? 5;
        return $listCar->paginate($limit);
    }
}
