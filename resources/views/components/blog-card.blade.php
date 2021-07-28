<div class="w-full bg-gray-50 border p-2 rounded-lg mx-auto shadow-md  flex flex-col justify-between"
    x-data="{ showModal : false,profileModal : false }">
    <div>
        @if (!is_null($post->image))
        {{--postsテーブルのimageカラムに値が存在するか判定--}}
        <img class="max-w-60 max-h-80  rounded object-center mx-auto" src="{{ asset('storage/images/'.$post->image) }}"
            {{--postsテーブルのimageカラムの値と同じ画像をiamgesフォルダから表示--}} alt="content" @click="showModal = !showModal">
        @else
        <img class="max-w-60 max-h-80 rounded object-center  mx-auto"
            src="{{ asset('storage/images/'.'no_image_logo.png') }}"
            {{--postsテーブルのimageカラムの値がnullならiamgesフォルダからno_image_logo.pngを表示--}} alt="content"
            @click="showModal = !showModal">
        @endif
    </div>


    <div>
        <h3 class="text-lg text-indigo-500 font-medium overflow-ellipsis overflow-hidden">
            {{ $post->title}}{{--タイトルを表示--}}
        </h3>
        <div class="flex flex-row" @click="profileModal = !profileModal">
            <p class="text-gray-600  text-lg">投稿者:{{ $post->user->name}}</p>
            {{--ユーザー名を表示--}}
            @if ($post->user->profile)
            {{--users.idと一致するprofilesのuser_idがあるか判定--}}
            <img src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""
                class="w-8 h-8 rounded-full items-center justify-center">
            {{--profilesテーブルにusers.idと一致するprofiles.user_idがある場合、iconカラムの画像を表示する。値が無い場合は何も表示されない--}}
            @endif
        </div>
        <p class="text-gray-600  text-md">
            ゲレンデ:{{ $post->ski_resort->name}}
            {{--posts.ski_resort_idと一致するidのski_resorts.nameを表示--}}
        </p>
        <p class="text-gray-600  text-sm">
            投稿日:{{ $post->created_at->format('Y-m-d')}}
            {{--投稿日の表示--}}
        </p>
    </div>
    {{--showModalの中身--}}
    <x-showModal :post="$post" />
    {{--profileModalの中身--}}
    <x-profileModal :post="$post" />

</div>