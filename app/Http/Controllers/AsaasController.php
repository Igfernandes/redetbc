<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AsaasService;
use Illuminate\Http\Request;

class AsaasController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function webhook(Request $request)
    {
        $asaasService = new AsaasService();
        return $asaasService->webhook($request);
    }
}
