@extends('siswa.layouts.app')

@section('title', 'Tambah kegiatan')

@section('content')
<div class="row g-4">
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah kegiatan</h6>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
                    <div class="text danger">
                        @error('nama_kegiatan')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">
                    @error('tanggal_kegiatan')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label type="ringkasan" class="form-label">ringkasan</label>
                    <textarea type="text" class="form-control" id="ringkasan" name="ringkasan"></textarea>
                    @error('ringkasan')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label type="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    @error('foto')
                    {{ $password }}
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection