<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザーリスト
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-2 lg:px-6">
            <div class="overflow-hidden shadow-lg rounded-lg mx-2">
                <div class="p-4  bg-white border border-gray-200">
                    @if (session('err_msg'))
                    <p class="bg-green-400 rounded-lg text-lg w-1/3 text-center mx-auto">
                        {{ session('err_msg') }}
                    </p>
                    @endif
                    <div class="px-3 py-4 flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border">
                                    <th class="text-left p-3 px-5">名前</th>
                                    <th class="text-left p-3 px-5">Email</th>
                                    <th class="text-left p-3 px-5">登録日</th>
                                    <th></th>
                                </tr>
                                @foreach ($users as $user)
                                <tr class="border hover:bg-orange-100 bg-gray-100">
                                    <td class="p-3 px-5">{{ $user->name }}</td>
                                    <td class="p-3 px-5">{{ $user->email }}</td>
                                    <td class="p-3 px-5">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="p-3 px-5 ">
                                        <form action="{{ route('admin.delete',$user->id) }}" method="POST" onsubmit="return checkDelete()">
                                            <div class="flex flex-row-reverse">
                                                @csrf
                                                <button type="submit"
                                                    class="focus:outline-none text-white text-sm py-2 px-2 rounded-lg bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                                    削除
                                                    <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        } else {
            return false;
        }
        }
    </script>
</x-app-layout>

