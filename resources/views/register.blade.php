<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('index/css/stylesform.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('index/img/pokedex-ico.png') }}?v=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Registra un nuevo pokemon en la pokedex</title>
</head>
<body>
    <div class="header">
        <img id="logo" src="{{ asset('index/img/pokedex-ico.png') }}" alt="Logo Pokédex" class="logo">
        <p id="texto-logo">
            Pokédex<br>
            World dex
        </p>

        <ul class="nav-menu">
            <li><a id="inicio" href="{{ url('/') }}">Inicio</a></li>
            
            <li>
                <a id="pokemons">Pokemón</a>

                <ul>
                    <li><a id="registrar-pokemon" href="{{ url('/register') }}">Registrar Pokemón</a></li>
                    <li><a id="actualizar-pokemon" href="{{ url('/') }}">Actualizar Pokemón</a></li>
                    <li><a id="eliminar-pokemon" href="{{ url('/') }}">Eliminar Pokemón</li>
                </ul>
            </li>
            <li>
                <a id="tipos">Región</a>
                
                <ul id="desplega">
                    <li><a id="registrar-region" href="{{ url('/registerRegion') }}">Registrar Región</a></li>
                    <li><a id="actualizar-region" href="{{ url('/') }}">Actualizar Región</a></li>
                    <li><a id="eliminar-region" href="{{ url('/') }}">Eliminar Región</a></li>
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

    <div class="container">
        <h1>Registrar un nuevo Pokémon</h1>
    </div>


    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Pokémon:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="number">Número en la pokedex:</label>
            <input type="number" id="number" name="number" min="0" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="region">Region de origen:</label>
            <select id="region" name="region" class="form-control" required>
                @foreach($regions as $region)
                    <option value="{{ $region->idRegion }}">{{ $region->nameRegion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="type">Tipo de Pokémon:</label>
            <select id="type" name="types[]" class="form-control" multiple required>
                @foreach($types as $type)
                    <option value="{{ $type->id_type }}">{{ $type->name_type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form--group">
            <label for="size">Tamaño del Pokémon (en metros):</label>
            <input type="number" step="0.01" id="size" name="size" min="0" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="weight">Peso del Pokémon (en kilogramos):</label>
            <input type="number" step="0.01" id="weight" name="weight" min="0" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Descripción del Pokémon:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Subir imagen del Pokémon:</label>
            <input type="file" id="imagen" name="imagen" class="form-control" required>
        </div>

        <button type="submit" class="btn-primary">Registrar Pokémon</button>

        <img id="watermark" src="{{ asset('index/img/watermark.png') }}" alt="Watermark Pokéball" class="watermark-img">
    </form>

    <footer>
        <p>&copy; Created by Maykol D. 2025 Pokédex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>