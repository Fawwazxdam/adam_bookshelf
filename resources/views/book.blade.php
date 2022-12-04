@extends('layouts.app')
@section('content')
    <h2 class="text-center m-3">Buku</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Isi</th>
                <th scope="col">Penulis</th>
                <th scope="col">Total Pembaca</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Cover</th>
                <th scope="col">Status</th>
                <th scope="col">Kategori</th>
                <th scope="col">Petugas</th>
                <th scope="col" colspan="2" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $buku)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->isi }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $total }}</td>
                    <td>{{ $buku->tanggal }}</td>
                    <td><img src="{{asset('storage/'.$buku->cover)}}" alt="" width="90px"></td>
                    <td>{{ $buku->status }}</td>
                    <td>{{ $buku->kategori->nama_kategori }}</td>
                    <td>{{ $buku->users_id }}</td>
                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{$buku->id}}">Edit</button></td>
                    <td><a href="{{url('delbuk/'.$buku->id)}}" class="btn btn-danger">Delete</a></td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="edit{{$buku->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit buku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('book.update',$buku->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul" value="{{$buku->judul}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Isi</label>
                                        <textarea name="isi" class="form-control" id="" cols="30" rows="10">{{$buku->isi}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penulis</label>
                                        <input type="text" class="form-control" name="penulis" value="{{$buku->penulis}}">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label class="form-label">Total Pembaca</label>
                                        <input type="text" class="form-control" name="total_pembaca" value="{{$buku->judul}}">
                                    </div> --}}
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" value="{{$buku->tanggal}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1">Cover</label>
                                        <img src="{{asset('storage/'.$buku->cover)}}" alt="" width="300px" class="form-control img-thumbnail">
                                        <input type="file" class="form-control" name="cover" value="{{$buku->cover}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control" name="kategori_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($data2 as $item)
                                            <option value="{{ $item->id }}" @selected($buku->kategori_id==$item->id) >{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODAL EDIT --}}

            @endforeach
        </tbody>
    </table>
    
    
{{-- MODAL TAMBAH --}}
<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Isi</label>
                    <textarea name="isi" class="form-control" id="" cols="30" rows="10" required>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" class="form-control" name="cover" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-control" name="kategori_id">
                        <option selected disabled>Pilih Kategori</option>
                        @foreach ($data2 as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <input type="text" class="form-control" name="users_id" value="{{ Auth::User()->id }}" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection