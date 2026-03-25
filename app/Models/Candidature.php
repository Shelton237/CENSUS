<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'languages' => 'array',
        'previous_experience' => 'boolean',
        'birth_date' => 'date',
    ];
}
