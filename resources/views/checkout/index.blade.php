@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">

    <h2 class="text-2xl font-bold mb-8">Checkout</h2>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">Produk</th>
                    <th class="p-4 text-center">Qty</th>
                    <th class="p-4 text-center">Subtotal</th>
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
                        <td class="p-4">
                            {{ $item->product->name }}
                        </td>

                        <td class="p-4 text-center">
                            {{ $item->qty }}
                        </td>

                        <td class="p-4 text-center">
                            Rp {{ number_format($subtotal,0,',','.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-6 border-t flex flex-col sm:flex-row justify-between items-center gap-4">

            <div class="text-lg font-bold">
                Total: Rp {{ number_format($total,0,',','.') }}
            </div>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit"
                        class="px-6 py-3 rounded-full
                               bg-indigo-600 text-white
                               hover:bg-indigo-700 transition">
                    Konfirmasi Pesanan
                </button>
            </form>

        </div>

    </div>

</div>

@endsection
