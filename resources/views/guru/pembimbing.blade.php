@extends('guru.layouts.app')

@section('title', 'pembimbing')

@section('content')

<div class="crow r -4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h6 class="mb-4">Data pembimbing</h6>
            <div class="table-responsive">
                <table class="table" id="id_pembimbing">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">nama guru</th>
                            <th scope="col">nama dudi</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembimbings as $pembimbing)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $pembimbing->guru->nama_guru }}</td>
                            <td>{{ $pembimbing->dudi->nama_dudi }}</td>
                            <td>
                                <a href="{{ route('guru.pembimbing.siswa', $pembimbing->id_pembimbing) }}" class="btn btn-info btn-sm">Siswa</a>
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