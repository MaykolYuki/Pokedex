<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class DeletePokemonController extends Controller
{
    public function deletePokemon($id_pokemon){
        $pokemon=Pokemon::findOrFail($id_pokemon);

        if($pokemon){
            $pokemon->delete();
            return redirect('')->with('success', 'Pokemón eliminado correctamente');
        }

        return redirect('')->with('error', 'No se econtro Pokemón');
    }
}
