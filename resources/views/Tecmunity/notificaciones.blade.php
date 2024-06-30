@extends('main')
@section('title', 'Notificaciones')
@section('contenido')
<div class="flex justify-between items-center border-b border-gray-200 px-4 py-3 sticky top-0 bg-white dark:bg-dim-900 dark:border-gray-700">
    <h4 class="text-gray-800 dark:text-gray-100 font-bold">
        Notificaciones
    </h4> 

    <span class="relative inline-block text-blue-500 text-lg font-bold">
        Tecmunity
    </span>
</div> 
<hr class="border-t-2 border-white my-4"> <br>

<div class="mt-4">
    <h1 style="font-size:25px" class="text-3xl text-white text-center">Tus Notificaciones {{ auth()->user()->nombre }}</h1> <br>
    <hr class="border-t-2 border-white my-4"> <br>

    @if ($notificaciones->count() > 0)
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach ($notificaciones as $notificacion)
            <div class="p-4 relative">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 relative">
                        <img class="h-10 w-10 rounded-full" src="{{ $notificacion->emisor->avatar ?? asset('img/default-avatar.jpg') }}" alt="{{ $notificacion->emisor->nombre }}">
                        @if($notificacion->leido)
                            <i class="fa-solid fa-check text-green-500 absolute top-1 right-1 text-lg"></i>
                        @else
                            <div class="absolute top-1 right-1 h-2 w-2 rounded-full bg-blue-500 notification-dot" data-notificacion-id="{{ $notificacion->id }}"></div>
                        @endif
                    </div> 
                    <div class="flex-1">
                        <div>
                            <span style="margin-left:30px" class="font-medium text-gray-800 dark:text-gray-100">{{ $notificacion->emisor->nombre }} {{ $notificacion->emisor->apellido }}</span>
                            <span class="text-gray-600 dark:text-gray-400"></span>
                        </div>
                        <p style="margin-left:30px" class="text-lg text-white">{{ $notificacion->tipo->descripcion }}</p>
                    </div>
                </div>
            </div>
            <br>
            <hr class="border-t-2 border-white my-4">
        @endforeach
    </div>
    {{ $notificaciones->links() }}
    @else
    <p class="text-gray-600 dark:text-gray-400 text-center mt-4">No tienes nuevas notificaciones.</p>
    @endif

</div>
<hr class="border-t-2 border-white my-4">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationDots = document.querySelectorAll('.notification-dot');

        notificationDots.forEach(dot => {
            const notificacionId = dot.dataset.notificacionId;
            dot.parentElement.addEventListener('mouseenter', function() {
                dot.classList.add('inactive'); // Al pasar el cursor, se desactiva el punto visualmente

                // Marcar como leída la notificación en la base de datos vía AJAX
                fetch(`/marcar-leido/${notificacionId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al marcar como leída la notificación.');
                    }
                    // Opcional: Actualizar el estado del punto visualmente sin recargar la página
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Manejar el error si es necesario
                });
            });

            dot.parentElement.addEventListener('mouseleave', function() {
                // Aquí puedes revertir cambios visuales si es necesario al sacar el cursor
            });
        });
    });
</script>

@endsection
