<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ImageController extends Controller
{
      public function store(Request $request){

//        $input=$request->all();

        $imagen=$request->file('file');
        //Esta funcion se encarga de darle un nombre unico a una imagen
        $nombreimagen=Str::uuid().".".$imagen->extension();
            $imagenServidor=Image::make($imagen);
            $imagenServidor->fit(1000,1000);

            $imagenPath= public_path('uploads'). '/' . $nombreimagen; 
            $imagenServidor->save($imagenPath);
        return response()->json(['imagen'=>$nombreimagen]);
      }
}
