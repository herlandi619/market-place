@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl text-center font-bold">Upload Bukti Pembayaran </h2>
    <h2 class="text-xl text-center font-bold mb-6">No Rekening: 3217321719 (BCA)</h2>
    

    <div class="mb-4">
        <p><strong>Order ID:</strong> {{ $order->id }}</p> 
        <p><strong>Total Bayar:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    </div>

    <form action="{{ route('payment.store', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Tanggal Pembayaran</label>
            <input type="date" name="payment_date"
                class="w-full border rounded px-3 py-2 mt-1"
                required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Upload Bukti (JPG/PNG)</label>
            <input type="file" name="payment_proof"
                class="w-full border rounded px-3 py-2 mt-1"
                required>
        </div>

        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Kirim Bukti Pembayaran
        </button>
    </form>

</div>
@endsection
