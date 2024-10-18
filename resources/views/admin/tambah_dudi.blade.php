@extends('admin.layouts.app')

@section('title', 'Tambah Dudi')

@section('content')
<div class="row g-4">
    <div class="col-sm-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah Dudi</h6>
            <form action="{{ route('admin.dudi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_dudi" class="form-label">nama dudi</label>
                    <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" placeholder="Masukkan nama dudi">
                    <div class="text danger">
                        @error('nip')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="masukkan alamat dudi">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection