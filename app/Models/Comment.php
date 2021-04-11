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
        return $this->belongsTo(User::class)->withDefault([
            'name' => '【用户不存在】'
        ]);
    }

    public function article()
    {
        return $this->belongsTo(Article::class)->withDefault([
            'title' => '【文章已删除】'
        ]);
    }
}
