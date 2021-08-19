<div class="flex flex-col justify-between w-full p-2 mx-auto border rounded-lg shadow-md bg-gray-50"
    x-data="{ showModal : false,profileModal : false }">
    <div>
        @if (!is_null($post->image))
            {{-- postsテーブルのimageカラムに値が存在するか判定 --}}
            <img class="object-center mx-auto rounded max-w-60 max-h-80"
                src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->image }}" alt=""
                @click="showModal = !showModal">
            {{-- <img class="object-center mx-auto rounded max-w-60 max-h-80" src="{{ asset('storage/images/'.$post->image)}}"
        alt="" @click="showModal = !showModal"> --}}
            {{-- <img class="object-center mx-auto rounded max-w-60 max-h-80" src="https://バケット名.s3.リージョン.amazonaws.com/{{ $post->image}}"
        alt="" @click="showModal = !showModal"> --}}
            {{-- postsテーブルのimageカラムの値と同じ画像を表示 --}}
        @else
            <img class="object-center mx-auto border-2 rounded max-w-60 max-h-80"
                src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/no_image_logo.png" alt=""
                @click="showModal = !showModal">
            {{-- <img class="object-center mx-auto border-2 rounded max-w-60 max-h-80" 
        src="https://バケット名.s3.リージョン.amazonaws.com/no_image_logo.png" alt="" @click="showModal = !showModal"> --}}
            {{-- <img class="object-center mx-auto rounded max-w-60 max-h-80" src="{{ asset('storage/images/'.no_image_logo.png)}}"
        alt="" @click="showModal = !showModal"> --}}
        @endif
    </div>


    <div>
        <p class="overflow-hidden text-lg font-medium text-indigo-500 overflow-ellipsis">
            {{ $post->title }}
            {{-- タイトルを表示 --}}
        </p>
        <div class="flex flex-row" @click="profileModal = !profileModal">
            <p class="my-auto text-lg text-gray-600">投稿者:{{ $post->user->name }}</p>
            {{-- ユーザー名を表示 --}}
            @if ($post->user->profile)
            {{-- users.idと一致するprofilesのuser_idがあるか判定 --}}
                <img src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->user->profile->icon }}"
                    alt="" class="items-center justify-center w-8 h-8 border-2 rounded-full">
                {{-- <img src="https://バケット名.s3.リージョン.amazonaws.com/{{ $post->user->profile->icon }}" alt=""
                class="items-center justify-center w-8 h-8 border-2 rounded-full"> --}}
                {{-- <img src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""
                class="items-center justify-center w-8 h-8 border-2 rounded-full"> --}}
            @endif
        </div>
        <p class="text-gray-600 text-md">
            ゲレンデ:{{ $post->ski_resort->name }}
            {{-- posts.ski_resort_idと一致するidのski_resorts.nameを表示 --}}
        </p>
        <div class="flex justify-between">
            <p class="text-sm text-gray-600">
                投稿日:{{ $post->created_at->format('Y-m-d') }}
                {{-- 投稿日の表示 --}}
            </p>

            <div class="flex">
                @if ($likes->where('post_id', $post->id)->first())
                    <form action="{{ route('user.unlike', $post) }}" method="POST">
                        @csrf
                        <button type="submit">
                            <svg class="w-6 h-6 text-pink-500 fill-current " fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </form>
                @else
                    <form action="{{ route('user.like', $post) }}" method="POST">
                        @csrf
                        <button type="submit">
                            <svg class="w-6 h-6 text-gray-400 fill-current" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </form>
                @endif
                <span class="mr-2">
                    {{ $post->like->count() }}
                </span>
            </div>
        </div>
    </div>
    {{-- showModalの中身 --}}
    <x-showModal :post="$post" />
    {{-- profileModalの中身 --}}
    <x-profileModal :post="$post" />
</div>
