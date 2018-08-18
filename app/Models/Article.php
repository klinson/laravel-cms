<?php

namespace App\Models;

use App\Models\Traits\IntTimestampsHelper;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use IntTimestampsHelper, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'author', 'publish_time', 'sort', 'has_enabled', 'is_top', 'pv'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_has_articles', 'article_id', 'category_id');
    }

    protected static function boot()
    {
        static::deleting(function ($model) {
            $model->categories()->detach();
        });
        parent::boot();
    }
}
