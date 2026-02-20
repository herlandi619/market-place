@extends('layouts2.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white shadow rounded-xl p-6">
            <p class="text-gray-500">Total Users</p>
            <h2 class="text-2xl font-bold">{{ $totalUsers }}</h2>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <p class="text-gray-500">Total Orders</p>
            <h2 class="text-2xl font-bold">{{ $totalOrders }}</h2>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <p class="text-gray-500">Total Revenue</p>
            <h2 class="text-2xl font-bold">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h2>
        </div>

    </div>

    <!-- Role Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white shadow rounded-xl p-6">
            <p class="text-gray-500">Total Sellers</p>
            <h2 class="text-xl font-bold">{{ $totalSellers }}</h2>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <p class="text-gray-500">Total Buyers</p>
            <h2 class="text-xl font-bold">{{ $totalBuyers }}</h2>
        </div>
    </div>

    <!-- Grafik -->
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-4">Grafik Penjualan Bulanan</h2>
        <canvas id="salesChart"></canvas>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const salesData = @json($monthlySales);

    const labels = Object.keys(salesData);
    const data = Object.values(salesData);

    new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan',
                data: data
            }]
        }
    });
</script>

@endsection
