<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('index/css/stylesform.css') }}?v={{ time() }}">
    <link rel="icon" type="img/png" href=" {{ asset('index/img/pokedex-ico.png') }}?v=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Actualizar Pokemón</title>
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

    <form action=" {{route('update.store', $pokemon->id_pokemon)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre Pokemón:</label><br>
            <input type="text" id="name" name="name" class="form-control" value="{{ $pokemon -> nombrePokemon }}" required>
        </div>

        <div class="form-group">
            <label for="number">Número en la pokedex:</label>
            <input type="number" id="number" name="number" min="0" class="form-control" value="{{ $pokemon -> numberPokemon }}" required>
        </div>

        <div class="form-group">
            <label for="region">Región de origen:</label>
            <select id="region" name="region" class="form-control">
                @foreach($regions as $region)
                    <option value="{{ $region->idRegion }}"> {{ $region->nameRegion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="type">Tipo de Pokemón:</label>
            <select id="type" name="types[]" class="form-control" multiple required>
                @foreach($types as $type)
                    <option value="{{ $type->id_type }}"> {{ $type->name_type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tamaño del Pokemón (en metros):</label>
            <input type="number" step="0.01" min="0" id="size" name="size" class="form-control" value="{{ $pokemon -> size }}" required>
        </div>

        <div class="form-group">
            <label for="type">Peso del Pokemón (en kilogramos):</label>
            <input type="number" step="0.01" min="0" id="weight" name="weight" class="form-control" value="{{ $pokemon -> weight }}" required>
        </div>

        <div class="form-group">
            <label for="type">Descripción del Pokemón:</label>
            <textarea id="description" name="description" class="form-control" required> {{ $pokemon-> description }} </textarea>
        </div>

        <div class="form-group">
            <label for="type">Imagen del Pokemón:</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn-primary">Actualizar Pokemón</button>
        
        <img id="watermark" src="{{ asset('index/img/watermark.png') }}" alt="Watermark Pokéball" class="watermark-img">
    </form>

    <footer>
        <p>&copy; Created by Maykol D. 2025 Pokédex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>