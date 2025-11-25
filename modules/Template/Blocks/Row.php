<?php
namespace Modules\Template\Blocks;
class Row extends BaseBlock
{
    public function getName()
    {
        return __('Seção');
    }

    public function getOptions()
    {
        return [
            'parent_of'    => ['column'],
            'is_container' => true,
            'component'    => 'RowBlock',
            'settings'     => []
        ];
    }
}
