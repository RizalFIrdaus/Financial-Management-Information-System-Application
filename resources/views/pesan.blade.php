@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemesanan</h1>
       
    </div>
  @if (Auth::user()->email == "admin@gmail.com")
  <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">
    <i class="fas fa-plus-square"></i> Tambahkan Pemesanan
  </button>
  @endif

<form action="/pesan/search" method="post">
  @csrf
  <div class="form-row align-items-right">
    <div class="col-sm-3 my-1">
      <label class="sr-only" for="search">Search</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-search"></i></div>
        </div>
        <input type="text" class="form-control" id="search" placeholder="Cari..." autocomplete="off"  name="search" >
      </div>
    </div>
    <div class="col-auto">
      <a href="/pesan" class="btn btn-primary my-1">Reset</i></a>
    </div>
    <div class="col-auto my-1">
      <button type="submit"  class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
@if (session('tambah'))
<div class="alert alert-success">
  {{ session('tambah') }}
</div>
@endif
@if (session('ubah'))
<div class="alert alert-info">
  {{ session('ubah') }}
</div>
@endif
@if (session('hapus'))
<div class="alert alert-danger">
  {{ session('hapus') }}
</div>
@endif
    <div class="row">
        <div class="col-xl col-md mb">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tabel Pemesanan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor PO</th>
                                    <th>Nama Customer</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Tax(pajak)</th>
                                    <th>Total Jual</th>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <th>Action</th>
                                    @endif
                                </tr>
                              
                            </thead>
                            <tbody>
                              @if ($cond == null)
                              <tr>
                                <td colspan="10" class="text-center h4">DATA KOSONG</td>
                            </tr>
                              @else
                              @foreach ($pesan as $var)
                              <tr id="sid{{$var->id}}">
                                  <td>{{($pesan->currentPage() - 1) * $pesan->perPage() + $loop->iteration}}</td>
                                  <td class="nomor_po">{{$var->nomor_po}}</td>
                                  <td class="nama_customer">{{$var->nama_customer}}</td>
                                  <td class="kode_barang">{{$var->kode_barang}}</td>
                                  <td class="nama_barang">{{$var->produk->nama_barang}}</td>
                                  <td class="jumlah_barang">{{$var->jumlah_barang}}</td>
                                  <td class="harga_beli">{{ "Rp " . number_format($var->produk->harga_beli,2,',','.');}}</td>
                                  <td class="harga_jual">{{ "Rp " . number_format($var->produk->harga_jual,2,',','.');}}</td>
                                  <td class="harga_jual">10%</td>
                                  <td class="total_jual">{{ "Rp " . number_format($var->total_jual,2,',','.');}}</td>
                                  @if (Auth::user()->email == "admin@gmail.com")
                                  <td class="d-flex">
                                    <!-- Button trigger modal -->
                                    <a class="btn btn-primary edit mr-2" href="javascript:void(0)" onclick="editPesan({{$var->id}})">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger delete" href="javascript:void(0)" onclick="deletePesan({{$var->id}})">
                                      <i class="fas fa-trash"></i>
                                    </a>
                                   
                                  </td>
                                  @endif
                              </tr>
                          @endforeach
                              @endif
                              
                            </tbody>
                        </table>
                      
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$pesan->links('pagination::bootstrap-4')}}
    </div>

    @if ($cond == null)
        
    @else
        <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pemesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="row g-3" id="editForm" method="POST" action="/pesan/edit/">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id">
                <div class="col-12">
                    <input type="text" class="form-control" id="nomor_po2" name="nomor_po" placeholder="Nomor PO" autocomplete="off">
                  </div>
                <div class="col-md-12 mt-4">
                  <input type="text" class="form-control" id="nama_customer2" name="nama_customer" placeholder="Nama Customer" autocomplete="off">
                </div>
                <div class="col-md-12 mt-4">
                    <select class="form-control"  aria-label="Default select example" id="kode_barang2" name="kode_barang2" >
                      <option value="default">Pilih Kode Barang</option>
                      @foreach ($produks as $produk)
                      <option value="{{$produk->kode_barang}}">{{$produk->kode_barang}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="col-md-12 mt-4">
                    <input placeholder="Jumlah Barang" class="form-control" required type="number" value="" min="0"  name="jumlah_barang" id="jumlah_barang2" autocomplete="off"/>
                  </div>
              
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>
    @endif
  

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="addForm" method="POST" action="/pesan/insert">
          @csrf
         
          <div class="col-12">
              <input type="text" class="form-control" id="nomor_po" name="nomor_po" placeholder="Nomor PO" autocomplete="off">
            </div>
          <div class="col-md-12 mt-4">
            <input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Nama Customer" autocomplete="off">
          </div>
          <div class="col-md-12 mt-4">
            <select class="form-control"  aria-label="Default select example" id="kode_barang" name="kode_barang" >
              <option value="default">Pilih Kode Barang</option>
              @foreach ($produks as $produk)
              <option value="{{$produk->kode_barang}}">{{$produk->kode_barang}}</option>
              @endforeach
            </select>
            </div>
            <div class="col-md-12 mt-4">
              <input placeholder="Jumlah Barang" class="form-control" required type="number" value="" min="0"  name="jumlah_barang" id="jumlah_barang" autocomplete="off"/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit" id="submit">Tambah</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection