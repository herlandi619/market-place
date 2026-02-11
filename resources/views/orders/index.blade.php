@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">

    <h2 class="text-2xl font-bold mb-8">Pesanan Saya</h2>

    @if($orders->count())

        @foreach($orders as $order)
            <div class="bg-white shadow rounded-xl p-6 mb-6">

                <!-- Header Order -->
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="font-semibold">
                            Order ID: #{{ $order->id }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <span class="px-4 py-1 rounded-full text-sm
                        @if($order->status == 'pending')
                            bg-yellow-100 text-yellow-600
                        @elseif($order->status == 'paid')
                            bg-blue-100 text-blue-600
                        @elseif($order->status == 'completed')
                            bg-green-100 text-green-600
                        @else
                            bg-red-100 text-red-600
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- List Produk -->
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex justify-between border-t pt-3">
                            <div>
                                <p class="font-medium">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Qty: {{ $item->qty }}
                                </p>
                            </div>

                            <div class="font-semibold">
                                Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="text-right mt-4 font-bold text-lg">
                    Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </div>

                <!-- Tombol Bayar -->
                {{-- @if($order->status == 'pending')
                    <div class="text-right mt-4">
                        <a href="{{ route('payment.create', $order->id) }}"
                           class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 text-sm">
                            Bayar Sekarang
                        </a>
                    </div>
                @endif --}}


                @if($order->status == 'pending')

                    @if(!$order->payment)
                        <div class="text-right mt-4">
                            <a href="{{ route('payment.create', $order->id) }}"
                            class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 text-sm">
                                Bayar Sekarang
                            </a>
                        </div>

                    @elseif($order->payment->status == 'pending')
                        <div class="text-right mt-4">
                            <span class="px-5 py-2 bg-gray-300 text-gray-600 rounded-full text-sm">
                                Menunggu Konfirmasi Admin
                            </span>
                        </div>

                    @elseif($order->payment->status == 'rejected')
                        <div class="text-right mt-4">
                            <a href="{{ route('payment.create', $order->id) }}"
                            class="px-5 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 text-sm">
                                Upload Ulang Pembayaran
                            </a>
                        </div>
                    @endif

                @endif



            </div>
        @endforeach

    @else
        <p class="text-gray-500">Belum ada pesanan.</p>
    @endif

</div>
@endsection
