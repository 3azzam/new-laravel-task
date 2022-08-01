<?php


namespace App\Http\Services;

use App\Models\Baby;

class BabyService
{

    public function get($filters)
    {
        return Baby::filters($filters)->paginate(isset($filters['per_page']) ? (int) $filters['per_page'] : 10);
    }

    public function getOne($filters)
    {
        return Baby::filters($filters)->first();
    }


    public function add($data)
    {
        $baby = Baby::create($data);
        return $baby->fresh();
    }
}
