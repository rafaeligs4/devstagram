@extends('layouts.app')

@section('titulo')
Actualizar perfil de: {{auth()->user()->username}}
@endsection

@section('contenido')
<div class="md:flex md:justify-center ">
    <div class="md:w-1/2 bg-white shadow p-6 ">
        <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data">
            @csrf    
              @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> 
                    {{session('mensaje')}}
                </p>
            @endif
            <div class="mt-10 md:mt-0 mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Agrega el nombre de usuario</label>
                    <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu nombre de usuario"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value={{auth()->user()->username}}
                    />
                    
                 @error('name')
                 <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}
                 </p>
                 @enderror
              </div>
              <div class="mt-10 md:mt-0 mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Agrega el correo electronico</label>
                    <input
                    id="email"
                    name="email" 
                    type="text" 
                    placeholder="Tu correo electronico"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{auth()->user()->email}}"
                    />
                    
                 @error('name')
                 <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}
                 </p>
                 @enderror
              </div>
              
              <div class="mt-10 md:mt-0 mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                   Password actual</label>
                    <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password actual"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
            
                    />
                    
                 @error('name')
                 <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}
                 </p>
                 @enderror
              </div>
              <div class="mt-10 md:mt-0 mb-5">
                <label for="password_new"" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password nuevo</label>
                    <input
                    id="password_new"
                    name="password_new""
                    type="password"
                    placeholder="Password actual"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                   
                    />
                    
                 @error('name')
                 <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}
                 </p>
                 @enderror
              </div>
              <div class="mt-10 md:mt-0 mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cambia la imagen</label>
                    <input
                    id="imagen"
                    name="imagen"
                    type="file"
                    accept=".png, .jpg, .jpeg"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    
                    />
                    
                 @error('name')
                 <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{$message}}
                 </p>
                 @enderror
              </div>
              <input
          type="submit"
          value="Guardar Cambios"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" 
          />
            </form>

    </div>
 
</div>   
@endsection