<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBabyRequest;
use App\Http\Requests\UpdateBabyRequest;
use App\Http\Services\BabyService;
use Illuminate\Http\Request;

class BabiesController extends Controller
{
    protected $babyService;

    public function __construct(BabyService $babyService)
    {
        $this->babyService = $babyService;
    }

    public function index(Request $request)
    {
        return $this->successResponse([
            'babies' => $this->babyService->get($request->all())
        ]);
    }

    public function show($id, Request $request)
    {
        $baby = $this->babyService->getOne(array_merge($request->all(), ['id' => $id]));
        return isset($baby) ? $this->successResponse(['baby' => $baby ]) : $this->badRequestResponse();
    }

    public function store(AddBabyRequest $request)
    {
        $baby = $this->babyService->add($request->validated());
        return isset($baby) ? $this->successResponse(['baby' => $baby]) : $this->serverErrorResponse();
    }

    public function update($id, UpdateBabyRequest $request)
    {
        $isUpdated = $this->babyService->update($id, $request->validated());
        return $isUpdated ? $this->updatedResponse() : $this->serverErrorResponse();
    }

    public function destroy($id)
    {
        $isDeleted = $this->babyService->delete($id);
        return $isDeleted ? $this->deletedResponse() : $this->badRequestResponse();
    }
}
