<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profit;
use App\Models\Pesan;
use App\Models\Produk;

class PenagihanController extends Controller
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
        $profit = Profit::with('pesan')->where('status', 'LIKE', '%' . $search . '%')
            ->orWhere('nomor_invoice', 'LIKE', '%' . $search . '%')
            ->orWhere('nama_perusahaan', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        $cond = Profit::all()->first();
        $profits = Profit::all();
        return view('penagihan', compact('profit', 'cond', 'profits'));
    }
    public function index()
    {
        $cond = Profit::all()->first();
        $profit = Profit::with('pesan')->paginate(10);
        $profits = Profit::all();
        $pesan = Pesan::all();
        return view('penagihan', compact('profit', 'cond', 'profits', 'pesan'));
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
    public function update(Request $request)
    {
        $penagihan = Profit::find($request->id);
        $penagihan->nomor_po = $penagihan->nomor_po;
        $penagihan->nama_perusahaan = $penagihan->nama_perusahaan;
        $penagihan->nomor_invoice = $penagihan->nomor_invoice;
        $penagihan->date = $penagihan->date;
        $penagihan->biaya_operasional = $penagihan->biaya_operasional;
        $penagihan->status =  $request->status;
        $penagihan->total_jual = $penagihan->total_jual;
        $penagihan->save();
        return redirect('/penagihan');
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
