<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('投稿編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-16 ">
            <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="px-2 py-4 bg-indigo-100 border-b border-gray-200">
                    <h2 class="w-3/4 mx-auto text-xl text-center border-b-2 border-indigo-500 sm:w-1/3">投稿編集フォーム</h2>
                    <form action="{{ route('user.update',$post->id) }}" method="POST" onsubmit="return checkSubmit()"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="w-3/4 p-2 mx-auto">
                            <div class="relative">
                                <label for="title" class="text-lg leading-7 text-gray-800">タイトル</label>
                                <input type="text" id="title" name="title" value="{{ $post->title }}" required
                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-100 border border-gray-300 rounded outline-none bg-gray-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            </div>
                        </div>
                        <div class="w-3/4 p-2 mx-auto">
                            <div class="relative">
                                <label for="content" class="text-lg leading-7 text-gray-800">本文</label>
                                <textarea rows="6" id="content" name="content" value="{{ old($post->content) }}"
                                    required
                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-100 border border-gray-300 rounded outline-none bg-gray-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">{{ $post->content }}</textarea>
                            </div>
                        </div>
                        <div class="w-3/4 p-2 mx-auto">
                            <div class="relative ">
                                <label for="ski_resort_id" class="text-lg leading-7 text-gray-800">ゲレンデ：</label>
                                <select name="ski_resort_id" id="ski_resort_id" class="px-3 py-1 text-lg leading-8 text-gray-700 transition-colors duration-200 ease-in-out border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                    @foreach ($ski_resorts as $ski_resort)
                                    <option value="{{ $ski_resort->id}}">
                                        {{ $ski_resort->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-3/4 p-2 mx-auto">
                            <div class="relative">
                                <label for="image" class="text-lg leading-7 text-gray-800">画像</label>
                                <input type="file" name="image" id="image" name="image"
                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-100 border border-gray-300 rounded outline-none bg-gray-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                <p>拡張子はjpg・jpeg・png限定。ファイルサイズの上限は3MB</p>
                            </div>
                        </div>
                        <div class="flex justify-around w-full p-2 mt-4">
                            <button type="button" onclick="location.href='{{--{{ route('owner.products.index') }}--}}'"
                                class="flex px-2 py-2 bg-white border-4 rounded-lg place-items-center focus:outline-none hover:bg-gray-400 text-md"><svg
                                    class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>戻る</button>
                            <button type="submit"
                                class="flex px-2 py-2 text-lg text-white bg-indigo-500 border-0 rounded-lg place-items-center focus:outline-none hover:bg-indigo-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                                更新する
                            </button>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="w-1/3 mx-auto mt-2 text-center text-white bg-red-500 rounded-lg">
                        {{ $errors->first() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <script>
        function checkSubmit(){
                        if(window.confirm('更新してよろしいですか？')){
                            return true;
                        } else {
                            return false;
                        }
                        }
    </script>
</x-app-layout>