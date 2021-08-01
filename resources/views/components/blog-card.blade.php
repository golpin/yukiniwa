<div class="flex flex-col justify-between w-full p-2 mx-auto border rounded-lg shadow-md bg-gray-50"
    x-data="{ showModal : false,profileModal : false }">
    <div>
        @if (!is_null($post->image))
        {{--postsテーブルのimageカラムに値が存在するか判定--}}
        <img class="object-center mx-auto rounded max-w-60 max-h-80" src="{{ asset('storage/images/'.$post->image) }}"
            {{--postsテーブルのimageカラムの値と同じ画像をiamgesフォルダから表示--}} alt="content" @click="showModal = !showModal">
        @else
        <img class="object-center mx-auto border-2 rounded max-w-60 max-h-80"
            src="{{ asset('storage/images/'.'no_image_logo.png') }}"
            {{--postsテーブルのimageカラムの値がnullならiamgesフォルダからno_image_logo.pngを表示--}} alt="content"
            @click="showModal = !showModal">
        @endif
    </div>


    <div>
        <h3 class="overflow-hidden text-lg font-medium text-indigo-500 overflow-ellipsis">
            {{ $post->title}}{{--タイトルを表示--}}
        </h3>
        <div class="flex flex-row" @click="profileModal = !profileModal">
            <p class="my-auto text-lg text-gray-600">投稿者:{{ $post->user->name}}</p>
            {{--ユーザー名を表示--}}
            @if ($post->user->profile)
            {{--users.idと一致するprofilesのuser_idがあるか判定--}}
            <img src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""
                class="items-center justify-center w-8 h-8 border-2 rounded-full">
            {{--profilesテーブルにusers.idと一致するprofiles.user_idがある場合、iconカラムの画像を表示する。値が無い場合は何も表示されない--}}
            @endif
        </div>
        <p class="text-gray-600 text-md">
            ゲレンデ:{{ $post->ski_resort->name}}
            {{--posts.ski_resort_idと一致するidのski_resorts.nameを表示--}}
        </p>
        <p class="text-sm text-gray-600">
            投稿日:{{ $post->created_at->format('Y-m-d')}}
            {{--投稿日の表示--}}
        </p>
    </div>
    {{--showModalの中身--}}
    <x-showModal :post="$post" />
    {{--profileModalの中身--}}
    <x-profileModal :post="$post" />

</div>