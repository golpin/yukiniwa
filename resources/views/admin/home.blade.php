<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            管理者ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-6">
            <div class="mx-2 overflow-hidden rounded-lg shadow-md">
                <div class="p-4 bg-blue-400 border-b border-gray-200 shadow-sm">
                    @if (session('err_msg'))
                    <p class="w-1/3 mx-auto text-lg text-center bg-green-400 rounded-lg">
                        {{ session('err_msg') }}
                    </p>
                    @endif
                        <div class="flex flex-wrap justify-items-center px-auto">
                            @foreach ($posts as $post)
                            <div class="flex flex-wrap p-2 mx-auto md:w-1/2 lg:w-1/3 ">
                                <x-admin-blog-card  :post="$post"/>
                            </div>
                            @endforeach

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

