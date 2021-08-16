<div class="flex flex-col items-center min-h-full pt-8 bg-gray-100 sm:justify-center sm:pt-20">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white border-2 shadow-md sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
