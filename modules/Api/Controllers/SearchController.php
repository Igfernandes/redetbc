<?php
namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Service;

class SearchController extends Controller
{

    public function search($type = ''){
        $type = $type ? $type : request()->get('type');
        if(empty($type))
        {
            return $this->sendError(__("O tipo é obrigatório"));
        }

        $class = get_bookable_service_by_id($type);
        if(empty($class) or !class_exists($class)){
            return $this->sendError(__("O tipo não existe"));
        }

        if(!empty(request()->query('limit'))){
            $limit = request()->query('limit');
        }else{
            $limit = !empty(setting_item($type."_page_limit_item"))? setting_item($type."_page_limit_item") : 9;
        }

        $query = new $class();
        $rows = $query->search(request()->input())->paginate($limit);

        $total = $rows->total();
        return $this->sendSuccess(
            [
                'total'=>$total,
                'total_pages'=>$rows->lastPage(),
                'data'=>$rows->map(function($row){
                    return $row->dataForApi();
                }),
            ]
        );
    }


    public function searchServices(){
        if(!empty(request()->query('limit'))){
            $limit = request()->query('limit');
        }else{
            $limit = 9;
        }
        $query = new Service();
        $rows = $query->search(request()->input())->paginate($limit);
        $total = $rows->total();
        return $this->sendSuccess(
            [
                'total'=>$total,
                'total_pages'=>$rows->lastPage(),
                'data'=>$rows->map(function($row){
                    return $row->dataForApi();
                }),
            ]
        );
    }

    public function getFilters($type = ''){
        $type = $type ? $type : request()->get('type');
        if(empty($type))
        {
            return $this->sendError(__("O tipo é obrigatório"));
        }
        $class = get_bookable_service_by_id($type);
        if(empty($class) or !class_exists($class)){
            return $this->sendError(__("O tipo não existe"));
        }
        $data = call_user_func([$class,'getFiltersSearch'],request());
        return $this->sendSuccess(
            [
                'data'=>$data
            ]
        );
    }

    public function getFormSearch($type = ''){
        $type = $type ? $type : request()->get('type');
        if(empty($type))
        {
            return $this->sendError(__("O tipo é obrigatório"));
        }
        $class = get_bookable_service_by_id($type);
        if(empty($class) or !class_exists($class)){
            return $this->sendError(__("O tipo não existe"));
        }
        $data = call_user_func([$class,'getFormSearch'],request());
        return $this->sendSuccess(
            [
                'data'=>$data
            ]
        );
    }

    public function detail($type = '',$id = '')
    {
        if(empty($type)){
            return $this->sendError(__("O recurso não está disponível"));
        }
        if(empty($id)){
            return $this->sendError(__("O ID do recurso não está disponível"));
        }

        $class = get_bookable_service_by_id($type);
        if(empty($class) or !class_exists($class)){
            return $this->sendError(__("O tipo não existe"));
        }

        $row = $class::find($id);
        if(empty($row))
        {
            return $this->sendError(__("Recurso não encontrado"));
        }

        return $this->sendSuccess([
            'data'=>$row->dataForApi(true)
        ]);

    }

    public function checkAvailability(Request $request , $type = '',$id = ''){
        if(empty($type)){
            return $this->sendError(__("O recurso não está disponível"));
        }
        if(empty($id)){
            return $this->sendError(__("O ID do recurso não está disponível"));
        }
        $class = get_bookable_service_by_id($type);
        if(empty($class) or !class_exists($class)){
            return $this->sendError(__("O tipo não existe"));
        }
        $classAvailability = $class::getClassAvailability();
        $classAvailability = app()->make($classAvailability);
        $request->merge(['id' => $id]);
        if($type == "hotel"){
            $request->merge(['hotel_id' => $id]);
            return $classAvailability->checkAvailability($request);
        }
        return $classAvailability->loadDates($request);
    }

    public function checkAssistanceAvailability(Request $request ,$id = ''){
        if(empty($id)){
            return $this->sendError(__("A identificação do serviço não está disponível"));
            return $this->sendError(__("O ID do serviço não está disponível"));
        }
        $class = get_bookable_service_by_id('assistance');
        $classAvailability = $class::getClassAvailability();
        $classAvailability = app()->make($classAvailability);
        $request->merge(['id' => $id]);
        return $classAvailability->availabilityBooking($request);
    }
}
