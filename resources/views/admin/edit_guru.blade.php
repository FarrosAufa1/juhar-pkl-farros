@extends('admin.layouts.app')

@section('title', 'Edit Guru')

@section('content')
<div class="row g-4">
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah guru</h6>
            <form action="{{ route('admin.guru.update', $guru->id_guru) }}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip"  value="{{ old('nip', $guru->nip)}}" >
                    <div class="text danger">
                        @error('nip')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" id="email" name="email"  value="{{ old('email', $guru->email)}}">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label type="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label type="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru"  value="{{ old('nama_guru', $guru->nama_guru)}} ">
                    @error('nama_guru')
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
                <div class="mb-2">
                `   <img src="{{ asset('storage/' .$guru->foto) }}" alt="Foto Guru" height="80">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ Route('admin.guru') }}" class="btn btn-danger ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection