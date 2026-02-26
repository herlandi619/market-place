@extends('layouts2.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-700">
        Verifikasi Pembayaran
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        
        {{-- Responsive Table Wrapper --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs sm:text-sm text-left">
                
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="p-3 whitespace-nowrap">Order</th>
                        <th class="p-3 whitespace-nowrap">Buyer</th>
                        <th class="p-3 whitespace-nowrap">Tanggal</th>
                        <th class="p-3 whitespace-nowrap">Bukti</th>
                        <th class="p-3 whitespace-nowrap">Status</th>
                        <th class="p-3 whitespace-nowrap text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($payments as $payment)
                    <tr class="hover:bg-gray-50 transition">
                        
                        <td class="p-3 font-medium text-gray-700 whitespace-nowrap">
                            #{{ $payment->order->id }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            {{ $payment->order->user->name }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 underline text-xs sm:text-sm">
                                Lihat
                            </a>
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-white text-[10px] sm:text-xs font-semibold
                                @if($payment->status == 'approved') bg-green-500
                                @elseif($payment->status == 'rejected') bg-red-500
                                @else bg-yellow-500 @endif">
                                {{ strtoupper($payment->status) }}
                            </span>
                        </td>

                        <td class="p-3 text-center whitespace-nowrap">
                            @if($payment->status == 'pending')
                                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                    
                                    <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="w-full sm:w-auto px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-md text-xs transition">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="w-full sm:w-auto px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition">
                                            Reject
                                        </button>
                                    </form>

                                </div>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 text-sm">
        {{ $payments->links() }}
    </div>

    {{-- Back Button --}}
    <div class="mt-6">
        <a href="{{ route('admin.orders.index') }}"
           class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-xs sm:text-sm transition">
            ← Kembali
        </a>
    </div>

</div>
@endsection