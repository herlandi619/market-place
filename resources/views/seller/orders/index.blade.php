@extends('layouts3.app')

@section('content')

<div class="max-w-7xl mx-auto mt-6 px-3 sm:px-6">

<h2 class="text-xl sm:text-2xl font-bold mb-6">
Pesanan Masuk
</h2>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg text-sm">
{{ session('success') }}
</div>
@endif

<div class="overflow-x-auto">

<table class="w-full border border-gray-300 text-xs sm:text-sm">

<thead class="bg-gray-200">
<tr>
<th class="p-2">No</th>
<th class="p-2">Buyer</th>
<th class="p-2">Produk</th>
<th class="p-2">Jumlah</th>
<th class="p-2">Total</th>
<th class="p-2">Aksi</th>
<th class="p-2">Status</th>
</tr>
</thead>

<tbody>

@forelse($orders as $item)

<tr class="border-t text-center">

<td class="p-2 whitespace-nowrap">
{{ $loop->iteration }}
</td>
<td class="p-2 whitespace-nowrap">
{{ $item->order->user->name }}
</td>

<td class="p-2 whitespace-nowrap">
{{ $item->product->name }}
</td>

<td class="p-2">
{{ $item->qty }}
</td>

<td class="p-2 whitespace-nowrap">
Rp {{ number_format($item->price * $item->qty) }}
</td>

<td class="p-2">
<button 
onclick="showBuyer(
'{{ $item->order->user->name }}',
'{{ $item->order->user->email }}',
'{{ $item->order->user->address }}'
)"
class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">
Show
</button>
</td>

<td class="p-2 space-y-1">

@if($item->order->status == 'pending')

<span class="bg-yellow-300 px-2 py-1 rounded text-xs">
Pending
</span>

@elseif($item->order->status == 'paid')

<span class="bg-blue-300 px-2 py-1 rounded text-xs">
Paid
</span>

<form action="{{ route('seller.orders.process', $item->id) }}" method="POST"
      onsubmit="return confirm('Apakah kamu yakin ingin memproses pesanan ini?')">
    @csrf
    <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs w-full">
        Proses
    </button>
</form>

@elseif($item->order->status == 'shipped')

<span class="bg-green-300 px-2 py-1 rounded text-xs">
Shipped
</span>

@elseif($item->order->status == 'completed')

<span class="bg-gray-400 px-2 py-1 rounded text-xs">
Completed
</span>

@endif

</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center p-4 text-sm">
Belum ada pesanan
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-4">
{{ $orders->links() }}
</div>

<div class="mt-6">
<a href="{{ route('seller.dashboard') }}"
class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-xs sm:text-sm transition">
← Kembali
</a>
</div>

</div>

@endsection


{{--  MODAL BOX --}}

<div id="buyerModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">

<div class="bg-white rounded-lg shadow-lg w-96 p-6">

<h3 class="text-lg font-bold mb-4">
Data Buyer
</h3>

<div class="space-y-2 text-sm">

<p><strong>Nama:</strong> <span id="buyerName"></span></p>

<p><strong>Email:</strong> <span id="buyerEmail"></span></p>

<p><strong>Alamat:</strong> <span id="buyerAddress"></span></p>

</div>

<div class="mt-4 text-right">

<button onclick="closeModal()"
class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
Tutup
</button>

</div>

</div>
</div>


{{-- SCRIPT --}}

<script>

function showBuyer(name, email, address)
{
    document.getElementById('buyerName').innerText = name;
    document.getElementById('buyerEmail').innerText = email;
    document.getElementById('buyerAddress').innerText = address ?? '-';

    document.getElementById('buyerModal').classList.remove('hidden');
    document.getElementById('buyerModal').classList.add('flex');
}

function closeModal()
{
    document.getElementById('buyerModal').classList.add('hidden');
}

</script>