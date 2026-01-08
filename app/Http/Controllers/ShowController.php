<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pokemon;

use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function store(Request $request, $id_pokemon){
        
        $pokemon = DB::table('pokemon')->where('id_pokemon', $id_pokemon)->first();

        $pokemon_region = DB::table('region')->join('pokemon', 'region.idRegion', '=', 'pokemon.idRegion')->where('pokemon.id_pokemon', $id_pokemon)->select('region.nameRegion')->first();

        $pokemons_types = DB::table('type')->join('pokemon_type', 'pokemon_type.id_type', '=', 'type.id_type')->join('pokemon', 'pokemon.id_pokemon', '=', 'pokemon_type.id_pokemon')->where('pokemon.id_pokemon', $id_pokemon)->select('type.name_type')->get();

        return view('/showPokemon', compact('pokemon', 'pokemon_region', 'pokemons_types'));
    }
}
