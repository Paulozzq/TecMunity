@extends('main')

@section('title', 'Buscar Usuarios')

@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
       Buscar Usuarios de Tecmunity
    </h4>
    <span class="relative inline-block text-blue-500 text-lg font-bold">
        Tecmunity
    </span>
</div>
<br><br><br><br>
<div class="flex items-center justify-center mt-8">
    <div class="relative m-2">
        <i class="fa-solid fa-magnifying-glass text-gray-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
        <input  style="width:300px" type="text" id="searchInput" class="w-full lg:w-96 xl:w-120 bg-gray-200 dark:bg-dim-400 border-gray-200 dark:border-dim-400 text-gray-100 focus:outline-none font-normal h-9 pl-12 text-sm rounded-full" placeholder="Buscar usuarios en Tecmunity"/>

    </div>
</div>

<div id="searchResults" class="mt-4 px-4">
   
</div>

@endsection

@section('scripts')

@endsection
