<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profit;
use App\Models\Produk;
use App\Models\Pesan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sumProfit = Profit::all()->sum('total_jual');
        $countRow = Profit::all()->count();
        $countProduk = Produk::all()->count();
        $countPesan = Pesan::all()->count();
        $profit = Profit::with('pesan')->paginate(10);
        $produk = Produk::paginate(4);
        $sumHargaBeli = Pesan::all()->sum('total_beli');
        return view('home', compact('sumProfit', 'countRow', 'profit', 'countProduk', 'countPesan', 'produk', 'sumHargaBeli'));
    }
}
