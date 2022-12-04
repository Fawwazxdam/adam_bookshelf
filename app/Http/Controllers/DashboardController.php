<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Read;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MENAMPILKAN HALAMAN AWAL
        $data = Book::all();
        $data2 = Read::all();
        return view('dashboard',compact('data','data2'));
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
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $buku = Book::find($id);
        Read::create([
            'users_id' => Auth::user()->id,
            'book_id' => $buku->id,
        ]);
        return view('detail',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
class sort {
    public function __construct($kategori = '', $users_id) {
        $this->kategori = $kategori;
        $this->users_id = $users_id;
    }
    public function sortCategory()
    {
        if ($this->kategori == '') {
            return $book = Book::all();
        } else {
            return $book = Book::where('status','tampil')->where('kategori_id',$this->kategori)->get();
        }
        
    }
}