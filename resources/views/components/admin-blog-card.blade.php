<div class="flex flex-col justify-between w-full p-2 mx-auto border rounded-lg shadow-md bg-gray-50"
    x-data="{ showModal : false,profileModal : false }">
    <div>
        @if (!is_null($post->image))
        {{--postsテーブルのimageカラムに値が存在するか判定--}}
        <img class="object-center mx-auto rounded max-w-60 max-h-80" src="{{ asset('storage/images/'.$post->image) }}"
            {{--postsテーブルのimageカラムの値と同じ画像をiamgesフォルダから表示--}} alt="content" @click="showModal = !showModal">
        @else
        <img class="object-center mx-auto rounded max-w-60 max-h-80"
            src="{{ asset('storage/'.'no_image_logo.png') }}"
            {{--postsテーブルのimageカラムの値がnullならiamgesフォルダからno_image_logo.pngを表示--}} alt="content"
            @click="showModal = !showModal">
        @endif
    </div>

    <div>
        <h3 class="overflow-hidden text-lg font-medium text-indigo-500 overflow-ellipsis">
            {{ $post->title}}{{--タイトルを表示--}}
        </h3>
        <div class="flex flex-row" @click="profileModal = !profileModal">
            <p class="text-lg text-gray-600">投稿者:{{ $post->user->name}}</p>
            {{--ユーザー名を表示--}}
            @if ($post->user->profile)
            {{--users.idと一致するprofilesのuser_idがあるか判定--}}
            <img src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""
                class="items-center justify-center w-8 h-8 rounded-full">
            {{--profilesテーブルにusers.idと一致するprofiles.user_idがある場合、iconカラムの画像を表示する。値が無い場合は何も表示されない--}}
            @endif
        </div>
        <p class="text-gray-600 text-md">
            ゲレンデ:{{ $post->ski_resort->name}}
            {{--posts.ski_resort_idと一致するidのski_resorts.nameを表示--}}
        </p>
        <div class="flex justify-between">
            <p class="text-sm text-gray-600">
                投稿日:{{ $post->created_at->format('Y-m-d') }}
                {{--投稿日の表示--}}
            </p>

            <div class="flex">
                <button type="button">
                    <svg class="w-6 h-6 mr-2 text-yellow-500 fill-current" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>
                <span>
                    {{$post->like->count()}}
                </span>
            </div>
        </div>
    </div>

    <x-profileModal :post="$post" />

    <!-- Modal Background -->
    <div x-show="showModal" class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-600 bg-black bg-opacity-40" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showModal = !showModal">
        <!-- Modal -->
        <div x-show="showModal" class="p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-1/2" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <!--image -->
            @if (!is_null($post->image))
            <img class="object-center mx-auto rounded max-h-96"
            src="{{ asset('storage/images/'.$post->image) }}"  alt="content" >
            @else
            <img class="object-center mx-auto rounded max-h-96"
            src="{{ asset('storage/images/'.'no_image_logo.png') }}"  alt="content">
            @endif
            <!-- Title -->
            <h2 class="px-4 my-2 text-2xl font-medium text-center text-gray-800">{{ $post->title}}</h2>
            <!-- content 🍺 -->
            <p class="px-4 mb-4 font-medium text-gray-900 mb-2text-md title-font">
                {{ $post->content}}
            </p>

            <!-- Buttons -->
            <div class="flex justify-between w-2/3 mx-auto bt-2">
                    <div class="flex flex-row-reverse ">
                        @csrf
                        <button type="button"　disabled
                            class="flex items-center px-2 py-2 mr-2 text-sm text-white bg-yellow-400 rounded-lg focus:outline-none hover:bg-gray-600 hover:shadow-xl">
                            更新不可
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                </path>
                            </svg>
                        </button>
                    </div>

                <form action="{{ route('user.delete',$post->id) }}" method="POST" onsubmit="return checkDelete()">
                    <div class="flex flex-row-reverse ">
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


