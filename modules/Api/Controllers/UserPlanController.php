<?php

namespace Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // garante que Auth()->user() vai funcionar
    }
    
    public function plan(Request $request, $id)
    {


        \var_dump(Auth()->user());

        return $this->sendSuccess([]);
    }
}
