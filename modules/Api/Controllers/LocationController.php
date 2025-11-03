<?php
namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;
use Modules\Location\Models\Location;

class LocationController extends Controller
{

    public function search(){
        $class = new Location();
        $rows = $class->search(request()->input());
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

    public function detail($id = '')    {
        if(empty($id)){
            return $this->sendError(__("O ID do local não está disponível"));
        }
        $row = Location::find($id);
        if(empty($row))
        {
            return $this->sendError(__("Local não encontrado"));
        }

        return $this->sendSuccess([
            'data'=>$row->dataForApi(true)
        ]);

    }
}
