<x-app-layout>

    <div class="container py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($posts as $post)
                <article class="shadow-lg rounded-md w-full h-80 bg-cover bg-center @if ( $loop->first) md:col-span-2 @endif" style="background-image: url(@if($post->url_image) {{Storage::url($post->url_image)}} @else https://cdn.pixabay.com/photo/2021/03/16/10/04/street-6099209_960_720.jpg @endif)">

                    <div class=" w-full h-full flex flex-col justify-end">

                        <div class="w-full h-28 px-4 py-4 rounded-b-md" style="background-color: rgba(2, 53, 119, 0.856)">
                            <h2 class="w-auto text-xl @if ($loop->first) text-3xl @endif text-white leading-8 font-bold mb-2">
                                <a href="{{ route('posts.show', $post) }}">{{ Str::limit($post->name, 30, '...') }}</a>
                            </h2>
                            <p class=" text-indigo-200 text-base font-semibold @if ($loop->first) text-xl @endif">{{ Str::limit($post->extract, 75, '...') }}</p>
                        </div>

                    </div>

                </article>
                
            @endforeach

        </div>

    </div>

</x-app-layout>