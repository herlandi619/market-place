@extends('layouts2.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-700">
            Manajemen Kategori
        </h2>

        <a href="{{ route('admin.categories.create') }}"
           class="inline-block text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            + Tambah Kategori
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Wrapper (Scrollable di Mobile) --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs sm:text-sm">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Kategori</th>
                        <th class="p-4">Dibuat</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $index => $category)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-4 whitespace-nowrap">
                            {{ $categories->firstItem() + $index }}
                        </td>

                        <td class="p-4 font-medium text-gray-700 whitespace-nowrap">
                            {{ $category->name }}
                        </td>

                        <td class="p-4 text-gray-500 whitespace-nowrap">
                            {{ $category->created_at->format('d M Y') }}
                        </td>

                        <td class="p-4 text-center whitespace-nowrap">
                            <div class="flex justify-center items-center gap-3">
                                
                                {{-- Edit --}}
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="text-blue-600 hover:text-blue-800 transition">
                                    ✏
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:text-red-800 transition">
                                        🗑
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-6 text-gray-500">
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $categories->links() }}
    </div>

    {{-- Back Button --}}
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-block bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-sm transition">
            ← Kembali
        </a>
    </div>

</div>
@endsection