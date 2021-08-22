<!-- Modal -->
<div x-data="{ test : false }" :class="{ '' : test , 'opacity-0' : !test }">>

    <!-- Modal Background -->
    <div x-show="test"
        class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-40"
        x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <!-- Modal -->
        <div x-show="test" class="p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-10/12" @click.away="test = false"
            x-transition:enter="transition ease duration-100 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease duration-100 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-1">

            <!--image -->
            @if (!is_null($post->image))
                <img class="object-center w-full h-auto mx-auto rounded"
                    src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="img">
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="{{ asset('storage/images/'.$post->image)}}" alt=""> --}}
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="https://バケット名.s3.リージョン.amazonaws.com/{{ $post->image}}" alt=""> --}}
            @else
                <img class="object-center w-full h-auto mx-auto rounded"
                    src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/no_image_logo.png" alt="no_img">
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="{{ asset('storage/images/'.no_image_logo.png)}}" alt=""> --}}
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="https://バケット名.s3.リージョン.amazonaws.com/no_image_logo.png" alt=""> --}}
            @endif
        </div>
    </div>
</div>
