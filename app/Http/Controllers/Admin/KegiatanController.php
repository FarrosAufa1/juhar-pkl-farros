<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\pembimbing;
use App\Models\Admin\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class KegiatanController extends Controller
{
    public function kegiatan($id, $id_siswa)
    {
        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = siswa::find($id_siswa); 

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa tidak di temukan atau tidak memiliki pembimbing. ']);
        }

        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access'=> 'Pembimbing tidak sesuai']);
        }

        $pembimbing = pembimbing::find($id);

        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak di bimbing oleh anda.']);
        }

        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)->first();
        $id_pembimbing = $id;

        return view('guru.kegiatan', compact('id_pembimbing','kegiatans', 'kegiatan'));
    }

    public function detailKegiatan($id, $id_siswa, $id_kegiatan)
    {
        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = siswa::find($id_siswa); 

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa tidak di temukan atau tidak memiliki pembimbing. ']);
        }

        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access'=> 'Pembimbing tidak sesuai']);
        }

        $pembimbing = pembimbing::find($id);

        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak di bimbing oleh anda.']);
        }

        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
                            ->where('id_kegiatan', $id_kegiatan)
                            ->first();
        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan Tidak tersedia']);
        }

        return view('guru.detail_kegiatan', compact('id', 'kegiatan'));
    }


    public function kegiatanSiswa()
    {
       $id_siswa = Auth::guard('siswa')->user()->id_siswa;
       $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
       return view('siswa.kegiatan', compact('kegiatans'));
    }

    public function tambahKegiatan()
    {
        return view('siswa.tambah_kegiatan');
    }

}
