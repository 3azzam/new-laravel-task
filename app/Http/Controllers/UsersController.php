<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPartnerRequest;
use App\Http\Services\PartnerService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $partnerService;

    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function index(Request $request)
    {
        return $this->successResponse($this->partnerService->get($request->all()));
    }

    public function addPartner($user_id, AddPartnerRequest $request)
    {
        $this->partnerService->addPartner(array_merge($request->validated(), ['user_id' => $user_id]));
        return $this->updatedResponse();
    }
}
