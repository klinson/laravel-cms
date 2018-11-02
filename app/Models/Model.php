<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $perPage = 10;

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
