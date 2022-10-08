<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use App\Models\Profit;
use App\Exports\PesanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isEmpty;

class ProfitController extends Controller
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
        $profit = Profit::with('pesan')->where('nomor_po', 'LIKE', '%' . $search . '%')
            ->orWhere('nomor_invoice', 'LIKE', '%' . $search . '%')
            ->orWhere('nama_perusahaan', 'LIKE', '%' . $search . '%')
            ->orWhere('date', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        $cond = Profit::all()->first();
        return view('profit.profit', compact('profit', 'cond'));
    }
    public function index()
    {
        $profit = Profit::with('pesan')->paginate(10);
        $cond = Profit::all()->first();
        $sumProfit = Profit::all()->sum('total_jual');
        $sumHargaBeli = Pesan::all()->sum('total_beli');
        $countRow = Profit::all()->count();


        return view('profit.profit', compact('profit', 'cond', 'sumProfit', 'countRow', 'sumHargaBeli'));
    }
    public function export()
    {
        return Excel::download(new PesanExport, 'profit.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profit = Profit::with('pesan');
        $pesan = Pesan::all();
        $counting_profit = Profit::all()->count();
        if ($counting_profit == 0) {

            $count = 0;
        } else {

            $count = Profit::all()->last()->id;
        }
        return view('profit.create', compact('profit', 'pesan', 'count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profit = new Profit;
        $pesans = Pesan::all();
        $sumProfit = Profit::all()->sum('total_jual');
        $sumHargaBeli = Pesan::all()->sum('total_beli');
        $average_profit = ($sumProfit / $sumHargaBeli) * 100;
        $profit->nomor_po = $request->nomor_po;
        $profit->nama_perusahaan = $request->nama_perusahaan;
        $profit->nomor_invoice = $request->nomor_invoice;
        $profit->date = $request->date;
        $profit->biaya_operasional = $request->biaya_operasional;
        $profit->status = "belum";
        $profit->sum_profit = $sumProfit;
        $profit->average_profit = $average_profit;
        foreach ($pesans as $pesan) {
            if ($request->nomor_po == $pesan->nomor_po) {
                $total = ($pesan->total_jual - $request->biaya_operasional) - $pesan->total_beli;
                $profit->total_jual = $total;
            }
        }

        $profit->save();

        return redirect('/profit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profit = Profit::find($id);
        return view('profit.update', compact('profit'));
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
        $profit = Profit::find($request->id);
        $pesans = Pesan::all();
        $profit->nomor_po = $profit->nomor_po;
        $profit->nama_perusahaan = $request->nama_perusahaan;
        $profit->nomor_invoice =  $profit->nomor_invoice;
        $profit->date = $request->date;
        $profit->biaya_operasional = $request->biaya_operasional;
        $profit->status =  $profit->status;
        $profit->sum_profit = $profit->sum_profit;
        $profit->average_profit = $profit->average_profit;
        foreach ($pesans as $pesan) {
            if ($request->nomor_po == $pesan->nomor_po) {
                $total = ($pesan->total_jual - $request->biaya_operasional) - $pesan->total_beli;
                $profit->total_jual = $total;
            }
        }
        $profit->save();

        return redirect('/profit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profit = Profit::find($id);
        $profit->delete();

        return redirect('/profit');
    }
}
