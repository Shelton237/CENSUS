<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title_fr',
        'title_en',
        'content_fr',
        'content_en',
        'category',
        'image',
        'published_at',
        'slug',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the current locale title.
     */
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_fr;
    }

    /**
     * Get the current locale content.
     */
    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"content_{$locale}"} ?? $this->content_fr;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
