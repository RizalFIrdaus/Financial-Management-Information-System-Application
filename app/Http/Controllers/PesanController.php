<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Produk;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PesanController extends Controller
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
        $pesan = Pesan::with('produk')->where('nomor_po', 'LIKE', '%' . $search . '%')
            ->orWhere('nomor_po', 'LIKE', '%' . $search . '%')
            ->orWhere('nama_customer', 'LIKE', '%' . $search . '%')
            ->orWhere('kode_barang', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        $produks = Produk::all();
        $cond = Pesan::all()->first();
        return view('pesan', compact('pesan', 'cond', 'produks'));
    }

    public function index()
    {
        $pesan = Pesan::with('produk')->paginate(10);
        $produks = Produk::all();
        $cond = Pesan::all()->first();

        return view('pesan', compact('pesan', 'cond', 'produks'));
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
        $pesan = new Pesan;
        $produk = Produk::all();
        $pesan->nomor_po = $request->nomor_po;
        $pesan->nama_customer = $request->nama_customer;
        $pesan->kode_barang = $request->kode_barang;
        $pesan->jumlah_barang = $request->jumlah_barang;
        foreach ($produk as $pro) {
            if ($request->kode_barang == $pro->kode_barang) {
                $tax = ($request->jumlah_barang * $pro->harga_jual) * 10 / 100;
                $total = $request->jumlah_barang * $pro->harga_jual + $tax;
                $laba = $request->jumlah_barang * $pro->harga_beli;
                $pesan->total_beli = $laba;
                $pesan->total_jual = $total;
            }
        }


        // $total = $request->jumlah_barang * $request->total;

        $pesan->save();
        return redirect('/pesan')->with('tambah', 'Data berhasil ditambahkan !');
        return response()->json($pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */

    public function getPesanById($id)
    {
        $pesan = Pesan::find($id);
        return response()->json($pesan);
    }
    // public function show(Pesan $pesan, $id)
    // {
    //     $pesan = Pesan::find($id);
    //     return response()->json($pesan);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesan $pesan)
    {
        $ids = Pesan::All();
        return view('pesan', compact('pesan', 'ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pesan = Pesan::find($request->id);
        $produk = Produk::all();
        $pesan->nomor_po = $request->nomor_po;
        $pesan->nama_customer = $request->nama_customer;
        $pesan->kode_barang = $request->kode_barang;
        $pesan->jumlah_barang = $request->jumlah_barang;
        foreach ($produk as $pro) {
            if ($request->kode_barang == $pro->kode_barang) {
                $tax = ($request->jumlah_barang * $pro->harga_jual) * 10 / 100;
                $total = $request->jumlah_barang * $pro->harga_jual + $tax;
                $laba = $request->jumlah_barang * $pro->harga_beli;
                $pesan->total_beli = $laba;
                $pesan->total_jual = $total;
            }
        }
        $pesan->save();

        redirect('/pesan')->with('ubah', 'Data berhasil diubah !');
        return response()->json($pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesan = Pesan::find($id);
        $pesan->delete();

        redirect('/pesan')->with('hapus', 'Data berhasil dihapus !');
        return response()->json();
    }
}
