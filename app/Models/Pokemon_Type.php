<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon_Type extends Model
{
    protected $table = 'pokemon_type';

    protected $casts = [
        'pokemon_type' => 'array',
    ];
}
