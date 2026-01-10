<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pokemon;
use App\Models\Pokemon_Type;
use Carbon\Traits\ToStringFormat;
use League\Uri\Http;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;

use function PHPSTORM_META\type;

class FormController extends Controller
{
    public function showForm()
    {
        $regions = \App\Models\Region::orderBy('generation', 'asc')->get();
        $types = \App\Models\Type::all();
        return view('register', compact('regions', 'types'));
    }

    public function store(Request $request)
    {
        $pokemon = new Pokemon();

        $newID = (string) Str::uuid();

        $pokemon->id_pokemon = $newID;
        $pokemon->nombrePokemon = $request->name;
        $pokemon->numberPokemon = $request->number;
        $pokemon->idRegion = $request->region;
        $pokemon->description = $request->description;
        $pokemon->size=$request->size;
        $pokemon->weight=$request->weight;

        if($request->hasFile('imagen')){
            $pokemon->imagen_url = $this->imagenDecode($request->file('imagen')->getRealPath());
        }

        $pokemon->save();

        $selectedTypes = $request->input('types');

        if ($selectedTypes){
            foreach($selectedTypes as $typeId){
                $pokemon->types()->attach($typeId, [
                    'id_pokemon_type' => (string) Str::uuid()
                ]);
            }
        }

        return redirect()->route('register')->with('success', 'Pokémon registrado exitosamente.');

    }

    public function procesedImagen($filePath)
    {
        $client = new Client();

        $tempPath = tempnam(sys_get_temp_dir(), 'removebd');

        $res = $client->post('https://api.remove.bg/v1.0/removebg', [
            'multipart' => [
                [
                    'name'     => 'image_file',
                    'contents' => fopen($filePath, 'r')
                ],
                [
                    'name'     => 'size',
                    'contents' => 'auto'
                ]
            ],
            'headers' => [
                'X-Api-Key' => config('services.romovebg.api_key'),
            ]
        ]);

        $fp = fopen($tempPath, "wb");
        fwrite($fp, $res->getBody());
        fclose($fp);

        return $tempPath;
    }

    public function imagenDecode($file)
    {
        if(!file_exists($file)){
            throw new \Exception("File not found: " . $file);
        }

        $imgPath = $this->procesedImagen($file);

        $img = Image::make($imgPath);

        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $encoded = $img->interlace()->encode('jpg', 60);

        return 'data:image/jpeg;base64,' . base64_encode($encoded);
    }
}
