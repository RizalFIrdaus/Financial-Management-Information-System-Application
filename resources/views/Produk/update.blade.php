@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">From Update Produk</h1>
    </div>
        <form action="{{route('produk.update')}}" method="post" class="ml-5 mt-5">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$produk->id}}">
            <div class="mb-3 row">
                <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="kode_barang" readonly name="kode_barang" autocomplete="off" value="{{$produk->kode_barang}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" autocomplete="off" value="{{$produk->nama_barang}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
                <div class="col-sm-6">
                <input type="harga_beli" class="form-control" id="harga_beli" name="harga_beli" value="{{$produk->harga_beli}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" value="{{$produk->harga_jual}}">
                </div>
            </div>
            <a href="{{route('produk')}}" class="btn btn-danger mt-4 mr-2">Kembali</a>
            <button type="submit"  class="btn btn-primary  mt-4">Diubah</button>
        </form>
</div>

@endsection