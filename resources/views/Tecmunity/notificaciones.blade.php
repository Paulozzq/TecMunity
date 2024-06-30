@extends('main')
@section('title', 'Notificaciones')
@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
        Notificaciones
    </h4>
    <span class="relative inline-block text-blue-500 text-lg font-bold">
        <!-- Cambiado solo el nombre de la clase a 'iconT' -->
        Tecmunity
    </span><!-- Font Awesome Twitter icon -->
</div>

<div class="mt-4">
    @if ($notificaciones->count() > 0)
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($notificaciones as $notificacion)
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ $notificacion->emisor->avatar_url }}" alt="{{ $notificacion->emisor->name }}">
                        </div>
                        <div class="flex-1">
                            <div>
                                <span class="font-medium text-gray-800 dark:text-gray-100">{{ $notificacion->emisor->name }}</span>
                                <span class="text-gray-600 dark:text-gray-400">{{ $notificacion->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $notificacion->tipo->descripcion }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $notificaciones->links() }}
    @else
        <p class="text-gray-600 dark:text-gray-400 text-center mt-4">No tienes nuevas notificaciones.</p>
    @endif
</div>
@endsection
