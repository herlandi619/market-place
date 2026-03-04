@extends('layouts3.app')

@section('content')

<div class="max-w-xl mx-auto mt-6 md:mt-10 px-4 sm:px-6">

<h2 class="text-lg sm:text-xl font-bold mb-6 text-gray-700">
Tambah Produk
</h2>

<form action="{{ route('seller.products.store') }}" 
method="POST" enctype="multipart/form-data">

@csrf

{{-- Nama Produk --}}
<div class="mb-4">

<label class="block text-sm font-medium mb-1">
Nama Produk
</label>

<input type="text" name="name"
placeholder="Masukkan nama produk"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

</div>


{{-- Kategori --}}
<div class="mb-4">

<label class="block text-sm font-medium mb-1">
Kategori
</label>

<select name="category_id"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

<option value="">Pilih Kategori</option>

@foreach($categories as $category)

<option value="{{ $category->id }}">
{{ $category->name }}
</option>

@endforeach

</select>

</div>


{{-- Harga --}}
<div class="mb-4">

<label class="block text-sm font-medium mb-1">
Harga
</label>

<input type="number" name="price"
placeholder="Masukkan harga produk"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

</div>


{{-- Stok --}}
<div class="mb-4">

<label class="block text-sm font-medium mb-1">
Stok
</label>

<input type="number" name="stock"
placeholder="Jumlah stok"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

</div>


{{-- Description --}}
<div class="mb-4">

<label class="block text-sm font-medium mb-1">
Deskripsi Produk
</label>

<textarea name="description"
rows="4"
placeholder="Masukkan deskripsi produk"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200"></textarea>

</div>


{{-- Gambar --}}
<div class="mb-5">

<label class="block text-sm font-medium mb-1">
Upload Gambar
</label>

<input type="file" name="image"
class="text-sm">

</div>


{{-- Tombol --}}
<div class="flex flex-col sm:flex-row gap-3">

<a href="{{ route('seller.products.index') }}"
class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm text-center transition">
← Kembali
</a>

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition">
Simpan Produk
</button>

</div>

</form>

</div>

@endsection