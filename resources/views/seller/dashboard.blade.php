@extends('layouts3.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">

    <h2 class="text-xl md:text-2xl font-bold text-gray-700 mb-6">
        Dashboard Seller
    </h2>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-500 text-sm md:text-base">
                Total Produk
            </h3>

            <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                {{ $totalProducts }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-500 text-sm md:text-base">
                Total Pesanan
            </h3>

            <p class="text-2xl md:text-3xl font-bold text-green-600 mt-2">
                {{ $totalOrders }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-500 text-sm md:text-base mb-3">
                Penjualan Bulanan
            </h3>

            <div class="w-full h-48 md:h-56">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

    </div>


    {{-- PESANAN TERBARU --}}
    <div class="bg-white p-5 md:p-6 rounded-xl shadow">

        <h3 class="text-base md:text-lg font-bold mb-4">
            Pesanan Terbaru
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm md:text-base border">

                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="p-2 md:p-3">Produk</th>
                        <th class="p-2 md:p-3">Qty</th>
                        <th class="p-2 md:p-3">Harga</th>
                        <th class="p-2 md:p-3">Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($latestOrders as $order)

                    <tr class="text-center border-t hover:bg-gray-50">

                        <td class="p-2 md:p-3">
                            {{ $order->product->name }}
                        </td>

                        <td class="p-2 md:p-3">
                            {{ $order->qty }}
                        </td>

                        <td class="p-2 md:p-3 text-green-600 font-semibold">
                            Rp {{ number_format($order->price) }}
                        </td>

                        <td class="p-2 md:p-3 text-gray-500">
                            {{ $order->created_at->format('d-m-Y') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            Belum ada pesanan
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($salesChart->pluck('month')) !!},
        datasets: [{
            label: 'Penjualan',
            data: {!! json_encode($salesChart->pluck('total')) !!},
            borderWidth: 2,
            tension: 0.4
        }]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                display: true
            }
        },

        scales: {
            y: {
                beginAtZero: true
            }
        }

    }

});

</script>

@endsection