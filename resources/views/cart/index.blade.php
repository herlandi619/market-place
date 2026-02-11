@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">

    <h2 class="text-2xl font-bold mb-8">Keranjang Belanja</h2>

    @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif


    @if ($carts->count())
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">Produk</th>
                        <th class="p-4 text-center">Qty</th>
                        <th class="p-4 text-center">Harga</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp

                    @foreach ($carts as $item)
                        @php
                            $subtotal = $item->product->price * $item->qty;
                            $total += $subtotal;
                        @endphp

                        <tr class="border-t">
                            <td class="p-4 flex items-center gap-4">
                                <img
                                    src="{{ $item->product->image
                                        ? asset('storage/images/'.$item->product->image)
                                        : 'https://picsum.photos/80?random='.$item->product->id }}"
                                    class="w-16 h-16 object-cover rounded"
                                >
                                <span class="font-medium">
                                    {{ $item->product->name }}
                                </span>
                            </td>

                            <td class="p-4 text-center">
                                {{ $item->qty }}
                            </td>

                            <td class="p-4 text-center">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>

                            <td class="p-4 text-center">
                                {{-- <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        🗑
                                    </button>
                                </form> --}}
                                <div x-data="{ confirm: false }" class="inline-block">

                                    <!-- Trigger Hapus -->
                                    <button @click="confirm = true"
                                            type="button"
                                            class="text-red-600 hover:underline">
                                        🗑
                                    </button>

                                    <!-- MODAL KONFIRMASI -->
                                    <div x-show="confirm"
                                        x-transition
                                        x-cloak
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                        <div @click.away="confirm = false"
                                            class="bg-white w-full max-w-sm mx-4 rounded-xl p-6">

                                            <h3 class="text-lg font-semibold mb-2">
                                                Hapus produk?
                                            </h3>

                                            <p class="text-sm text-gray-600 mb-6">
                                                Apakah kamu yakin ingin menghapus item ini dari keranjang?
                                            </p>

                                            <div class="flex justify-end gap-3">
                                                <!-- Tidak -->
                                                <button @click="confirm = false"
                                                        type="button"
                                                        class="px-4 py-2 rounded-full
                                                            bg-gray-200 hover:bg-gray-300 text-sm">
                                                    Tidak
                                                </button>

                                                <!-- Ya -->
                                                <form action="{{ route('cart.remove', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-4 py-2 rounded-full
                                                                bg-red-600 text-white text-sm
                                                                hover:bg-red-700">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-6 text-right font-bold text-lg">
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </div>


            {{-- halaman checkout --}}
            <div class="p-6 flex flex-col sm:flex-row justify-between items-center gap-4 border-t">
    
                <div class="font-bold text-lg">
                    Total: Rp {{ number_format($total, 0, ',', '.') }}
                </div>

                <a href="{{ route('checkout.index') }}"
                class="px-6 py-3 rounded-full
                        bg-green-600 text-white
                        hover:bg-green-700 transition">
                    Checkout →
                </a>
            </div>


        </div>
    @else
        <p class="text-gray-500">Keranjang masih kosong.</p>
    @endif

</div>
@endsection
