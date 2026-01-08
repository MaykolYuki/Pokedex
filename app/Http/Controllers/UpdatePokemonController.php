<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Type;
use App\Models\Pokemon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;


use function PHPSTORM_META\type;

class UpdatePokemonController extends Controller
{
    public function showForm($idPokemon){
        $regions = Region::Orderby('generation', 'asc')->get();
        $types = Type::all();
        $pokemon = DB::table('pokemon')->where('id_pokemon', $idPokemon)->first();

        return(view('updatePokemon', compact('regions', 'types', 'pokemon')));
    }

    public function store(Request $request, $idPokemon){
        $pokemon = Pokemon::findOrFail($idPokemon);

        $pokemon->nombrePokemon = $request->name;
        $pokemon->numberPokemon = $request->number;
        $pokemon->idRegion = $request->region;
        $pokemon->size = $request->size;
        $pokemon->weight = $request->weight;
        $pokemon->description = $request->description;
        
        if($request->hasFile('imagen')){
            $pokemon->imagen_url = $this->imagenDecode($request->file('imagen')->getRealPath());
        }

        $pokemon->save();

        $selectedTypes = $request->input('types');

        $syncData = [];
        foreach ($selectedTypes as $typeId) {
            $syncData[$typeId] = [
                'id_pokemon_type' => (string) Str::uuid()
            ];
        }

        $pokemon->types()->sync($syncData);

        return redirect()->route('update', $pokemon->id_pokemon)->with('success', 'Pokemón actualizado exitosamente');
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
                'X-Api-Key' => env('API_KEY'),
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
