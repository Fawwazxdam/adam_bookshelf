@extends('layouts.app')
@section('content')
    <div class="card m-3" style="min-height: 50vh">
        <div class="card-header">
            {{ $buku->id }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('storage/' . $buku->cover) }}" class="card-img-top" alt="...">
                </div>
                <div class="col-10">
                    <h5 class="card-title">{{ $buku->judul }}</h5>
                    <p class="card-text">{{ $buku->isi }}</p>
                    <p class="card-text">Dibuat : <i>{{ $buku->tanggal }}</i></p>
                    <p class="card-text">Kategori : {{ $buku->kategori->nama_kategori }}</p>
                    <a href="/dashboard" class="btn btn-primary d-flex justify-content-center">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
