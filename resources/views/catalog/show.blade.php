<x-app-layout>
    <div class="flex justify-center mt-5">
        <div class="flex p-4 gap-4 w-3/6 items-center justify-center bg-[#ccc]/10 border border-gray-600 rounded-md">
            <img src="{{$movie->poster}}" class="w-1/3"/>
            <div class="w-2/3 text-gray-200">
                <h2 class="text-4xl">{{$movie->title}}</h2>
                <h3 class="text-xl">Año: {{$movie->year}}</h3>
                <h3 class="text-xl">Director: {{$movie->director}}</h3>
                <p class="mt-6">
                    <span class="font-bold">Resumen: </span>
                    {{$movie->synopsis}}
                </p>
                <p class="mt-6">
                    <span class="font-bold">Estado: </span>
                    {{!$movie->rented ? 'Disponible para alquilar' : 'Película actualmente alquilada'}}
                </p>
                <div class="mt-6 flex flex-wrap gap-1">
                    @if($movie->rented)
                        <form action="{{ url('catalog/return/'.$id) }}" method="POST">
                            @method('PUT')
                            @csrf
                                Devolver película
                            <x-primary-button class="bg-green-600 text-white">
                            </x-primary-button>
                        </form>
                    @else
                        <form action="{{ url('catalog/rent/'.$id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <x-primary-button class="bg-green-600 text-white">
                                Alquilar película
                            </x-primary-button>
                        </form>
                    @endif
                    <x-primary-button class="bg-orange-400 text-white">
                       <x-nav-link href="{{url('catalog/edit/'.$id)}}">Editar película</x-nav-link>
                    </x-primary-button>
                    <form action="{{ url('catalog/delete/'.$id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-primary-button class="bg-red-600 text-white">
                            Borrar película
                        </x-primary-button>
                    </form>
                    <x-primary-button>
                        <x-nav-link href="{{url('catalog/')}}">Volver al listado</x-nav-link>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
