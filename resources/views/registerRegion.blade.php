<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('index/img/pokedex-ico.png') }}?v=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('index/css/stylesform.css') }}?v={{ time() }}">
    <title>Registrar Región</title>
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
                    <li><a id="actualizar-pokemon" href="{{ url('/') }}"> Actualizar Pokemón</a></li>
                    <li><a id="eliminar-pokemón" href="{{ url('/') }}">Eliminar Pokemón</a></li>
                </ul>
            </li>

            <li>
                <a id="tipos2">Región</a>
                
                <ul>
                    <li><a id="registrar-region" href="{{ url('/registerRegion') }}">Registrar Región</a></li>
                    <li><a id="actualizar-region" href="{{ url('/') }}">Actualizar Pokemón</a></li>
                    <li><a id="eliminar-region" href="{{ url('/') }}">Eliminar Pokemón</a></li>
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
        <h1>Registrar una nueva Región</h1>
    </div>

    <form action="{{ route('registerRegion.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        <div class="form-group">
            <label for="name">Nombre de la Región:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="generation">Generación:</label>
            <input style="width: 200px;" type="number" id="generation" name="generation" min="1" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea id="descriptio" name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="imageRegion">Imagen de la Región:</label>
            <input type="file" id="imageRegion" name="imageRegion" class="form-control" required>
        </div>

        <button style="margin-top: 10px;" type="submit" class="btn-primary">Registrar Región</button>

        <img id="watermark" src="{{ asset('index/img/watermark.png') }}" alt="Watermark Pokéball" class="watermark-img">
    </form>

    <footer>
        <p>&copy; Created by Maykol D. 2025 Pokédex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>