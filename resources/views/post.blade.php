<x-app-layout>

    <div class="container py-8">
        <h2 class=" text-4xl font-bold text-gray-600">
            {{ $post->name }}
        </h2>

        <div class=" text-xl text-gray-500 mb-2">
            {!! $post->extract !!}
        </div>

        <div class=" grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Contenido principal --}}
            <div class=" lg:col-span-2">
                <figure>
                    @if ($post->url_image)
                        <img class=" w-full h-80 object-cover object-center"
                            src="{{ Storage::url($post->url_image) }}" alt="">
                    @else
                        <img class=" w-full h-80 object-cover object-center"
                            src="https://cdn.pixabay.com/photo/2021/03/16/10/04/street-6099209_960_720.jpg" alt="">
                    @endif
                </figure>
                <div class=" text-lg text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>
            </div>

        </div>
    </div>

</x-app-layout>