<?php
namespace Themes\Mytravel\Location\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;

class UnmissableDestinations extends BaseBlock
{
    function getOptions()
    {
        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Título')
        ];
        $arg[] = [
            'id'        => 'location_name',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Nome da Localização')
        ];
        $arg[] = [
            'id'        => 'location_desc',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Descrição da Localização')
        ];
        $arg[] = [
            'id'        => 'location_btn',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Texto do Botão da Localização')
        ];
        $arg[] = [
            'id'        => 'location_link',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Link do Botão da Localização')
        ];
        $arg[] =  [
            'id'            => 'number_item',
            'type'          => 'input',
            'inputType'     => 'text',
            'label'         => __('Número de Itens (Padrão: 4)')
        ];

        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            $list_service[] = ['value'   => $key, 'name' => ucwords($key)];
        }

        $arg[] = [
            'id'            => 'service_types',
            'type'          => 'radios',
            'label'         => "<strong>".__('Tipo de Serviço')."</strong>",
            'values'        => $list_service,
        ];

        $arg[] = [
            'id'            => 'bg_image',
            'type'          => 'uploader',
            'label'         => __('Imagem de Fundo'),
        ];

        return ([
            'settings' => $arg,
            'category'=>__("Blocos de Localização")
        ]);
    }

    public function getName()
    {
        return __('Destinos Imperdíveis');
    }

    public function content($model = [])
    {
        $allServices = get_bookable_services();
        if(empty($allServices[$model['service_types']])){
            return "";
        }
        $module = new $allServices[$model['service_types']];
        $limit = (!empty($model['number_item'])) ? $model['number_item'] : 4;
        $model['rows'] = $module::where('status','publish')->limit($limit)->orderBy('id', 'DESC')->with(['translation'])->get();
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        $model['modelBlock'] = $model;

        return $this->view('Location::frontend.blocks.unmissable-destinations.'.$model['style'], $model);
    }
}