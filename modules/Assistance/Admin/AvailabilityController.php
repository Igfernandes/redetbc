<?php
namespace Modules\Assistance\Admin;

use Modules\Space\Models\SpaceDate;

class AvailabilityController extends \Modules\Assistance\Controllers\AvailabilityController
{
    protected $spaceClass;
    /**
     * @var SpaceDate
     */
    protected $spaceDateClass;
    protected $indexView = 'Assistance::admin.availability';

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('assistance.admin.index'));
        $this->middleware('dashboard');
    }

}
