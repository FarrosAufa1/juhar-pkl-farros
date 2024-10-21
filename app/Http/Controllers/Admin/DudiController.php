<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    public function dudi()
    {
       $dudis = dudi::all();
       return view('admin.dudi', compact('dudis'));
    }

    public function create()
    {
        return view('admin.tambah_dudi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dudi' => 'required',
            'alamat' => 'required',
        ]);

        dudi::create([
            'nama_dudi' => $request->nama_dudi,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.dudi')->with('success', 'Data Dudi Berhasil Di Tambah');
    }

    public function delete(Request $request, $id)
    {
        $dudi = dudi::find($id);
        $dudi->delete();

        return redirect()->route('admin.dudi')->with('success', 'Data Dudi Berhasil di Hapus');
    }

    public function edit(string $id)
    {
        $dudi = dudi::find($id);
        return view('admin.edit_dudi' , compact('dudi'));
    }

    public function update(Request $request, string $id)
    {
        $dudi = dudi::find($id);

        $request->validate([
            'nama_dudi' => 'required',
            'alamat' => 'required',
        ]);

        $dudi->update ([
            'nama_dudi' => $request->nama_dudi,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.dudi')->with('success','Data Dudi Berhasil di Update');
    }
}
