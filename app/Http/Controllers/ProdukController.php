<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesan;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $produk = Produk::where('kode_barang', 'LIKE', '%' . $search . '%')
            ->orWhere('nama_barang', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        $cond = Produk::all()->first();
        $pesans = Pesan::all();
        $produks = Produk::all();
        return view('produk.produk', compact('produk', 'cond', 'pesans'));
    }
    public function index()
    {
        $produk = Produk::paginate(10);
        $cond = Produk::all()->first();
        $pesans = Pesan::all();
        $produks = Produk::all();



        return view('produk.produk', compact('produk', 'cond', 'pesans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Produk;
        $produk->kode_barang = $request->kode_barang;
        $produk->nama_barang = $request->nama_barang;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->save();
        return redirect('/produk')->with('tambah', 'Data berhasil ditambahkan !');
        return response()->json($produk);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.update', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $produk = Produk::find($request->id);
        $produk->kode_barang = $request->kode_barang;
        $produk->nama_barang = $request->nama_barang;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->save();


        return redirect('/produk')->with('ubah', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        redirect('/produk')->with('hapus', 'Data berhasil dihapus !');
        return response()->json();
    }
}
