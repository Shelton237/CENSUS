<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = [
        'platform',
        'platform_name',
        'user',
        'handle',
        'date',
        'content',
        'image',
        'likes',
        'comments',
        'shares',
        'link',
        'order'
    ];
}
