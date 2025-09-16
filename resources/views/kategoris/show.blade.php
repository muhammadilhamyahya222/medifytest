@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar</a>
            <div class="card">
                <div class="card-header">Detail Kategori</div>
                <div class="card-body">
                    <p><strong>Kode:</strong> {{ $kategori->kode }}</p>
                    <p><strong>Nama:</strong> {{ $kategori->nama }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Daftar Item dalam Kategori Ini</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($kategori->masterItems as $item)
                            <li class="list-group-item">{{ $item->nama }} (Kode: {{ $item->kode }})</li>
                        @empty
                            <li class="list-group-item">Tidak ada item dalam kategori ini.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection