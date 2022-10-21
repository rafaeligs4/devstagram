<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth')->except([
      'show','index'
    ]);         
    }
    public function index(User $user){
      //  dd($user);
   //   $post=Post::where('user_id',$user->id)->get();
   $post=Post::where('user_id',$user->id)->latest()->paginate(10);
   //   dd($post);
   //Retornando estas variables en la vista dashboard
       return(view('dashboard',[
        'user'=> $user,
        'posts'=>$post

       ]));
    }
    public function create(){ 

     return(view('posts.create'));
    }
    public function store(Request $request){


     $this->validate($request,[
      'titulo'=> 'required|max:255',
      'descripcion'=>'required',
      'imagen'=>'required'
     ]);
    //  Post::create([
    //   'titulo'=>$request->titulo,
    //   'descripcion'=>$request->descripcion,
    //   'imagen'=>$request->imagen,
    //   'user_id'=>auth()->user()->id
    //  ]);
     //Segunda manera de crear un registro
    //  $post=new Post;
    //  $post->titulo=$request->titulo;
    //  $post->descripcion=$request->descripcion;
    //  $post->imagen=$request->imagen;
    //  $post->user_id=auth()->user()->id;
    //  $post->save(); 
    //Tercera alternativa de crear un registro en la base de datos
    $request->user()->posts()->create([
       
      'titulo'=>$request->titulo,
      'descripcion'=>$request->descripcion,
      'imagen'=>$request->imagen,
      'user_id'=>auth()->user()->id
    ]); 
    return redirect()->route('posts.index',auth()->user()->username);
    
    }


    public function show(User $user,Post $post){

      return view('posts.show',[
        'post'=>$post,
        'user'=> $user
      ]);
    }
   public function destroy(Post $post){
    $this->authorize('delete',$post);
    $post->delete();
    
    //Eliinando la imagen
    $imagen_path= public_path('uploads/' . $post->imagen);
    if(File::exists($imagen_path)){
       unlink($imagen_path);
    }
    return redirect()->route('posts.index',auth()->user()->username);
  //  dd('eliminando',$post->id);
   }
}
