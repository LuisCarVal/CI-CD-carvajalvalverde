<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catálogo') }}
        </h2>
    </x-slot>
    <div class="flex justify-center">
        <div class="flex flex-wrap justify-center gap-5 p-3 w-4/5">
            @foreach($catalog as $movie)
                <div class="text-center border w-96 inline-block border-gray-500 border-solid rounded-md p-3 bg-[#ccc]/10">
                    <x-nav-link href="{{url('/catalog/show/'.$movie->id)}}" class="flex flex-col gap-2">
                        <img src="{{$movie->poster}}" class=" w-18 h-[500px]" />
                        <h4 class="min-h-11 mt-3 mb-1 text-white text-xl">{{$movie->title}}</h4>
                    </x-nav-link>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
