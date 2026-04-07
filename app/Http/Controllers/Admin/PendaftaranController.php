<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function dashboard()
    {
        $totalPendaftar = Pendaftaran::count();
        $pending = Pendaftaran::where('status', 'Pending')->count();
        $diverifikasi = Pendaftaran::where('status', 'Diverifikasi')->count();
        $ditolak = Pendaftaran::where('status', 'Ditolak')->count();
        $pendaftarTerbaru = Pendaftaran::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalPendaftar', 'pending', 'diverifikasi', 'ditolak', 'pendaftarTerbaru'));
    }

    public function index(Request $request)
    {
        $query = Pendaftaran::with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                    ->orWhere('nomor_registrasi', 'like', '%' . $request->search . '%')
                    ->orWhere('sekolah_asal', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftar = $query->latest()->paginate(10)->withQueryString();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function show(Pendaftaran $pendaftar)
    {
        return view('admin.pendaftar.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftar)
    {
        $request->validate(['status' => 'required|in:Pending,Diverifikasi,Ditolak']);
        $pendaftar->update(['status' => $request->status]);
        return redirect()->route('admin.pendaftar.show', $pendaftar)->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function destroy(Pendaftaran $pendaftar)
    {
        Storage::deleteDirectory('public/dokumen_pendaftaran/' . $pendaftar->nomor_registrasi);
        $pendaftar->user()->delete();
        $pendaftar->delete();
        return redirect()->route('admin.pendaftar.index')->with('success', 'Data pendaftar berhasil dihapus secara permanen.');
    }

    public function showQrScanner()
    {
        return view('admin.pendaftar.scan-qr');
    }

    public function showByReg($nomor_registrasi)
    {
        $pendaftar = Pendaftaran::where('nomor_registrasi', $nomor_registrasi)->first();
        if (!$pendaftar) {
            return redirect()->route('admin.qr.scanner')->with('error', 'Pendaftar dengan Nomor Registrasi tersebut tidak ditemukan.');
        }
        return redirect()->route('admin.pendaftar.show', $pendaftar);
    }
}
