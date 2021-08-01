<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-14">
            <div class="mx-2 overflow-hidden rounded-lg shadow-md">
                <div class="p-2 bg-blue-100 border-b border-gray-200">
                    @if (session('err_msg'))
                    <p class="w-1/3 mx-auto text-lg text-center bg-green-400 rounded-lg">
                        {{ session('err_msg') }}
                    </p>
                    @endif

                    {{--プロフィール内容--}}
                        <div class="flex flex-col items-center w-full px-4 py-24 mx-auto sm:flex-row sm:justify-between">
                            <div class="w-full mb-8 sm:w-1/2 md:mb-0 ">
                                @if (!is_null($profile))
                                <img class="object-cover object-center w-64 h-64 p-2 mx-auto bg-white rounded-full lg:w-96 lg:h-96"
                                src="{{ asset('storage/icons/'.$profile->icon) }}"  alt="content" >
                                @else
                                <img class="object-cover object-center w-64 h-64 p-2 mx-auto rounded-full lg:w-96 lg:h-96"
                                src="{{ asset('storage/images/'.'no_image_logo.png') }}"  alt="content">
                                @endif
                            </div>
                            
                            
                            <div
                                class="flex flex-col items-center mx-auto text-center md:w-1/2 md:text-left">
                                <h2 class="mb-4 text-3xl font-medium text-gray-900 title-font sm:text-4xl">
                                    {{ $user->name }}
                                </h2>
                                @if ($profile){{--認証されたユーザーのidと一致するprofilesテーブルのuser_id--}}
                                <p class="mb-2 leading-relaxed text-md">
                                    お気に入りのスキー場
                                </p>
                                <p class="mb-4 text-xl leading-relaxed">
                                    {{ $profile->ski_resort->name }}
                                </p>
                                <p class="mb-2 leading-relaxed text-md">
                                    プロフィール
                                </p>
                                <p class="mb-2 text-lg leading-relaxed">
                                    {{ $profile->content }}
                                </p>
                                
                                @else
                                <p class="mb-4 text-xl leading-relaxed">
                                    お気に入りのスキー場：まだ登録されていません
                                </p>
                                <p class="mb-8 text-xl leading-relaxed">
                                    自己紹介:まだ登録されていません
                                    @endif
                                </p>
                                <div class="flex justify-center">
                                    @if (!is_null($profile))
                                    <form action="{{ route('user.profile.edit',$profile->id) }}" method="GET">
                                        <div class="flex flex-row-reverse">
                                            <button type="submit"
                                                class="inline-flex px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                                プロフィールを編集
                                                <svg class="items-center w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
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
                                                class="inline-flex px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                                プロフィールを編集
                                                <svg class="items-center w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
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
                    {{--プロフィール内容ここまで--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>