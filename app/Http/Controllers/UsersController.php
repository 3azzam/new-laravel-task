<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPartnerRequest;
use App\Http\Services\BabyService;
use App\Http\Services\PartnerService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $partnerService;
    protected $babyService;

    public function __construct(PartnerService $partnerService, BabyService $babyService)
    {
        $this->partnerService = $partnerService;
        $this->babyService = $babyService;
    }

    public function index(Request $request)
    {
        return $this->successResponse([
            'partners' => $this->partnerService->get($request->all())
        ]);
    }

    public function addPartner($user_id, AddPartnerRequest $request)
    {
        $this->partnerService->addPartner(array_merge($request->validated(), ['user_id' => $user_id]));
        return $this->updatedResponse();
    }

    public function listBabies($user_id)
    {
        $user = $this->partnerService->getOne(['id' => $user_id]);
        return $this->successResponse([
            'babies' => $this->babyService->get(['parent_ids' => [$user_id , $user->partner_id]])
        ]);
    }
}
