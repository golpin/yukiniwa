<div x-show="showModal" :class="{ 'opacity-100' : showModal , 'opacity-0' : !showModal }" class="opacity-0">
    <!-- Modal Background -->
    <div class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center overflow-auto bg-black bg-opacity-40"
        x-transition:enter="transition ease duration-300 z-0 " x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100 z-50" x-transition:leave="transition ease duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click = " showModal = !showModal ">
        <!-- Modal -->
        <div class="w-4/5 px-2 py-6 mx-2 bg-white shadow-2xl sm:mx-10 rounded-xl md:w-1/2"
            @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1 z-0"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0 z-50"
            x-transition:leave="transition ease duration-100 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <!--image -->
            @if (!is_null($post->image))
                <img class="object-center w-full h-auto mx-auto rounded"
                    src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="img" >
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="{{ asset('storage/images/'.$post->image)}}" alt=""> --}}
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="https://バケット名.s3.リージョン.amazonaws.com/{{ $post->image}}" alt=""> --}}
            @else
                <img class="object-center w-full h-auto mx-auto rounded"
                    src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/no_image_logo.png" alt="no_img">
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="{{ asset('storage/images/'.no_image_logo.png)}}" alt=""> --}}
                {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="https://バケット名.s3.リージョン.amazonaws.com/no_image_logo.png" alt=""> --}}
            @endif
            <!-- Title -->
            <h2 class="px-4 my-2 text-2xl font-medium text-center text-gray-800">{{ $post->title }}</h2>
            <!-- content  -->
            <p class="px-4 mb-4 text-lg font-medium text-center text-gray-900 title-font">
                {{ $post->content }}
            </p>
            <!-- Buttons -->
            <div class="flex justify-between w-1/2 mx-auto bt-2">
                @if ($post->user_id == Auth::id())
                    <form action="{{ route('user.edit', $post->id) }}" method="GET">
                        <div class="flex flex-row-reverse">
                            @csrf
                            <button type="submit"
                                class="flex items-center px-2 py-2 mr-1 text-sm text-white bg-yellow-400 rounded-lg focus:outline-none hover:bg-yellow-500 hover:shadow-lg">
                                更新
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('user.delete', $post->id) }}" method="POST"
                        onsubmit="return checkDelete()">
                        <div class="flex flex-row-reverse">
                            @csrf
                            <button type="submit"
                                class="flex items-center px-2 py-2 text-sm text-white bg-red-500 rounded-lg focus:outline-none hover:bg-red-600 hover:shadow-lg">
                                削除
                                <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function checkDelete() {
        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
