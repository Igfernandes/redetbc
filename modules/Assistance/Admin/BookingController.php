<?php
namespace Modules\Assistance\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Assistance\Models\Assistance;
use Modules\Assistance\Models\AssistanceCategory;

class BookingController extends AdminController
{
    protected $assistanceClass;
    public function __construct()
    {
        $this->setActiveMenu(route('assistance.admin.index'));
        $this->assistanceClass = Assistance::class;
    }

    public function index(Request $request){

        $this->checkPermission('assistance_create');

        $q = $this->assistanceClass::select("bravo_assistances.*");

        if($request->query('s')){
            $q->where('title','like','%'.$request->query('s').'%');
        }

        if ($cat_id = $request->query('cat_id')) {
            $cat = AssistanceCategory::find($cat_id);
            if(!empty($cat)) {
                $q->join('bravo_assistance_category', function ($join) use ($cat) {
                    $join->on('bravo_assistance_category.id', '=', 'bravo_assistances.category_id')
                        ->where('bravo_assistance_category._lft','>=',$cat->_lft)
                        ->where('bravo_assistance_category._rgt','>=',$cat->_lft);
                });
            }
        }

        if(!$this->hasPermission('assistance_manage_others')){
            $q->where('author_id',$this->currentUser()->id);
        }

        $q->orderBy('bravo_assistances.id','desc');
        $rows = $q->paginate(10);

        $current_month = time();

        if($request->query('month')){
            $date = date_create_from_format('m-Y',$request->query('month'));
            if(!$date){
                $current_month = time();
            }else{
                $current_month = $date->getTimestamp();
            }
        }

        $prev_url = route('assistance.admin.booking.index',array_merge($request->query(),[
           'month'=> date('m-Y',$current_month - MONTH_IN_SECONDS)
        ]));
        $next_url = route('assistance.admin.booking.index',array_merge($request->query(),[
           'month'=> date('m-Y',$current_month + MONTH_IN_SECONDS)
        ]));

        $assistance_categories = AssistanceCategory::where('status', 'publish')->get()->toTree();
        $breadcrumbs = [
            [
                'name' => __('Serviços'),
                'url'  => route('assistance.admin.index')
            ],
            [
                'name'  => __('Reserva'),
                'class' => 'active'
            ],
        ];
        $page_title = __('Histórico de Reservas de Serviços');
        return view('Assistance::admin.booking.index',compact('rows','assistance_categories','breadcrumbs','current_month','page_title','request','prev_url','next_url'));
    }
    
    public function test(){
        $d = new \DateTime('2019-07-04 00:00:00');

        $d->modify('+ 4 hours');
        echo $d->format('Y-m-d H:i:s');
    }
}