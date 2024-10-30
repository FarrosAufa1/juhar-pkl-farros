<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\pembimbing;
use App\Models\Admin\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function siswa($id)
    {
        $pembimbing = pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
        $siswas = siswa::where('id_pembimbing', $id)->get();
        $siswa = siswa::where('id_pembimbing', $id)->first();
        return view('admin.siswa', compact('siswas', 'siswa', 'id'));
    }

    public function create($id)
    {
        $pembimbing = pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
        return view('admin.tambah_siswa', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn|digits:10',
            'password' => 'required|min:6',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');

            $foto = 'foto_siswa/' . $uniqueFile;
        }

        siswa::create ([
            'id_pembimbing' => $id,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'nama_siswa' => $request->nama_siswa,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success', 'Data siswa Berhasil Di Tambah');
    }

    public function delete(Request $request, $id, $id_siswa)
    {
        $siswa = siswa::find($id_siswa);
        if ($siswa->foto) {
        $foto = $siswa->foto;

        if (Storage::disk('public')->exists($foto)) {
            Storage::disk('public')->delete($foto);
        }
    }

        $siswa->delete();

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success', 'Data Siswa Berhasil di Hapus');
    }

    public function edit(string $id, $id_siswa)
    {
        $pembimbing = pembimbing::find($id);
        if (!$pembimbing) {
            return back();
        }
        $siswa = siswa::find($id_siswa);
        if (!$siswa) {
            return back();
        }
        return view('admin.edit_siswa' , compact('siswa', 'id'));
    }

    public function update(Request $request, string $id, $id_siswa)
    {
        $siswa = siswa::find($id_siswa);

        $request->validate([
            'nisn' => 'required|digits:10|unique:siswa,nisn,' . $siswa->id_siswa . ',id_siswa',
            'password' => 'nullable|min:6',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $siswa->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }   
        
        $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');
        $foto = 'foto_siswa/' . $uniqueFile;
        }

        $siswa->update ([
            'nisn' => $request->nisn,
            'password' => $request->filled('password') ? Hash::make($request->password) : $siswa->password,
            'nama_siswa' => $request->nama_siswa,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.pembimbing.siswa', $id)->with('success','Data siswa Berhasil di Update');
    }

    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.dashboard', compact('siswa'));
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('siswa.login');
    }

    public function profile()
    {
        $profile = Auth::guard('siswa')->user();
        return view('siswa.profile', compact('profile'));
    }

    public function updateSiswa(Request $request)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $siswa = siswa::find($id_siswa);
        
        $request->validate([
            'nama_siswa' => 'required',
            'password' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $foto = $siswa->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }   
        
        $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('foto_siswa', $uniqueFile, 'public');
        $foto = 'foto_siswa/' . $uniqueFile;
        }

        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'password' => $request->filled('password') ? Hash::make($request->password) : $siswa->password,
            'foto' => $foto,
        ]);

        return redirect()->back()->with('success', 'Data anda berhasil di update');

    }
}
