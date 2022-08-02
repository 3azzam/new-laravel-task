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

    public function badRequestResponse($message = "resource not found")
    {
        return response()->json(['message' => $message, 'status' => 400], 400);
    }

    public function updatedResponse()
    {
        return response()->json(['message' => 'updated successfully', 'status' => 201], 201);
    }

    public function deletedResponse()
    {
        return response()->json(['message' => 'deleted successfully', 'status' => 201], 201);
    }

    public function serverErrorResponse()
    {
        return response()->json(['message' => "server error ... please try again later", 'status' => 500], 500);
    }
}
