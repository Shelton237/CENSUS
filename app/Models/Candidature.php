<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'id_card_number',
        'phone',
        'email',
        'region',
        'city',
        'education_level',
        'languages',
        'has_smartphone',
        'fonctionnaire',
        'previous_experience',
        'experience_details',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
