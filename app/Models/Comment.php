<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
