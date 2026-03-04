@extends('layouts3.app')

@section('content')

<div class="max-w-xl mx-auto mt-6 md:mt-10 px-4 sm:px-6">

<h2 class="text-lg sm:text-xl font-bold mb-6 text-gray-700">
Edit Produk
</h2>

<form action="{{ route('seller.products.update', $product->id) }}" 
method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')

{{-- Nama Produk --}}
<div class="mb-4">
<label class="block mb-1 text-sm font-medium">
Nama Produk
</label>

<input type="text" 
name="name"
value="{{ old('name', $product->name) }}"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">
</div>


{{-- Kategori --}}
<div class="mb-4">

<label class="block mb-1 text-sm font-medium">
Kategori
</label>

<select name="category_id" 
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $product->category_id == $category->id ? 'selected' : '' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>


{{-- Harga --}}
<div class="mb-4">

<label class="block mb-1 text-sm font-medium">
Harga
</label>

<input type="number"
name="price"
value="{{ old('price', $product->price) }}"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

</div>


{{-- Stok --}}
<div class="mb-4">

<label class="block mb-1 text-sm font-medium">
Stok
</label>

<input type="number"
name="stock"
value="{{ old('stock', $product->stock) }}"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">

</div>


{{-- Deskripsi --}}
<div class="mb-4">

<label class="block mb-1 text-sm font-medium">
Deskripsi Produk
</label>

<textarea name="description"
rows="4"
class="border border-gray-300 p-2 w-full rounded-md text-sm focus:ring focus:ring-blue-200">{{ old('description', $product->description) }}</textarea>

</div>


{{-- Gambar --}}
<div class="mb-5">

<label class="block mb-1 text-sm font-medium">
Gambar Produk
</label>

@if($product->image)

<img src="{{ asset('storage/'.$product->image) }}" 
class="w-24 sm:w-32 mb-2 rounded shadow">

@endif

<input type="file" name="image"
class="text-sm">

</div>


{{-- Tombol --}}
<div class="flex flex-col sm:flex-row gap-3">

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition">
Update Produk
</button>

<a href="{{ route('seller.products.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm text-center transition">
Kembali
</a>

</div>

</form>

</div>

@endsection