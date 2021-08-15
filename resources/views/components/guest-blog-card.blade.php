<div class="flex flex-col justify-between w-full p-2 mx-auto border rounded-lg shadow-md bg-gray-50"
    x-data="{ showModal : false,profileModal : false }">
    <div>
        @if (!is_null($post->image))
        {{--postsテーブルのimageカラムに値が存在するか判定--}}
        <img class="object-center mx-auto rounded max-w-60 max-h-80" src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->image}}"
            {{--postsテーブルのimageカラムの値と同じ画像をiamgesフォルダから表示--}} alt="content" @click="showModal = !showModal">
        @else
        <img class="object-center mx-auto border-2 rounded max-w-60 max-h-80"
            src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/no_image_logo.png"
            {{--postsテーブルのimageカラムの値がnullならiamgesフォルダからno_image_logo.pngを表示--}} alt="content"
            @click="showModal = !showModal">
        @endif
    </div>


    <div>
        <p class="overflow-hidden text-lg font-medium text-indigo-500 overflow-ellipsis">
            {{ $post->title}}{{--タイトルを表示--}}
        </p>
        <div class="flex flex-row" @click="profileModal = !profileModal">
            <p class="my-auto text-lg text-gray-600">投稿者:{{ $post->user->name}}</p>
            {{--ユーザー名を表示--}}
            @if ($post->user->profile)
            {{--users.idと一致するprofilesのuser_idがあるか判定--}}
            {{--<img src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""
                class="items-center justify-center w-8 h-8 border-2 rounded-full">--}}
                <img src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->user->profile->icon }}" alt=""
                class="items-center justify-center w-8 h-8 border-2 rounded-full">
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
    {{--showModalの中身--}}
    <x-showModal :post="$post" />
    {{--profileModalの中身--}}
    <x-profileModal :post="$post" />

</div>