@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@section('content')
<h1 class="text-3xl font-bold text-slate-800 mb-6">Dashboard Utama</h1>

<!-- Kartu Statistik (KPI Cards) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-sm font-medium opacity-80">TOTAL PENDAFTAR</h3>
        <p class="text-4xl font-bold mt-1">{{ $totalPendaftar }}</p>
    </div>
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-sm font-medium opacity-80">DIVERIFIKASI</h3>
        <p class="text-4xl font-bold mt-1">{{ $diverifikasi }}</p>
    </div>
    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-sm font-medium opacity-80">PENDING</h3>
        <p class="text-4xl font-bold mt-1">{{ $pending }}</p>
    </div>
    <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-sm font-medium opacity-80">DITOLAK</h3>
        <p class="text-4xl font-bold mt-1">{{ $ditolak }}</p>
    </div>
</div>

<!-- Tabel Pendaftar Terbaru -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="font-bold text-lg mb-4 text-slate-700">5 Pendaftar Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">Program Studi</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftarTerbaru as $p)
                <tr class="bg-white border-b hover:bg-slate-50">
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
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.pendaftar.show', $p) }}" class="font-medium text-blue-600 hover:underline">Lihat Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-slate-500">Tidak ada pendaftar baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection