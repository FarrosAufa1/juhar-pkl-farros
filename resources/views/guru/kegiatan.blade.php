@extends('guru.layouts.app')

@section('title', 'kegiatan')

@section('content')
@if ($errors->has('access'))
<div class="alert alert-danger">
    {{ $errors->first('access') }}
</div>
@endif
@if($kegiatan)
<div class="row bg-light rounded align-items-center mx-0">
    <div class="col-md-6 p-3">
        <table>
            <tr>
                <td width="100">Nama Siswa</td>
                <td width="10">:</td>
                <td>{{ $kegiatan->kegiatanSiswa->nama_siswa }}</td>
            </tr>
        </table>
    </div>
</div>
<br>
@endif
<div class="crow r -4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <h6 class="mb-4">Data Kegiatan</h6>
            <div class="table-responsive">
                <table class="table" id="id_kegiatan">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">tanggal kegiatan</th>
                            <th scope="col">nama kegiatan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>
                                <a href="{{ route('guru.pembimbing.siswa.kegiatan.detail', ['id' => $id_pembimbing, 'id_siswa' => $kegiatan->id_siswa, 'id_kegiatan' => $kegiatan->id_kegiatan]) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection