<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');           
    } 
   public function index(){
         return view('perfil.index');
  }

   public function store(Request $request){
    $this->validate($request,[
      'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:30'],
      'email' => ['required','unique:users,email,'.auth()->user()->id, 'email', 'max:60']
    
    ]);

    if($request->password || $request->password_new){
      if( ! Hash::check($request->password,auth()->user()->password) ){
        return back()->with('mensaje','credencial   incorrecta');
      }else{
        $this->validate($request,['password'=>'min:6']);
        $newP=$request->password_new;
      }

    }
    if($request->imagen){
            
        $imagen=$request->file('imagen');
        //Esta funcion se encarga de darle un nombre unico a una imagen
        $nombreimagen=Str::uuid().".".$imagen->extension();
            $imagenServidor=Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            
            $imagenPath= public_path('perfiles'). '/' . $nombreimagen; 
            $imagenServidor->save($imagenPath);
    }
      
        //almacenar informacion
        $user=User::find(auth()->user()->id);
        $user->username=$request->username ?? auth()->user()->username;
        $user->email=$request->email ?? auth()->user()->username;
        $user->imagen=$nombreimagen ?? null;
        $user->password=Hash::make($newP) ??  auth()->user()->password;
        $user->save();
    
         return redirect()->route('posts.index',$user); 
   } 


}
