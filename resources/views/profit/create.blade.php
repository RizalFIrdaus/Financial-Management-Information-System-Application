@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">From Create Profit</h1>
    </div>
        <form action="{{route('profit.store')}}" method="post" class="ml-5 mt-5">
            @csrf
            <input type="hidden" name="nomor_invoice" value="{{str_pad($count+1, 3, '0', STR_PAD_LEFT)}}">
            <div class="mb-3 row">
                <label for="nomor_po" class="col-sm-2 col-form-label">Nomor PO</label>
                <div class="col-sm-6">
                    <select class="form-control"  aria-label="Default select example" id="nomor_po" name="nomor_po" >
                        <option value="default">Pilih Nomor PO</option>
                        @foreach ($pesan as $var)
                        <option value="{{$var->nomor_po}}">{{$var->nomor_po}}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" autocomplete="off">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" id="date" name="date">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="biaya_operasional" class="col-sm-2 col-form-label">Biaya Operasional</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="biaya_operasional" name="biaya_operasional" autocomplete="off">
                </div>
            </div>
            <a href="{{route('profit')}}" class="btn btn-danger mt-4 mr-2">Kembali</a>
            <button type="submit" name="submit" class="btn btn-primary  mt-4">Tambahkan</button>
        </form>
</div>

@endsection