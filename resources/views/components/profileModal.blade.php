<div x-show="profileModal" :class="{ 'opacity-100' : profileModal , 'opacity-0' : !profileModal }"  class="opacity-0">
    <!-- Modal Background -->
    <div class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40"
        x-transition:enter="transition ease duration-300 z-0" x-transition:enter-start="opacity-0 "
        x-transition:enter-end="opacity-100 z-50" x-transition:leave="transition ease duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click=" profileModal = ! profileModal ">
        <!-- Modal -->
        <div class="w-5/6 my-2 bg-white shadow-2xl mx4-2 p- rounded-xl md:w-1/2" @click.away="profileModal = false"
            x-transition:enter="transition ease duration-100 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease duration-100 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <div class="mx-auto mb-4 sm:w-2/3">
                @if (!is_null($post->user->profile))
                    <img class="object-cover object-center w-40 h-40 p-2 mx-auto border-2 rounded-full lg:w-80 lg:h-80"
                        src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/{{ $post->user->profile->icon }}"
                        alt="">
                    {{-- <img class="object-cover object-center w-48 h-48 p-2 mx-auto border-2 rounded-full lg:w-80 lg:h-80"
                src="https://バケット名.s3.リージョン.amazonaws.com/{{ $post->user->profile->icon }}" alt=""> --}}
                    {{-- <img class="object-cover object-center w-48 h-48 p-2 mx-auto border-2 rounded-full lg:w-80 lg:h-80"
                src="{{ asset('storage/icons/'.$post->user->profile->icon) }}" alt=""> --}}
                @else
                    <img class="object-cover object-center w-48 h-48 p-2 mx-auto border-2 rounded-full"
                        src="https://yukiniwa-bucket.s3.ap-northeast-1.amazonaws.com/no_image_logo.png" alt="">
                    {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="{{ asset('storage/images/'.no_image_logo.png)}}" alt=""> --}}
                    {{-- <img class="object-center w-full h-auto mx-auto rounded"" src="https://バケット名.s3.リージョン.amazonaws.com/no_image_logo.png" alt=""> --}}
                @endif
            </div>

            <div class="flex flex-col items-center w-3/4 mx-auto text-center md:text-left">
                <h2 class="mb-4 text-3xl font-medium text-gray-900 title-font sm:text-4xl">
                    {{ $post->user->name }}
                </h2>
                @if ($post->user->profile)
                    <div>
                        <p class="mb-4 text-lg leading-relaxed text-center text-blue-600">
                            お気に入りのスキー場
                        </p>
                        <p class="mb-4 text-lg leading-relaxed text-center">
                            {{ $post->user->profile->ski_resort->name }}
                        </p>
                    </div>
                    <div>
                        <p class="mb-2 text-lg leading-relaxed text-center text-blue-600">
                            プロフィール
                        </p>
                        <p class="mb-4 text-lg leading-relaxed text-center">
                            {{ $post->user->profile->content }}
                        </p>
                    </div>
                @else
                    <p class="mb-4 text-xl leading-relaxed text-center">
                        お気に入りのスキー場：まだ登録されていません
                    </p>
                    <p class="mb-4 text-xl leading-relaxed text-center">
                        自己紹介:まだ登録されていません
                @endif
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Background -->
