<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-16 ">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-2 py-4 bg-indigo-100 border-b border-gray-200">
                    <h2 class="w-3/4 sm:w-1/3  mx-auto  text-center  text-xl border-b-2 border-indigo-500">プロフィール編集</h2>
                    <form action="{{ route('user.profile.update',$profile->id) }}" method="POST" onsubmit="return checkSubmit()"
                        enctype="multipart/form-data">
                        @csrf
                        <h2 class=" text-3xl my-2  text-gray-800 p-2 w-3/4 mx-auto">
                            ユーザーネーム:{{ $user->name }}
                        </h2>
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="content" class="leading-7 text-lg text-gray-800">自己紹介</label>
                                <textarea rows="6" id="content" name="content" value="{{ old('content') }}"
                                    required
                                    class="w-full bg-gray-50 bg-opacity-100 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $profile->content }}</textarea>
                            </div>
                        </div>
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative ">
                                <label for="ski_resort_id" class="leading-7 text-lg text-gray-800">お気に入りのゲレンデ：</label>
                                <select name="ski_resort_id" id="ski_resort_id" class="rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200  outline-none text-gray-700 text-lg py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($ski_resorts as $ski_resort)
                                    <option value="{{ $ski_resort->id}}">
                                        {{ $ski_resort->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="p-2 w-3/4 mx-auto">
                            <div class="relative">
                                <label for="icon" class="leading-7 text-lg text-gray-800">アイコン</label>
                                <input type="file" name="icon" id="icon"  accept="image/jpg,image/jpeg,image/png" 
                                    class="w-full bg-gray-50 bg-opacity-100 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <p>拡張子はjpg・jpeg・png限定。ファイルサイズの上限は10MB</p>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <a href="{{ route('user.profile.myprofile')}}">
                            <button type="button"  class="flex place-items-center bg-white border-4 py-2 px-2 focus:outline-none hover:bg-gray-400 rounded-lg text-md">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                </svg>
                                戻る
                            </button>
                            </a>
                            <button type="submit"
                                class="flex place-items-center text-white bg-indigo-500 border-0 py-2 px-2 focus:outline-none hover:bg-indigo-600 rounded-lg text-lg">
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
                    <div class="text-white bg-red-500 mx-auto mt-2 rounded-lg w-1/3 text-center">
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