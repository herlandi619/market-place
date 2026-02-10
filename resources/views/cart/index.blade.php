@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">

    <h2 class="text-2xl font-bold mb-8">Keranjang Belanja</h2>

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
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-6 text-right font-bold text-lg">
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </div>
        </div>
    @else
        <p class="text-gray-500">Keranjang masih kosong.</p>
    @endif

</div>
@endsection
