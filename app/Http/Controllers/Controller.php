<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($data)
    {
        $mergeData = count($data) ? array_merge(array_merge($data, ['status' => 200])) : ['status' => 200];
        return response()->json($mergeData);
    }

    public function updatedResponse()
    {
        return response()->json(['status' => 201], 201);
    }
}
