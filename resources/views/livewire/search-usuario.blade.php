<div class="relative w-full max-w-sm mx-auto">
    <input wire:model.live="search"  style="width:300px" type="text" id="searchInput" class="w-full lg:w-96 xl:w-120 bg-gray-200 dark:bg-dim-400 border-gray-200 dark:border-dim-400 text-gray-100 focus:outline-none font-normal h-9 pl-12 text-sm rounded-full" placeholder="Buscar usuarios en Tecmunity">    
    
    <div class="mt-6 space-y-4">
        @foreach ($users as $user)
        <a href="{{ route('perfil.show', ['id' => $user->id]) }}">
            <div class="flex items-center p-4 bg-gray-800 hover:bg-gray-700 rounded-lg transition duration-300 ease-in-out cursor-pointer">
                @if($user->avatar)
                    <img id="profile_pic" class="w-12 h-12 rounded-full border-2 border-blue-500" src="{{ $user->avatar }}" />
                @else
                    <img id="profile_pic" class="w-12 h-12 rounded-full border-2 border-blue-500" src="{{ asset('img/default-avatar.jpg') }}" />
                @endif
                <div style="margin-right: 10px" class="ml-4">
                    <h1 style="color: white" class="text-xl text-gray-200 font-semibold">{{ $user->nombre }} {{ $user->apellido }}</h1>
                    <p style="color: white" class="text-sm text-gray-400">{{ $user->email }}</p>
                    <p style="color: white" class="text-sm text-blue-500">@ {{ $user->username }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
