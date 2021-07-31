<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
                ホーム
            </h2>
            <form action="{{ route('user.home')}}" method="get">
                @csrf
                <div class="flex items-center">
                    <div class="xs:flex">
                        <span class="mx-2">
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
                            <x-blog-card :post="$post" />
                        </div>
                        @endforeach
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('sort')
        select.addEventListener('change',function(){
            this.form.submit()
        })
    </script>
</x-app-layout>