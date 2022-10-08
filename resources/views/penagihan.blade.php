@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penagihan</h1>
    </div>
    <form action="/penagihan/search" method="post">
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
            <a href="/penagihan" class="btn btn-primary my-1">Reset</a>
          </div>
          <div class="col-auto my-1">
            <button type="submit"  class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    <div class="row">
        <div class="col-xl col-md mb">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tabel Penagihan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Nomor Invoice</th>
                                    <th>Total Tagihan</th>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <th>Status Tagihan</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cond == null)
                              <tr>
                                <td colspan="10" class="text-center h4">DATA KOSONG</td>
                              </tr>
                            @else
                                @foreach ($profit as $var)
                                @if($var->status == "lunas")
                                <tr  id="sid{{$var->id}}" class="tagihan_lunas">
                                    <td>{{($profit->currentPage() - 1) * $profit->perPage() + $loop->iteration}}</td>
                                    <td class="kode_barang">{{$var->nama_perusahaan}}</td>
                                    <td class="nama_barang">{{$var->nomor_invoice}}</td>
                                    <td class="total_tagihan">{{"Rp " . number_format($var->pesan->total_jual,2,',','.')}}</td>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <td class="d-flex">
                                        <div class="col-8">
                                            <form action="/penagihan" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$var->id}}">
                                                <select class="form-control"  aria-label="Default select example" id="status" name="status" onchange=" this.form.submit();">
                                                    <option value="belum">Pilih</option>
                                                    <option value="lunas">Lunas</option>
                                                    <option value="belum">Belum Lunas</option>
                                                  </select>
                                            </form>
                                        </div>
                                      </td>
                                    @endif
                                </tr>
                                @endif
                                @if($var->status == "belum")
                                <tr  id="sid{{$var->id}}" class="tagihan_belum_lunas">
                                    <td>{{($profit->currentPage() - 1) * $profit->perPage() + $loop->iteration}}</td>
                                    <td class="kode_barang">{{$var->nama_perusahaan}}</td>
                                    <td class="nama_barang">{{$var->nomor_invoice}}</td>
                                    <td class="total_tagihan">{{"Rp " . number_format($var->pesan->total_jual,2,',','.')}}</td>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <td class="d-flex">
                                        <div class="col-8">
                                            <form action="/penagihan" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$var->id}}">
                                                <select class="form-control"  aria-label="Default select example" id="status" name="status" onchange=" this.form.submit();">
                                                    <option value="belum">Pilih</option>
                                                    <option value="lunas">Lunas</option>
                                                    <option value="belum">Belum Lunas</option>
                                                  </select>
                                            </form>
                                        </div>
                                      </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection