@extends('siswa.layouts.app')

@section('title', 'kegiatan')

@section('content')
@if ($errors->has('access'))
<div class="alert alert-danger">
    {{ $errors->first('access') }}
</div>
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
            <a href="{{ route('siswa.tambah.kegiatan') }}" class="btn btn-primary btn-sm">Tambah</a>
                <table class="table" id="kegiatan">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">nama</th>
                            <th scope="col">tanggal kegiatan</th>
                            <th scope="col">nama kegiatan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $kegiatan->kegiatanSiswa->nama_siswa }}</td>
                            <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>
                                <a href="{{ route('siswa.kegiatan.detail', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('siswa.kegiatan.edit', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('siswa.kegiatan.delete', ['id_kegiatan' => $kegiatan->id_kegiatan]) }}" class="btn btn-info btn-sm">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#ke  iatan').DataTable();
    })
</script>

@endsection