<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('index/img/pokedex-ico.png') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('index/css/styles.css') }}?v={{ time() }}">
    <title>Bienvenido a la Pokédex</title>
</head>
<body>
    <div class="header">
        <img src="{{ asset('index/img/pokedex-ico.png') }}" alt="Logo Pokédex" class="logo">
        <p id="texto-logo">
            Pokédex<br>
            World dex
        </p>

        <ul class="principal-menu">
            <li><a id="inicio" href="{{ url('/') }}">Inicio</a></li>
            <li><a id="pokemons" href="{{ url('/register') }}">Registrar Pokemón</a></li>
            <li><a id="tipos" href="{{ url('/registerRegion') }}">Registrar Región</a></li>
        </ul>
    </div>

    <div class="spacer-header">
        <div class="circle-pokemon1">
            <div class="circle-pokemon2">
                    <div class="circle-pokemon3"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 id = "tittle">Bienvenido a la Pokédex</h1>
    </div>

    <div class = "content">
        <img src="{{asset('index/img/gif-pikachu.gif')}}" class="gif-pikachu">
        <p>
            La Pokédex es una enciclopedia digital que contiene información sobre las diferentes especies de Pokémon. 
            Fue creada por el Profesor Oak para ayudar a los entrenadores Pokémon en su viaje.
        </p>

        <p>
            En esta Pokédex, encontrarás datos detallados sobre cada Pokémon, incluyendo su tipo, habilidades, estadísticas y evolución. 
            También podrás explorar imágenes y descripciones para conocer mejor a cada criatura.
        </p>

        <p>
            ¡Explora la Pokédex y descubre todo lo que necesitas saber sobre el mundo de los Pokémon!
        </p>

        <h2 id = "regiones">Regiones del mundo Pokemón</h2>

        <div class="containerdatabase">
            @foreach($regions as $region)
                <div class="card">
                    <a href="#" class="card-link">
                        <div class="details">
                            <img style="width: 225px; height: auto; border-radius: 5px;" src="{{ $region->imagen_url }}" class="region-image">
                            <span class="name">{{ $region->nameRegion }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h2 id="pokemones">Pokemones Registrados</h2>

        <div class="containerdatabase">
            @foreach($pokemons as $pokemon)
                <div class="card">
                    <a href="{{route('showPokemon.store', $pokemon->id_pokemon)}}" class="card-link">
                        <div class="details">
                            <img style="width: 225px; height: auto; border-radius: 5px" src="{{$pokemon->imagen_url}}" class="pokemon-image">
                            <span class="name">{{$pokemon->nombrePokemon}}</span>

                            <ul class="nav-menu">
                                <li class="point">
                                    <svg class="menu" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                    </svg>

                                    <ul>
                                        <li><a id="actualizar-pokemon" href="{{ route('update', $pokemon->id_pokemon) }}">Actualizar Pokemón</a></li>
                                        <li>
                                            <form action="{{ route('delete', $pokemon->id_pokemon) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button style="display: block; background-color: red; color: white; border-color: transparent; font-family: Georgia, 'Times New Roman', Times, serif; font-size: 95%; text-align: left" type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar a {{ $pokemon->nombrePokemon }}?')">
                                                Eliminar Pokemón
                                            </button>
                                        </form>
                                        </li>
                                    </ul>
                                </li> 
                            </ul>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <img id = "watermark" src="{{ asset('index/img/watermark.png') }}" alt="Watermark Pokéball" class="watermark-img">
    </div>

    <footer>
        <p>&copy; Created by Maykol D. 2025 Pokédex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>