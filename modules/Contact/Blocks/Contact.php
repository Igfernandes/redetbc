<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class Contact extends BaseBlock
{
    function getOptions()
    {
        return ([
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Bloco de Class')
                ],
            ],
            'category'=>__("Outro bloco")
        ]);
    }

    public function getName()
    {
        return __('Bloco de contato');
    }

    public function content($model = [])
    {
        return view('Contact::frontend.blocks.contact.index', $model);
    }
}
