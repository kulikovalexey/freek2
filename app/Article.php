<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by',
        'description_short', 'description', 'image', 'image_show', 'meta_description', 'meta_keyword',
    ];

    /**
     * mutators
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    /**
     * polymorphic relation with categories
    */
    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }

    /**
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeLastArticles($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }
}
