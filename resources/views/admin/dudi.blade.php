@extends('admin.layouts.app')
@section('title', 'dudi')
@section('content')

<div class="crow r -4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h6 class="mb-4">Data Dudi</h6>
            <div class="table-responsive">
                <a href="" class="btn btn-primary btn-sm">Tambah</a>
                <table class="table" id="id_dudi">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">nama_dudi</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Edit</a>
                                <a href="" onclick="return confirm('Yakin ingin hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection