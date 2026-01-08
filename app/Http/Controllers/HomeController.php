<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Testing\Constraints\SeeInOrder;

class HomeController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::orderBy('numberPokemon', 'asc')->get();
        $regions = Region::orderBy('generation', 'asc')->get();
        return view('principal', compact('regions'), compact('pokemons'));
    }
}
