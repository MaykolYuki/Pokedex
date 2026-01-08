<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{asset('index/img/pokedex-ico.png')}}?v=1.0">
    <link rel="stylesheet" href="{{asset('index/css/styleshow.css')}}?v={{ time() }}">
    
    <title>{{$pokemon->nombrePokemon}}</title>
</head>
<body>
    <div class="header">
        <img src="{{asset('index/img/pokedex-ico.png')}}" alt="Logo Pokédex" class="logo">
        <p id="texto-logo">
            Pokedex<br>
            World dex
        </p>

        <ul class="nav-menu">

            <li><a id = "inicio" href = "{{ url('/') }}">Inicio</a></li>
            <li>
                <a id = "pokemons">Pokemón</a>
                
                <ul>
                    <li><a id="registrar-pokemon" href="{{ url('/register') }}">Registrar Pokemón</a></li>
                    <li><a id="actualizar-pokemon" href="{{ url('/') }}">Actualizar Pokemón</a></li>
                    <li><a id="eliminar-pokemon" href="{{ url('/') }}">Eliminar Pokemón</a></li>
                </ul>
            </li>
            <li>
                <a id="tipos">Región</a>

                <ul>
                    <li><a id="registrar-region" href="{{ url('/registerRegion') }}">Registrar Región</a></li>
                    <li><a id="actualizar-region" href="{{ url('/') }}">Actualizar Región</a></li>
                    <li><a id="eliminar-pokemon" href="{{ url('/') }}">Eliminar Pokemón</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="spacer-header">
        <div class="circle-pokemon1">
            <div class="circle-pokemon2">
                    <div class="circle-pokemon3"></div>
            </div>
        </div>
    </div>

    <div class="general">
        <div class="tittle">
            <h1>Nombre</h1>
            <h2>{{$pokemon->nombrePokemon}}</h2>
        </div>

        <div class="types">
            <h1>Tipos</h1>
            <h2>
                @foreach($pokemons_types as $pokemon_type)
                    {{$pokemon_type->name_type}}<br>
                @endforeach
            </h2>
        </div>

        <div class="numer">
            <h1>Número en la pokedex</h1>
            <h2>{{$pokemon->numberPokemon}}</h2>
        </div>

        <div class="measure">
            <h1>Peso del Pokemón</h1>
            <h2>{{$pokemon->weight}} kg</h2>
            
            <h1>Tamaño del pokemón</h1>
            <h2>{{$pokemon->size}} m</h2>
        </div>

        <div class="region">
                <h1>Región de origen</h1>
                <h2>{{$pokemon_region->nameRegion}}</h2>
        </div>

        <div class="description">
            <h1 id="description-title">Descripción</h1>
            <h2>{{$pokemon->description}}</h2>
        </div>  

        <div class="image">
        <img src="{{$pokemon->imagen_url}}" class="pokemon-image">
        </div>
    </div>

    <footer>
        <p>&copy; Created by Maykol D. 2025 Pokédex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>