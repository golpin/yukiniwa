<div x-show="profileModal"
    class="fixed flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0"
    x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="profileModal = !profileModal">
    <!-- Modal -->
    <div x-show="profileModal" class="bg-white rounded-xl shadow-2xl p-6 w-3/4 md:w-1/2 mx-10"
        @click.away="profileModal = false" x-transition:enter="transition ease duration-100 transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease duration-100 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-1">

        <div class=" sm:w-1/2 mb-4 mx-auto">
            @if (!is_null($post->user->profile))
            <img class="object-cover object-center rounded-full p-2 mx-auto lg:w-80 lg:h-80 w-48 h-48"
                src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt="content">
            @else
            <img class="object-cover object-center rounded-full p-2 mx-auto w-48 h-48"
                src="{{ asset('storage/images/'.'no_image_logo.png') }}" alt="content">
            @endif
        </div>

        <div class=" w-3/4   flex flex-col  md:text-left items-center text-center mx-auto">
            <h2 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                {{ $post->user->name }}
            </h2>
            @if ($post->user->profile)
            <div>
                <p class="mb-4 leading-relaxed text-xl">
                    お気に入りのスキー場
                </p>
                <p class="mb-4 leading-relaxed text-xl">
                    {{ $post->user->profile->ski_resort->name }}
                </p>
            </div>
            <div>
                <p class="mb-4 leading-relaxed text-xl">
                    自己紹介文:{{ $post->user->profile->content }}
                </p>
                <p class="mb-4 leading-relaxed text-xl">
                    自己紹介文:{{ $post->user->profile->content }}
                </p>
            </div>


            @else
            <p class="mb-4 leading-relaxed text-xl">
                お気に入りのスキー場：まだ登録されていません
            </p>
            <p class="mb-4 leading-relaxed text-xl">
                自己紹介:まだ登録されていません
                @endif
            </p>
        </div>
    </div>
</div>

<!-- Modal Background -->