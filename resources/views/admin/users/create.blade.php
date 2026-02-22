@extends('layouts2.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-700">
        Tambah User
    </h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Nama
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
            @error('email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Password
            </label>
            <input type="password"
                   name="password"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
            @error('password')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Role
            </label>
            <select name="role"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       checked
                       class="rounded">
                <span class="text-sm text-gray-600">Aktifkan User</span>
            </label>
        </div>

        {{-- Button --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection