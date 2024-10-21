<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\dudi;
use App\Models\Admin\guru;
use App\Models\Admin\pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function pembimbing()
    {
        $pembimbings = pembimbing::with('guru', 'dudi')->get();
        return view('admin.pembimbing', compact('pembimbings'));
    }

    public function create()
    {
        $gurus = guru::all();
        $dudis = dudi::all();
        return view('admin.tambah_pembimbing', compact('gurus', 'dudis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' =>'required',
            'id_dudi' =>'required',
        ]);

        pembimbing::create([
            'id_guru' => $request->id_guru,
            'id_dudi' => $request->id_dudi,
        ]);
        
        return redirect()->route('admin.pembimbing')->with('success', 'Data Pembimbing berhasil di tambah.');
    }

    public function edit(string $id)
    {
        $pembimbing = pembimbing::find($id);
        $gurus = guru::with('pembimbingGuru')->get();
        $dudis = dudi::with('pembimbingDudi')->get();
        return view('admin.edit_pembimbing', compact('pembimbing', 'gurus', 'dudis'));
    }

    public function update(Request $request, string $id)
    {
        $pembimbing = pembimbing::find($id);
        $request->validate([
            'id_guru' => 'required',
            'id_dudi' => 'required',
        ]);

        $pembimbing->update ([
            'id_guru' => $request->id_guru,
            'id_dudi' => $request->id_dudi,
        ]);

        return redirect()->route('admin.pembimbing')->with('success','Data Pembimbing Berhasil di Update');
    }

    public function delete(Request $request, $id)
    {
        $pembimbing = pembimbing::find($id);
        $pembimbing->delete();

        return redirect()->route('admin.pembimbing')->with('success', 'Data pembimbing Berhasil di Hapus');
    }
}
