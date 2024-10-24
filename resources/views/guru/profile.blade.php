@extends('guru.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-6">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="d-flex align-items-center justify-content-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{ asset('storage/' .$profile->foto) }}" alt="" style="width: 100px; height: 100px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
            </div>
            <form action="{{ route('guru.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nip" class="form-label">Nip</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $profile->nip ?? 'Guru belum mempunyai NIP'}}" readonly>
                    <div class="text danger">
                        @error('nip')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_guru" class="form-label">nama guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $profile->nama_guru }}">
                    @error('nama_guru')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    @error('foto')
                    {{ $message }}
                    @enderror
                </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection