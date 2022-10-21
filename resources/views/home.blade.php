
@extends('layouts.app')

@section('titulo')
Pagina Principal
@endsection
@section('contenido')

<!--Otra manera de hacer ciclos
    @  forelse($posts as $post)
<p>Si hay posts </p
@ empty
<p>No hay posts </p
 @ endforelse --> 

@auth
<x--listar-post :posts="$posts"/>
@endauth   

@endsection 