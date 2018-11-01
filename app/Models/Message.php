<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'content',
    ];
}
