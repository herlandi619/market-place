@extends('layouts.app')

@section('title', 'All Products | Marketplace')

@section('content')

<!-- HEADER -->
<section class="pt-12 pb-16 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-3">
            Semua Produk
        </h2>
        <p class="text-indigo-100">
            Jelajahi seluruh produk dari seller terpercaya
        </p>
    </div>
</section>

<!-- PRODUCT LIST -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
            @forelse ($products as $product)
                <div 
                    x-data="{ open: false }"
                    class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden"
                >

                    <!-- IMAGE -->
                    <div class="aspect-[4/3] w-full overflow-hidden">
                        <img
                            src="{{ $product->image
                                ? asset('storage/images/' . $product->image)
                                : 'https://picsum.photos/400/300?random=' . $product->id }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 sm:p-5">
                        <h3 class="font-semibold text-base sm:text-lg mb-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($product->description, 70) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-bold text-sm sm:text-base">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>

                            <!-- SHOW BUTTON -->
                            <button
                                @click="open = true"
                                class="px-4 py-2 text-sm rounded-full
                                    bg-indigo-600 text-white
                                    hover:bg-indigo-700 transition"
                            >
                                Detail
                            </button>
                        </div>
                    </div>

                    <!-- MODAL -->
                    <div
                        x-show="open"
                        x-transition
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                    >
                        <div
                            @click.away="open = false"
                            class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-xl overflow-hidden"
                        >

                            <!-- MODAL IMAGE -->
                            <img
                                src="{{ $product->image
                                    ? asset('storage/images/' . $product->image)
                                    : 'https://picsum.photos/600/400?random=' . $product->id }}"
                                class="w-full h-64 object-cover"
                            >

                            <!-- MODAL CONTENT -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-600 mb-4">
                                    {{ $product->description }}
                                </p>

                                <div class="flex justify-between items-center">
                                    <span class="text-indigo-600 text-lg font-bold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>

                                    <button
                                        @click="open = false"
                                        class="px-4 py-2 rounded-full
                                            bg-gray-200 hover:bg-gray-300 transition"
                                    >
                                        Tutup
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                @empty

                <p class="col-span-3 text-center text-gray-500">
                    Produk belum tersedia.
                </p>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
</section>

@endsection
