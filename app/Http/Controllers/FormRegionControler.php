<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;

use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules\Unique;

class FormRegionControler extends Controller
{
    public function showForm()
    {
        return view('registerRegion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imageRegion' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required',
            'generation' => 'required',
        ]);

        $region = new Region();
        $region->idRegion = Str::uuid();
        $region->nameRegion = $request->name;
        $region->generation = $request->generation;
        $region->description = $request->description;

        $region->imagen_url = $this->imagenDecode($request->file('imageRegion'));
        
        $region->save();
        return redirect()->route('registerRegion')->with('success', 'Región registrada exitosamente.');
    }

    public function imagenDecode($file){

        $img = Image::make($file->getRealPath());

        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $encoded = $img->interlace()->encode('jpg', 60);

        return 'data:image/jpeg;base64,' . base64_encode($encoded);
    }
}
