<x-app-layout>
    <div class="flex justify-center mt-5">
        <div class="flex flex-col border border-gray-700 p-6 rounded-md">
            <h2 class="text-white text-4xl mb-6">Crear Película</h2>
            <form class="flex flex-col gap-2" method="POST" action="{{ url('catalog/create') }}">
                @csrf

                <x-input-label for="title">Título: </x-input-label>
                <x-text-input id="title" name="title" value="{{ old('title') }}"></x-text-input>
                @error('title')
                    <span class="text-red-500 input-error"> {{ $message }} </span>
                @enderror

                <x-input-label for="year">Año: </x-input-label>
                <x-text-input id="year" name="year" value="{{ old('year') }}"></x-text-input>
                @error('year')
                <span class="text-red-500 input-error"> {{ $message }} </span>
                @enderror

                <x-input-label for="director">Director: </x-input-label>
                <x-text-input id="director" name="director" value="{{ old('director') }}"></x-text-input>
                @error('director')
                <span class="text-red-500 input-error"> {{ $message }} </span>
                @enderror

                <x-input-label for="poster">Poster: </x-input-label>
                <x-text-input id="poster" name="poster" value="{{ old('poster') }}"></x-text-input>
                @error('poster')
                <span class="text-red-500 input-error"> {{ $message }} </span>
                @enderror

                <x-input-label for="synopsis">Sinopsis: </x-input-label>
                <x-text-input id="synopsis" name="synopsis" value="{{ old('synopsis') }}"></x-text-input>
                @error('synopsis')
                <span class="text-red-500 input-error"> {{ $message }} </span>
                @enderror

                <x-primary-button class="mt-4 w-fit bg-red-600">
                    Crear película
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
