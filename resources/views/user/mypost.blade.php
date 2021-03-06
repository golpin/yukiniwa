<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            マイ投稿
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-6" x-data="{ showModal : false,profileModal : false }">
            <div class="mx-2 overflow-hidden rounded-lg shadow-md">
                <div class="p-4 bg-indigo-100 border-b border-gray-200">
                    @if (session('err_msg'))
                    <p class="w-1/3 mx-auto text-lg text-center bg-green-400 rounded-lg">
                        {{ session('err_msg') }}
                    </p>
                    @endif
                    <div class="flex flex-wrap object-center justify-items-center px-auto">
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
</x-app-layout>