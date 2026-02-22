@extends('layouts2.app')

@section('title', 'User Management')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Management</h1>

        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
            + Tambah User
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-4 font-medium">
                        {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($user->role == 'admin')
                                bg-purple-100 text-purple-600
                            @elseif($user->role == 'seller')
                                bg-blue-100 text-blue-600
                            @else
                                bg-gray-100 text-gray-600
                            @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td>
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $user->is_active
                                ? 'bg-green-100 text-green-600'
                                : 'bg-red-100 text-red-600' }}">
                            {{ $user->is_active ? 'Active' : 'Non Active' }}
                        </span>
                    </td>

                    <td class="text-center space-x-2">

                        {{-- Edit --}}
                        {{-- <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a> --}}

                        {{-- Delete --}}
                        {{-- <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form> --}}

                        {{-- Toggle Status --}}
                        <form action="{{ route('admin.users.toggleStatus', $user->id) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('PATCH')

                            <button class="text-yellow-600 hover:underline">
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-500">
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection
