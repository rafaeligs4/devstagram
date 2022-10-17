<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
class ComentarioController extends Controller
{
    public function store(Request $request, User $user,Post $post){
       //Validar
      // dd($post->id);
        $this->validate($request,[
            'comentario' => 'required|max:255'
        ]);
       //Almacenar el resultado 
        Comentario::create([
            'user_id'=> auth()->user()->id,
            'post_id'=> $post->id,
            'comentario'=>$request->comentario
        ]);

       // Imprimir un mensaje
       return back()->with('mensaje','Comentario creado correctamente');
    }
}
