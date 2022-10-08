@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Profit</h1>
        
    </div>
    @if (Auth::user()->email == "admin@gmail.com")
    <a href="/profit/create" class="btn btn-primary mb-4"><i class="fas fa-plus-square"></i> Tambah Data Profit</a>
    @endif
    <form action="/profit/search" method="post">
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
            <a href="/profit" class="btn btn-primary my-1">Reset</i></a>
          </div>
          <div class="col-auto my-1">
            <button type="submit"  class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
      
<a href="/export" class="btn btn-success my-3">EXPORT EXCEL</a>
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
                                    <th>Nama Perusahaan</th>
                                    <th>Nomor Invoice</th>
                                    <th>Date</th>
                                    <th>Biaya Operasional</th>
                                    <th>Laba</th>
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
                                @foreach ($profit as $var)
                                <tr>
                                    <td>{{($profit->currentPage() - 1) * $profit->perPage() + $loop->iteration}}</td>
                                    <td>{{$var->nomor_po}}</td>
                                    <td>{{$var->nama_perusahaan}}</td>
                                    <td>{{$var->nomor_invoice}}</td>
                                    <td>{{$var->date}}</td>
                                    <td>{{"Rp " . number_format($var->biaya_operasional,2,',','.')}}</td>
                                    <td>{{"Rp " . number_format($var->total_jual,2,',','.')}}</td>
                                    @if (Auth::user()->email == "admin@gmail.com")
                                    <td class="d-flex">
                                        <a class="btn btn-primary mr-2" href="/profit/edit/{{$var->id}}">
                                            <i class="fas fa-edit"></i>
                                         </a>
                                         <form action="/profit/delete/{{$var->id}}" method="post">
                                             @csrf
                                             @method('delete')
                                             <button type="submit" class="btn btn-danger" onclick="confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></button>
                                         </form>
                                       
                                      </td>
                                    @endif
                                   
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            @if ($cond == null)
                            @else
                            <tfoot style="background-color: #0275d8;color:white;font-weight:bolder;">
                              <tr>
                               <td colspan="6">Jumlah Profit</td>
                               <td colspan="5">{{"Rp " . number_format($sumProfit,2,',','.')}}</td>
                             </tr>
                             <tr>
                              <td colspan="6">Average Profit(%)</td>
                              <td colspan="5">{{((number_format($sumProfit/$sumHargaBeli,2))*100)}}%</td>
                             </tr>
                           </tfoot>
                            @endif
                           
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$profit->links('pagination::bootstrap-4')}}
    </div>
</div>


@endsection