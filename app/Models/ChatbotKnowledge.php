<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotKnowledge extends Model
{
    protected $table = 'chatbot_knowledge';

    protected $fillable = ['title', 'content', 'category', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];
}
