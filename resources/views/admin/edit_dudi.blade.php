@extends('admin.layouts.app')

@section('title', 'Tambah Dudi')

@section('content')
<div class="row g-4">
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah dudi</h6>
            <form action="{{ route('admin.dudi.update', $dudi->id_dudi) }}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_dudi" class="form-label">nama_dudi</label>
                    <input type="text" class="form-control" id="nama_dudi" name="nama_dudi"  value="{{ old('nama_dudi', $dudi->nama_dudi)}}" >
                    <div class="text danger">
                        @error('nama_dudi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"  value="{{ old('alamat', $dudi->alamat)}}">
                    @error('alamat')
                    {{ $message }}
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ Route('admin.dudi') }}" class="btn btn-danger ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection