<?php
namespace Modules\Assistance\Admin;

use Modules\Assistance\Models\Assistance;
use Modules\Assistance\Models\AssistanceDate;
use Modules\Booking\Models\Booking;

class AvailabilityController extends \Modules\Assistance\Controllers\AvailabilityController
{
    protected $assistanceClass;
    protected $assistanceDateClass;
    protected $bookingClass;
    protected $indexView = 'Assistance::admin.availability';

    public function __construct(Assistance $assistanceClass, AssistanceDate $assistanceDateClass, Booking $bookingClass)
    {
        $this->setActiveMenu(route('assistance.admin.index'));
        $this->middleware('dashboard');
        $this->bookingClass = $bookingClass;
        $this->assistanceClass = $assistanceClass;
        $this->assistanceDateClass = $assistanceDateClass;
    }

}
