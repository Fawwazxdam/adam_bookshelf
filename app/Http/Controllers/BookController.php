<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Read;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MENAMPILKAN SEMUA DATA BUKU DI HALAMAN BUKU
        if (Auth::User()->role != 'admin') {
            $data = Book::all()->where('users_id', Auth::User()->id);
            $data2 = Kategori::all();
        } else {
            $data = Book::all();
            $data2 = Kategori::all();
        }
        // $read = Read::all();
        $total = Read::count();
        return view('book',compact('data','data2','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //MENAMBAKAN DATA BUKU
        $data = $request->all();
        $data['cover'] = $request->file('cover')->store('img');
        Book::create($data);
        return redirect('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //UPDATE DATA BUKU
        $data = $request->all();
        $data['total_pembaca'] = $book->total_pembaca;
        try {
            $data['cover'] = $request->file('cover')->store('img');
            $book->update($data);
        } catch (\Throwable $th) {
            $data['cover'] = $book->cover;
            $book->update($data);
        }
        return redirect('book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //HAPUS DATA BUKU
        $book->delete();
        return redirect('book');
    }
}
