<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'id_type';
    public $incrementing = false;
    protected $keyType = 'string';

    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_type', 'id_pokemon', 'id_type');
    }
}
