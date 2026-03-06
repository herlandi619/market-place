@extends('layouts2.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">

    {{-- Header + Button --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-gray-700">
            Manajemen Transaksi
        </h2>

        <a href="{{ route('admin.payments.index') }}"
           class="w-full sm:w-auto text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm">
            Lihat Pembayaran
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        {{-- Responsive Wrapper --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs sm:text-sm">
                
                <thead class="bg-gray-100 uppercase text-gray-600 text-xs">
                    <tr>
                        <th class="p-3 whitespace-nowrap">ID</th>
                        <th class="p-3 whitespace-nowrap">User</th>
                        <th class="p-3 whitespace-nowrap">Total</th>
                        <th class="p-3 whitespace-nowrap">Status</th>
                        <th class="p-3 hidden md:table-cell whitespace-nowrap">Tanggal</th>
                        {{-- <th class="p-3 text-center whitespace-nowrap">Ubah</th> --}}
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-3 font-semibold text-gray-700 whitespace-nowrap">
                            #{{ $order->id }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            {{ $order->user->name }}
                        </td>

                        <td class="p-3 font-bold whitespace-nowrap">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($order->status == 'paid') bg-blue-100 text-blue-700
                                @elseif($order->status == 'shipped') bg-purple-100 text-purple-700
                                @else bg-green-100 text-green-700
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="p-3 text-gray-500 hidden md:table-cell whitespace-nowrap">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        {{-- <td class="p-3 text-center">
                            <form action="{{ route('admin.orders.updateStatus', $order) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="w-full sm:w-auto border rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                    <option value="pending" {{ $order->status=='pending'?'selected':'' }}>
                                        Pending
                                    </option>
                                    <option value="paid" {{ $order->status=='paid'?'selected':'' }}>
                                        Paid
                                    </option>
                                </select>
                            </form>
                        </td> --}}

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