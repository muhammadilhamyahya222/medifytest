@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between mb-3">
                <h3>Daftar Kategori</h3>
                <a href="{{ route('kategoris.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card mb-3">
                <div class="card-header">Filter Kategori</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('kategoris.index') }}">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" name="nama" class="form-control" placeholder="Cari Nama Kategori..." value="{{ request('nama') }}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kode" class="form-control" placeholder="Cari Kode Kategori..." value="{{ request('kode') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->kode }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>
                                        <a href="{{ route('kategoris.show', $kategori->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection