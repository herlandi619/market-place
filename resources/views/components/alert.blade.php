@props([
    'type' => 'success'
])

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    class="flex items-center gap-3
           px-4 py-3 mb-4
           rounded-xl
           bg-green-100 text-green-700
           text-sm shadow-sm text-center"
>
    <!-- ICON -->
    <span class="text-lg">✅</span>

    <!-- MESSAGE -->
    <div class="flex-1">
        {{ $slot }}
    </div>

    <!-- CLOSE -->
    <button @click="show = false"
            class="text-lg font-bold leading-none hover:opacity-70">
        &times;
    </button>
</div>
