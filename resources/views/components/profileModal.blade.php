<div x-show="profileModal"
    class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40"
    x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="profileModal = !profileModal">
    <!-- Modal -->
    <div x-show="profileModal" class="w-3/4 p-6 mx-10 bg-white shadow-2xl rounded-xl md:w-1/2"
        @click.away="profileModal = false" x-transition:enter="transition ease duration-100 transform"
        x-transition:enter-start="opacity-0 scale-90 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease duration-100 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-1">

        <div class="mx-auto mb-4 sm:w-1/2">
            @if (!is_null($post->user->profile))
            <img class="object-cover object-center w-48 h-48 p-2 mx-auto border-2 rounded-full lg:w-80 lg:h-80"
                src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt="content">
            @else
            <img class="object-cover object-center w-48 h-48 p-2 mx-auto border-2 rounded-full"
                src="{{ asset('storage/'.'no_image_logo.png') }}" alt="content">
            @endif
        </div>

        <div class="flex flex-col items-center w-3/4 mx-auto text-center md:text-left">
            <h2 class="mb-4 text-3xl font-medium text-gray-900 title-font sm:text-4xl">
                {{ $post->user->name }}
            </h2>
            @if ($post->user->profile)
            <div>
                <p class="mb-4 text-xl leading-relaxed text-blue-600">
                    お気に入りのスキー場
                </p>
                <p class="mb-4 text-xl leading-relaxed">
                    {{ $post->user->profile->ski_resort->name }}
                </p>
            </div>
            <div>
                <p class="mb-2 text-xl leading-relaxed text-center text-blue-600">
                    プロフィール
                </p>
                <p class="mb-4 text-xl leading-relaxed">
                    {{ $post->user->profile->content }}
                </p>
            </div>


            @else
            <p class="mb-4 text-xl leading-relaxed">
                お気に入りのスキー場：まだ登録されていません
            </p>
            <p class="mb-4 text-xl leading-relaxed">
                自己紹介:まだ登録されていません
                @endif
            </p>
        </div>
    </div>
</div>

<!-- Modal Background -->