@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Kategori Baru</div>
                <div class="card-body">
                    <form action="{{ route('kategoris.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="kode">Kode</label>
                            <input type="text" id="kode" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') }}" required>
                            @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary mt-3">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection