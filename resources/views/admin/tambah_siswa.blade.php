@extends('admin.layouts.app')

@section('title', 'Tambah Guru')

@section('content')
<div class="row g-4">
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah Siswa</h6>
            <form action="{{ route('admin.pembimbing.siswa.store', $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nisn" class="form-label">nisn</label>
                    <input type="text" class="form-control" id="nisn" name="nisn">
                    <div class="text danger">
                        @error('nisn')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label type="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="nama_siswa" class="form-control" id="nama_siswa" name="nama_siswa">
                    @error('nama_siswa')
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