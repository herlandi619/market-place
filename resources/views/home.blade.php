@extends('layouts.app')

@section('title', 'Home | Marketplace')

@section('content')

<!-- HERO SECTION -->
<section class="pt-16 pb-24 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Belanja Mudah & Aman
            </h2>
            <p class="text-lg mb-8 text-indigo-100">
                Temukan ribuan produk berkualitas dari seller terpercaya.
            </p>
            <a href="#produk"
               class="inline-block bg-white text-indigo-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
                Jelajahi Produk
            </a>
        </div>

        <div class="hidden md:block">
            <img src="https://picsum.photos/600/400?random=1"
                 class="rounded-xl shadow-lg"
                 alt="Hero Image">
        </div>
    </div>
</section>

<!-- PRODUK UNGGULAN -->
<section id="produk" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h3 class="text-2xl sm:text-3xl font-bold text-center mb-12">
            Produk Unggulan
        </h3>

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
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 sm:p-5">
                        <h4 class="font-semibold mb-2">
                            {{ $product->name }}
                        </h4>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">
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
    </div>
</section>

@endsection
