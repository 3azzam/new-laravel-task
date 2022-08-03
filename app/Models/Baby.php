<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'parent_id'
    ];

    public function scopeFilters($query, $filters)
    {

        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        if(isset($filters['parent_ids'])) {
            $query->whereIn('parent_id', $filters['parent_ids']);
        }
        
        return $query;
    }
}
