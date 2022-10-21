<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    public function   __invoke(){

        //Obtener a quienes seguimos
        //pluck trae ciertos campos
      $ids= auth()->user()->followingUser->pluck('id')->toArray();  

      $posts=Post::whereIn('user_id',$ids)->latest()->paginate(20);
       
       return view('home',['posts'=>$posts]);
    } 
} 
