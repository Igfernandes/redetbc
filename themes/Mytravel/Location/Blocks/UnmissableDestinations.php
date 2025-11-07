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
            'label'     => __('Localização Name')
        ];
        $arg[] = [
            'id'        => 'location_desc',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Localização Desc')
        ];
        $arg[] = [
            'id'        => 'location_btn',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Localização Button Text')
        ];
        $arg[] = [
            'id'        => 'location_link',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Localização Button Link')
        ];
        $arg[] =  [
            'id'            => 'number_item',
            'type'          => 'input',
            'inputType'     => 'text',
            'label'         => __('Item numérico (Default: 4)')
        ];

        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            $list_service[] = ['value'   => $key, 'name' => ucwords($key)];
        }

        $arg[] = [
            'id'            => 'service_types',
            'type'          => 'radios',
            'label'         => "<strong>".__('Tipo de serviço')."</strong>",
            'values'        => $list_service,
        ];

        $arg[] = [
            'id'            => 'bg_image',
            'type'          => 'uploader',
            'label'         => __('Background Image'),
        ];

        return ([
            'settings' => $arg,
            'category'=>__("Localização Blocks")
        ]);
    }

    public function getName()
    {
        return __('Unmissable Destinations');
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
