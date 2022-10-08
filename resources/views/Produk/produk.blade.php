@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
    </div>
        <!-- Button trigger modal -->
        @if (Auth::user()->email == "admin@gmail.com")
          <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModalProduk">
          <i class="fas fa-plus-square"></i> Tambahkan Produk
          </button>
        @endif
  <form action="/produk/search" method="post">
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
        <a href="/produk" class="btn btn-primary my-1">Reset</a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Tabel Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
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
                                @foreach ($produk as $var)
                                <tr  id="sid{{$var->id}}">
                                    <td>{{($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration}}</td>
                                    <td class="kode_barang">{{$var->kode_barang}}</td>
                                    <td class="nama_barang">{{$var->nama_barang}}</td>
                                    <td class="harga_beli">{{"Rp " . number_format($var->harga_beli,2,',','.')}}</td>
                                    <td class="harga_jual">{{"Rp " . number_format($var->harga_jual,2,',','.')}}</td>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <td class="d-flex">
                                      
                                      <a class="btn btn-primary mr-2" href="/produk/edit/{{$var->id}}">
                                        <i class="fas fa-edit"></i>
                                     </a>
                                        @if (!$pesans->contains('kode_barang',$var->kode_barang))
                                        <a class="btn btn-danger delete" href="javascript:void(0)" onclick="deleteProduk({{$var->id}})">
                                          <i class="fas fa-trash"></i>
                                       </a>
                                        @endif
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
            <div class="d-flex justify-content-center">
                {{$produk->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</div>



<!-- Add Modal -->
<div class="modal fade" id="addModalProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="row g-3" id="addFormProduk" method="POST" action="/produk/insert">
            @csrf
            <div class="col-12">
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" autocomplete="off">
              </div>
            <div class="col-md-12 mt-4">
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" autocomplete="off">
            </div>
            <div class="col-md-12 mt-4">
              <input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli" autocomplete="off">
            </div>
            <div class="col-md-12 mt-4">
              <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual" autocomplete="off">
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