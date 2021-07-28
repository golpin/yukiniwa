<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-6">
            <div class="overflow-hidden shadow-md rounded-lg mx-2">
                <div class="p-2  bg-indigo-100 border-b border-gray-200">
                    @if (session('err_msg'))
                    <p class="bg-green-400 rounded-lg text-lg w-1/3 text-center mx-auto">
                        {{ session('err_msg') }}
                    </p>
                    @endif

                    {{--プロフィール内容--}}
                    <section class="text-gray-600 body-font">
                        <div class="w-full mx-auto flex px-4 py-24 sm:flex-row sm:justify-between flex-col items-center">
                            <div class="w-full  sm:w-1/2 mb-8 md:mb-0">
                                @if (!is_null($profile))
                                <img class="object-cover object-center rounded-full p-2 mx-auto lg:w-96 lg:h-96 w-64 h-64"
                                src="{{ asset('storage/icons/'.$profile->icon) }}"  alt="content" >
                                @else
                                <img class="object-cover object-center rounded-full p-2 mx-auto w-96 h-96"
                                src="{{ asset('storage/images/'.'no_image_logo.png') }}"  alt="content">
                                @endif
                            </div>
                            
                            
                            <div
                                class=" md:w-1/2  flex flex-col  md:text-left items-center text-center mx-auto">
                                <h2 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                                    {{ $user->name }}
                                </h2>
                                @if ($profile){{--認証されたユーザーのidと一致するprofilesテーブルのuser_id--}}
                                <p class="mb-4 leading-relaxed text-xl">
                                    お気に入りのスキー場：{{ $profile->ski_resort->name }}
                                </p>
                                <p class="mb-8 leading-relaxed text-xl">
                                    自己紹介文:{{ $profile->content }}
                                </p>
                                @else
                                <p class="mb-4 leading-relaxed text-xl">
                                    お気に入りのスキー場：まだ登録されていません
                                </p>
                                <p class="mb-8 leading-relaxed text-xl">
                                    自己紹介:まだ登録されていません
                                    @endif
                                </p>
                                <div class="flex justify-center">
                                    @if (!is_null($profile))
                                    <form action="{{ route('user.profile.edit',$profile->id) }}" method="GET">
                                        <div class="flex flex-row-reverse">
                                            <button type="submit"
                                                class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                プロフィールを編集
                                                <svg class="w-6 h-6 items-center" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                    @else
                                    <form action="{{ route('user.profile.create') }}" method="GET">
                                        <div class="flex flex-row-reverse">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                プロフィールを編集
                                                <svg class="w-6 h-6 items-center" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                    </section>
                    {{--プロフィール内容ここまで--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>