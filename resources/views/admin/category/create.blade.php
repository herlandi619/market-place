@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <div class="bg-white shadow-md rounded-2xl p-6 sm:p-8">

        {{-- Judul --}}
        <h2 class="text-xl sm:text-2xl font-bold text-gray-700 mb-6">
            Tambah Kategori
        </h2>

        {{-- Alert Error Global --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama Kategori --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Nama Kategori
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Elektronik"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                              transition duration-200 outline-none">

                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button --}}
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-2">
                <a href="{{ route('admin.categories.index') }}"
                   class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection