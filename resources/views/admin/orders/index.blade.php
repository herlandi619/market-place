@extends('layouts2.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">

    <h2 class="text-xl md:text-2xl font-bold text-gray-700 mb-6">
        Manajemen Transaksi
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs sm:text-sm md:text-base">
                <thead class="bg-gray-100 uppercase text-gray-600 text-xs">
                    <tr>
                        <th class="p-3 md:p-4">ID</th>
                        <th class="p-3 md:p-4">User</th>
                        <th class="p-3 md:p-4">Total</th>
                        <th class="p-3 md:p-4">Status</th>
                        <th class="p-3 md:p-4 hidden sm:table-cell">Tanggal</th>
                        <th class="p-3 md:p-4 text-center">Ubah</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-t hover:bg-gray-50 transition duration-150">
                        
                        <td class="p-3 md:p-4 font-medium whitespace-nowrap">
                            #{{ $order->id }}
                        </td>

                        <td class="p-3 md:p-4 whitespace-nowrap">
                            {{ $order->user->name }}
                        </td>

                        <td class="p-3 md:p-4 font-semibold whitespace-nowrap">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>

                        <td class="p-3 md:p-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-[10px] sm:text-xs font-medium
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($order->status == 'paid') bg-blue-100 text-blue-700
                                @elseif($order->status == 'shipped') bg-purple-100 text-purple-700
                                @else bg-green-100 text-green-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="p-3 md:p-4 text-gray-500 hidden sm:table-cell whitespace-nowrap">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3 md:p-4 text-center">
                            <form action="{{ route('admin.orders.updateStatus', $order) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="border rounded px-2 py-1 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    <option value="pending" {{ $order->status=='pending'?'selected':'' }}>
                                        Pending
                                    </option>
                                    <option value="paid" {{ $order->status=='paid'?'selected':'' }}>
                                        Paid
                                    </option>
                                    {{-- 
                                    <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>
                                        Shipped
                                    </option>
                                    <option value="completed" {{ $order->status=='completed'?'selected':'' }}>
                                        Completed
                                    </option> 
                                    --}}
                                </select>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500 text-sm">
                            Belum ada pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-6 text-sm">
        {{ $orders->links() }}
    </div>

    {{-- Back Button --}}
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-xs sm:text-sm transition duration-150">
            ← Kembali
        </a>
    </div>  

</div>
@endsection