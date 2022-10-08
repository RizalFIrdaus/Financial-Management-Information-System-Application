@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">From Update Profit</h1>
    </div>
        <form action="{{route('profit.update')}}" method="post" class="ml-5 mt-5">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$profit->id}}">
            <div class="mb-3 row">
                <label for="nomor_po" class="col-sm-2 col-form-label">Nomor PO</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nomor_po" name="nomor_po" autocomplete="off" readonly value="{{$profit->nomor_po}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" autocomplete="off" value="{{$profit->nama_perusahaan}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nomor_invoice" class="col-sm-2 col-form-label">Nomor Invoice</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nomor_invoice" name="nomor_invoice" autocomplete="off" readonly alue="{{$profit->nomor_invoice}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" id="date" name="date" value="{{$profit->date}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="biaya_operasional" class="col-sm-2 col-form-label">Biaya Operasional</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="biaya_operasional" name="biaya_operasional" autocomplete="off" value="{{$profit->biaya_operasional}}">
                </div>
            </div>
            <a href="{{route('profit')}}" class="btn btn-danger mt-4 mr-2">Kembali</a>
            <button type="submit"  class="btn btn-primary  mt-4">Diubah</button>
        </form>
</div>

@endsection