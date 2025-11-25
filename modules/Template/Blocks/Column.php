<?php
namespace Modules\Template\Blocks;
class Column extends BaseBlock
{
    public function getName()
    {
        return __('Coluna');
    }
    public function getOptions()
    {
        return [
            'child_of'     => ['row'],
            'is_container' => true,
            'component'    => 'ColumnBlock',
            'settings'     => [
                [
                    'size' => [
                        'type' => 'size'
                    ]
                ]
            ]
        ];
    }
}
