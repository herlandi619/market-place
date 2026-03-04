@extends('layouts3.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">

<h2 class="text-xl md:text-2xl font-bold mb-6 text-gray-700">
Produk Saya
</h2>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

<a href="{{ route('seller.products.create') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm w-fit">
Tambah Produk
</a>

</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 mt-4 rounded-lg text-sm">
{{ session('success') }}
</div>
@endif

<div class="mt-6 overflow-x-auto bg-white rounded-lg shadow">

<table class="min-w-full text-sm">

<thead class="bg-gray-100 text-gray-700">
<tr>
<th class="p-3 text-center">No</th>
<th class="p-3 text-left">Nama</th>
<th class="p-3 text-center">Harga</th>
<th class="p-3 text-center">Stok</th>
<th class="p-3 text-center">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($products as $product)

<tr class="border-t hover:bg-gray-50">

<td class="p-3 text-center">
{{ ($products->currentPage()-1) * $products->perPage() + $loop->iteration }}
</td>

<td class="p-3">
{{ $product->name }}
</td>

<td class="p-3 text-center">
Rp {{ number_format($product->price) }}
</td>

<td class="p-3 text-center">
{{ $product->stock }}
</td>

<td class="p-3">

<div class="flex flex-wrap justify-center gap-2">

<a href="{{ route('seller.products.edit',$product->name) }}"
class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs sm:text-sm">
Edit
</a>

<form action="{{ route('seller.products.destroy',$product->id) }}"
method="POST"
onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">

@csrf
@method('DELETE')

<button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs sm:text-sm">
Hapus
</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

{{-- Pagination --}}
<div class="mt-6 flex justify-center">
{{ $products->links() }}
</div>

{{-- Back Button --}}
<div class="mt-6">
<a href="{{ route('seller.dashboard') }}"
class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-xs sm:text-sm transition">
← Kembali
</a>
</div>

</div>

@endsection