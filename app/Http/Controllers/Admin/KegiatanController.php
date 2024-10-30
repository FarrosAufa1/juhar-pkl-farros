<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\pembimbing;
use App\Models\Admin\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            return back()->withErrors(['access' => 'Pembimbing tidak sesuai']);
        }

        $pembimbing = pembimbing::find($id);

        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak di bimbing oleh anda.']);
        }

        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)->first();
        $id_pembimbing = $id;

        return view('guru.kegiatan', compact('id_pembimbing', 'id_siswa', 'kegiatans', 'kegiatan'));
    }

    public function detailKegiatan($id, $id_siswa, $id_kegiatan)
    {
        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = siswa::find($id_siswa);

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa tidak di temukan atau tidak memiliki pembimbing. ']);
        }

        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing tidak sesuai']);
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

    public function cariKegiatan(Request $request, $id, $id_siswa)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal'
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = siswa::find($id_siswa);

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa tidak di temukan atau tidak memiliki pembimbing. ']);
        }

        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing tidak sesuai']);
        }

        $pembimbing = pembimbing::find($id);

        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak di bimbing oleh anda.']);
        }

        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)
            ->whereBetween('tanggal_kegiatan', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
            ->whereBetween('tanggal_kegiatan', [$tanggalAwal, $tanggalAkhir])
            ->first();

        $id_pembimbing = $id;

        return view('guru.kegiatan', compact('kegiatans', 'kegiatan', 'id_pembimbing', 'id_siswa', 'tanggalAwal', 'tanggalAkhir'));
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'ringkasan_kegiatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_kegiatan', $uniqueFile, 'public');

            $foto = 'foto_kegiatan/' . $uniqueFile;
        }

        $id_siswa = Auth::guard('siswa')->user()->id_siswa;

        Kegiatan::create([
            'id_siswa' => $id_siswa,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
            'foto' => $foto,
        ]);

        return redirect()->route('siswa.kegiatan')->with('success', 'Data kegiatan Berhasil Di Tambah');
    }

    public function detail($id_kegiatan)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;

        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
            ->where('id_kegiatan', $id_kegiatan)
            ->first();
        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan Tidak tersedia']);
        }

        return view('siswa.detail_kegiatan', compact('id_kegiatan', 'kegiatan'));
    }

    public function edit(string $id_kegiatan)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)
                    ->where('id_kegiatan', $id_kegiatan)
                    ->first();
        return view('siswa.edit', compact('kegiatan'));
    }

    public function update(Request $request, string $id_kegiatan)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatan = kegiatan::find($id_kegiatan);

        $request->validate([
            'tanggal_kegiatan' => 'nullable',
            'nama_kegiatan' => 'nullable',
            'ringkasan_kegiatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $foto = $kegiatan->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_kegiatan', $uniqueFile, 'public');
            $foto = 'foto_kegiatan/' . $uniqueFile;
        }

        $kegiatan->update([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
            'foto' => $foto,
        ]);

        return redirect()->route('siswa.kegiatan', compact('id_kegiatan'))->with('success', 'Data kegiatan Berhasil di Update');
    }

    public function delete($id_kegiatan)
    {
        $siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatan = Kegiatan::find($id_kegiatan);
        if ($kegiatan->foto) {
        $foto = $kegiatan->foto;

        if (Storage::disk('public')->exists($foto)) {
            Storage::disk('public')->delete($foto);
        }
    }

        $kegiatan->delete();

        return redirect()->route('siswa.kegiatan')->with('success', 'Data Siswa Berhasil di Hapus');
    }

}
