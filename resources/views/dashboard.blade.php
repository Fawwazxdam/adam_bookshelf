@extends('layouts.app')
@section('content')
    <h1 class="text-center d-flex justify-content-center">BOOKSHELF</h1>

    @foreach ($data as $buku)
        <div class="card m-3">
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
                        {{-- @if ($buku->id == $data2->book_id)
                        <p class="card-text"><i> Terbaca</i></p>
                        @else
                        <p class="card-text"><i>Belum Dibaca</i></p>
                        @endif --}}
                        @if(Auth::check())
                        <a href="{{ route('dashboard.show', $buku->id) }}"
                            class="btn btn-primary d-flex justify-content-center">Baca</a>
                            
                        @else
                        <a href="{{ route('dashboard.show', $buku->id) }}"
                            class="btn btn-primary d-flex justify-content-center disabled" aria-disabled="true">Baca</a>
                            <div class="form-text">Anda harus Login Sebelum Membaca</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
