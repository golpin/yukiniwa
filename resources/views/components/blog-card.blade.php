<div class="w-full bg-gray-50 border p-6 rounded-lg mx-auto" x-data="{ showModal : false }">
    @if (!is_null($blog->image))
    <img class="h-60 w-auto  rounded object-center mx-auto"
    src="{{ asset('storage/images/'.$blog->image) }}" alt="content" @click="showModal = !showModal">
    @else
    <img class="h-60 w-auto rounded object-center  mx-auto"
    src="{{ asset('storage/images/'.'no_image_logo.png') }}" alt="content" @click="showModal = !showModal">
    @endif
    <h3 class="text-lg text-indigo-500 font-medium overflow-ellipsis overflow-hidden">
        {{ $blog->title}}
    </h3>

    <p class="text-gray-600  text-md">
            投稿者:{{ $blog->user->name}}
    </p>
    <p class="text-gray-600  text-sm">
        投稿日:{{ $blog->created_at->format('Y-m-d')}}
    </p>

    

    <!-- Modal Background -->
    <div x-show="showModal" class="fixed text-gray-600 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showModal = !showModal">
        <!-- Modal -->
        <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-1/2 mx-10" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <!--image -->
            @if (!is_null($blog->image))
            <img class="max-h-96 rounded object-center mx-auto"
            src="{{ asset('storage/images/'.$blog->image) }}"  alt="content" >
            @else
            <img class="max-h-96  rounded object-center  mx-auto"
            src="{{ asset('storage/images/'.'no_image_logo.png') }}"  alt="content">
            @endif
            <!-- Title -->
            <h2 class="px-4 my-2 text-gray-800 text-2xl font-medium text-center">{{ $blog->title}}</h2>
            <!-- content 🍺 -->
            <p class="px-4 mb-2text-md text-gray-900 font-medium title-font ">
                {{ $blog->content}}
            </p>

            <!-- Buttons -->
            <div class="flex justify-between bt-2 w-1/2 mx-auto">
                @if($blog->user_id == Auth::id())
                <form action="{{ route('user.edit',$blog->id) }}" method="GET">
                    <div class="flex flex-row-reverse">
                        @csrf
                        <button type="submit"
                            class="focus:outline-none text-white text-sm py-2 px-2 mr-1 rounded-lg bg-yellow-400 hover:bg-yellow-500 hover:shadow-lg flex items-center">
                            更新
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
        
                <form action="{{ route('user.delete',$blog->id) }}" method="POST" onsubmit="return checkDelete()">
                    <div class="flex flex-row-reverse">
                        @csrf
                        <button type="submit"
                            class="focus:outline-none text-white text-sm py-2 px-2 rounded-lg bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
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
                @else
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
    }
</script>


