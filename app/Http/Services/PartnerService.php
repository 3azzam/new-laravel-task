<?php

namespace App\Http\Services;

use App\Models\User;

class PartnerService
{

    public function get($filters)
    {
        return User::with('partner')->filters($filters)->paginate(isset($filters['per_page']) ? (int) $filters['per_page'] : 10);
    }

    public function getOne($filters)
    {
        return User::with('partner')->filters($filters)->first();
    }

    public function add($data)
    {
        $user = User::create($data);
        return $user->fresh();
    }

    public function addPartner($data)
    {
        $partner1 = User::find($data['user_id'])->update(['partner_id' => $data['partner_id']]);
        $partner2 = User::find($data['partner_id'])->update(['partner_id' => $data['user_id']]);
        return [
            'user' => $partner1,
            'partner' =>  $partner2
        ];
    }
}
