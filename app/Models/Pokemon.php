<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemon';

    protected $primaryKey = 'id_pokemon';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $timestamp = false;

    public function types()
    {
        return $this->belongsToMany(Type::class, 'pokemon_type', 'id_pokemon', 'id_type');
    }
}
