@extends('layouts.admin')

@section('title', 'Data Mahasiswa Terdaftar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-slate-800">Data Mahasiswa Terdaftar</h1>
</div>

<!-- Fitur Pencarian -->
<div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
    <form action="{{ route('admin.pendaftar.index') }}" method="GET" class="flex items-center">
        <input type="text" name="search" placeholder="Cari nama, no. registrasi, sekolah..." value="{{ request('search') }}"
            class="w-full md:w-1/2 p-2 border border-slate-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500">
        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700">Cari</button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50">
            <tr>
                <th class="px-6 py-3">No. Registrasi</th>
                <th class="px-6 py-3">Nama Lengkap</th>
                <th class="px-6 py-3">Program Studi</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftar as $p)
            <tr class="bg-white border-b hover:bg-slate-50">
                <td class="px-6 py-4 font-mono text-slate-700">{{ $p->nomor_registrasi }}</td>
                <td class="px-6 py-4 font-medium text-slate-900">{{ $p->nama_lengkap }}</td>
                <td class="px-6 py-4 text-slate-600">{{ $p->program_studi }}</td>
                <td class="px-6 py-4">
                    @php
                    $statusClass = [
                    'Pending' => 'bg-yellow-100 text-yellow-800',
                    'Diverifikasi' => 'bg-green-100 text-green-800',
                    'Ditolak' => 'bg-red-100 text-red-800'
                    ][$p->status];
                    @endphp
                    <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full {{ $statusClass }}">{{ $p->status }}</span>
                </td>
                <td class="px-6 py-4 flex items-center justify-center space-x-3">
                    <a href="{{ route('admin.pendaftar.show', $p) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                    <form action="{{ route('admin.pendaftar.destroy', $p) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus data ini akan menghapus akun login mahasiswa terkait secara permanen. Apakah Anda yakin?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-10 text-slate-500">
                    @if(request('search'))
                    Tidak ada data yang cocok dengan pencarian "{{ request('search') }}".
                    @else
                    Belum ada pendaftar.
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Link Paginasi -->
<div class="mt-6">
    {{ $pendaftar->links() }}
</div>
@endsection