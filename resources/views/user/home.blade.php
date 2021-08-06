<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col justify-between sm:flex-row">
            <h1 class="text-xl font-semibold leading-tight text-gray-800 ">
                ホーム
            </h1>
            <form action="{{ route('user.home')}}" method="get">
                @csrf
                <div class="flex flex-row justify-end">
                    <div class="my-auto mr-2">
                        <input name="keyword" type="text" class="text-sm border-2 " placeholder="キーワードを入力してください">
                    </div>
                    <button type="submit"
                        class="text-sm focus:outline-none text-white my-2 py-2.5 px-5 rounded-full bg-yellow-400 hover:bg-yellow-500 hover:shadow-lg flex items-center">
                        検索
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex justify-end">
                    <div class="flex flex-col sm:flex-row">
                        <span class="mx-2 my-auto text-md">
                            スキー場ソート
                        </span>
                        <select name="ski_resort" id="ski_resort" class="text-sm ">
                            <option value="0" @if(\Request::get('ski_resort')=="0" ) selected @endif>
                                全て
                            </option>
                            @foreach ($ski_resorts as $ski_resort)
                            <option value="{{ $ski_resort->id }}" @if(\Request::get('ski_resort')==$ski_resort->id )
                                selected @endif>
                                {{ $ski_resort->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row">
                        <span class="mx-2 my-auto">
                            表示順
                        </span>
                        <select name="sort" id="sort" class="text-sm ">
                            <option value="1" @if(\Request::get('sort')=="1" ) selected @endif>
                                新しい順
                            </option>
                            <option value="2" @if(\Request::get('sort')=="2" ) selected @endif>
                                古い順
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-6">
            <div class="mx-2 overflow-hidden rounded-lg shadow-md">
                <div class="p-4 bg-blue-200 border-b border-gray-200">
                    @if (session('err_msg'))
                    <p class="w-1/3 mx-auto text-lg text-center bg-green-400 rounded-lg">
                        {{ session('err_msg') }}
                    </p>
                    @endif
                    <div class="flex flex-wrap object-center mx-auto justify-items-center">
                        @foreach ($posts as $post)
                        <div class="flex flex-wrap w-full p-2 sm:w-1/2 lg:w-1/3 ">
                            <x-blog-card :post="$post" :likes="$likes" />

                        </div>
                        @endforeach
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        //表示順で選択したらsubmitされる
        const select = document.getElementById('sort')
        select.addEventListener('change',function(){
            this.form.submit()
        })
    </script>
    <script>
        const ski_resort = document.getElementById('ski_resort')
        ski_resort.addEventListener('change',function(){
            this.form.submit()
        })
    </script>

</x-app-layout>