@extends('layouts2.app')

@section('content')
<div class="max-w-7xl mx-auto mt-6 px-4">

    <h2 class="text-xl md:text-2xl font-bold text-gray-700 mb-6">
        Laporan Penjualan Global
    </h2>

    {{-- Filter Tanggal --}}
    <form method="GET" 
        class="mb-6 flex flex-col md:flex-row gap-4 md:items-end">

        <div class="w-full md:w-auto">
            <label class="block text-sm font-medium">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate }}"
                class="border rounded px-3 py-2 w-full">
        </div>

        <div class="w-full md:w-auto">
            <label class="block text-sm font-medium">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate }}"
                class="border rounded px-3 py-2 w-full">
        </div>

        <div class="flex gap-2 w-full md:w-auto">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded w-full md:w-auto">
                Filter
            </button>

            <a href="{{ route('report.export.pdf', [
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]) }}"
                class="bg-red-600 text-white px-4 py-2 rounded w-full md:w-auto text-center">
                Export PDF
            </a>
        </div>
    </form>

    {{-- Total Global --}}
    <div class="mb-6 p-4 bg-green-100 rounded">
        <h3 class="text-base md:text-lg font-semibold">
            Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}
        </h3>
    </div>

    {{-- Rekap Per Seller --}}
    <div class="bg-white shadow rounded-lg p-4 mb-8">
        <h3 class="text-base md:text-lg font-semibold mb-4">
            Penjualan Per Seller
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 text-left">Seller</th>
                        <th class="border px-3 py-2 text-right">Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salesPerSeller as $seller => $total)
                        <tr>
                            <td class="border px-3 py-2">{{ $seller }}</td>
                            <td class="border px-3 py-2 text-right">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border px-3 py-2 text-center">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Detail Transaksi --}}
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-base md:text-lg font-semibold mb-4">
            Detail Transaksi
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-[800px] border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 text-left">Tanggal</th>
                        <th class="border px-3 py-2 text-left">Buyer</th>
                        <th class="border px-3 py-2 text-left">Seller</th>
                        <th class="border px-3 py-2 text-left">Produk</th>
                        <th class="border px-3 py-2 text-right">Qty</th>
                        <th class="border px-3 py-2 text-right">Subtotal</th>
                        <th class="border px-3 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td class="border px-3 py-2">
                                    {{ $order->created_at->format('d-m-Y') }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $order->user->name }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{-- {{ $item->product->user->name }} --}}
                                    {{ $item->product->user->name ?? '-' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $item->product->name ?? '-' }}
                                </td>

                                <td class="border px-3 py-2 text-right">
                                    {{ $item->qty ?? '-' }}
                                </td>

                                <td class="border px-3 py-2 text-right">
                                    Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                </td>

                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded text-xs
                                        @if($order->status == 'completed') bg-green-100 text-green-700
                                        @elseif($order->status == 'paid') bg-blue-100 text-blue-700
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-700
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="border px-3 py-2 text-center">
                                Tidak ada data transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    
    {{-- Back Button --}}
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-xs sm:text-sm transition">
            ← Kembali
        </a>
    </div>

</div>
@endsection