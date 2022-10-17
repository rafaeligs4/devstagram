<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrerController extends Controller
{
  public function index(){
    return view('auth.register');
  } 
  public function store(Request $request){
    
   // dd('Post...');
 //  dd($request->get('name'));
//MOdificar valores
$request->request->add(['username'=> Str::slug($request->username)]);
    //validaciones
      $this->validate($request,[
      'name'=>'required|max:30',
      'username'=>'required|unique:users|min:3|max:30',
      'email'=>'required|unique:users|email|max:60',
      'password'=>'required|confirmed|min:6'  
      
    ]);
   // dd('Creando Usuario');
    //Para crear un nuevo registro, importamos la clase User 
    User::create([  //Esto es equivalente a un INSERT INTO 
      'name'=>$request->name,
      'username'=>$request->username, //Slug lo convierte en formato URL
      'email'=>$request->email,
      'password'=> Hash::make($request->password)
    ]);   
    //Autenticar un usuario
   /* auth()->attempt([
      'email'=>$request->email,
      'password'=>$request->password
        
    ]);*/
    //Otra forma de autenticar 
    auth()->attempt($request->only('email','password'));
    //Redireccionar pagina
    return redirect()->route('posts.index',$request->user());
  }
}
