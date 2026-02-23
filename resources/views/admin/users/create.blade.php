@extends('layouts2.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <div class="bg-white shadow-md rounded-2xl p-6 sm:p-8">

        <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-700">
            Tambah User
        </h2>

        {{-- Global Error --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" 
              method="POST" 
              class="space-y-6">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Nama
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm
                              focus:ring-2 focus:ring-indigo-500 
                              focus:border-indigo-500 
                              transition outline-none">
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm
                              focus:ring-2 focus:ring-indigo-500 
                              focus:border-indigo-500 
                              transition outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Password
                </label>
                <input type="password"
                       name="password"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm
                              focus:ring-2 focus:ring-indigo-500 
                              focus:border-indigo-500 
                              transition outline-none">
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Role
                </label>
                <select name="role"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm
                               focus:ring-2 focus:ring-indigo-500 
                               focus:border-indigo-500 
                               transition outline-none">
                    <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-3">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', 1) ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label class="text-sm text-gray-600">
                    Aktifkan User
                </label>
            </div>

            {{-- Button --}}
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-2">
                <a href="{{ route('admin.users.index') }}"
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