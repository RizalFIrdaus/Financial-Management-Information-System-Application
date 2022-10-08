<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

 

    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <style>
        .tagihan_lunas{
            background-color: rgb(0, 194, 0);
            color: white;
            font-weight: bold;
        }
        .tagihan_belum_lunas{
            background-color: salmon;
            color: white;
            font-weight: bold;
        }
    </style>

</head>
<body>
    <!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion list-active" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
               
            </div>
            <div class="sidebar-brand-text mx-3">Isogo Fuji Aditama</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

      
       
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('pesan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pesan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('produk') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Produk</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('profit') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Profit</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penagihan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Penagihan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

               
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                   
                   

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize">{{Auth::user()->name;}}</span> --}}
                            <img class="img-profile rounded-circle"
                                src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" >
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>

            </nav>
            <!-- End of Topbar -->
            @yield('content')
    

   
    
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    {{-- Snipper Input CCount --}}
    <script src="./src/bootstrap-input-spinner.js"></script>



     
    <script>
      $("input[type='number']").inputSpinner();
      $("addForm").submit(function(e){
          e.preventDefault();
          let nomor_po = $('#nomor_po').val();
          let nama_customer = $('#nama_customer').val();
          let kode_barang = $('#kode_barang').val();
          let jumlah_barang = $('#jumlah_barang').val();
          let _token = $("input[name=_token]").val();

          $.ajax({
              url:"{{route('insert')}}",
              type:"POST",
              data:{
                  nomor_po:nomor_po,
                  nama_customer:nama_customer,
                  kode_barang:kode_barang,
                  jumlah_barang:jumlah_barang,
                  _token:_token
              } ,
              success:function(response){
                  
               
                  if(response){
                      $("#dataTable tbody").prepend('<tr><td>'+response.nomor_po+'</td><td>'+response.nama_customer+'</td><td>'+response.kode_barang+'</td><td>'+response.nama_customer+'</td><td>'+response.jumlah_barang+'</td><td>'+response.harga_beli+'</td><td>'+response.harga_jual+'</td></tr>')
                      $("#addForm")[0].reset();
                      $("#addModal").modal('hide');
                      location.reload();
                  }
              }
          })


      })
       
    </script>

    <script>
         function editPesan(id){
            $.get('/pesan/'+id,function(pesan){
                $('#id').val(pesan.id);
                $('#nomor_po2').val(pesan.nomor_po);
                $('#nama_customer2').val(pesan.nama_customer);
                $('#kode_barang2').val(pesan.kode_barang);
                $('#jumlah_barang2').val(pesan.jumlah_barang);
                $('#editModal').modal('toggle');
                                
              })
        }
        $("#editForm").submit(function(e){
            e.preventDefault();

          let id = $('#id').val();
          let nomor_po = $('#nomor_po2').val();
          let nama_customer = $('#nama_customer2').val();
          let kode_barang = $('#kode_barang2').val();
          let jumlah_barang = $('#jumlah_barang2').val();
          let _token = $("input[name=_token]").val();

          $.ajax({
              url:"{{route('pesan.update')}}",
              type:"PUT",
              data:{
                  id:id,
                  nomor_po:nomor_po,
                  nama_customer:nama_customer,
                  kode_barang:kode_barang,
                  jumlah_barang:jumlah_barang,
                  _token:_token
              } ,
              success:function(response){
                 $("#sid"+response.id  + "td:nth-child(1)").text(response.nomor_po);
                 $("#sid"+response.id  + "td:nth-child(2)").text(response.nama_barang);
                 $("#sid"+response.id  + "td:nth-child(3)").text(response.kode_barang);
                 $("#sid"+response.id  + "td:nth-child(5)").text(response.jumlah_barang);
                 $('#editModal').modal('toggle');
                 $("#editForm")[0].reset();
                 location.reload();
              }
          })
        })
    </script>

    <script>
        function deletePesan(id){
            if(confirm('Apakah anda yakin ingin menghapus data ini ?')){
                $.ajax({
                    url:'/pesan/'+id,
                    type:'delete',
                    data:{
                        _token:$("input[name=_token]").val()
                    },
                    success:function(response){
                        $("#sid"+id).remove();
                        location.reload();
                    }
                })
            }
        }
    </script>


{{-- PRODUK --}}
<script>
     $("addFormProduk").submit(function(e){
          e.preventDefault();
          let kode_barang = $('#kode_barang').val();
          let nama_barang = $('#nama_barang').val();
          let harga_beli = $('#harga_beli').val();
          let harga_jual = $('#harga_jual').val();
          let _token = $("input[name=_token]").val();
          $.ajax({
              url:"{{route('insert.produk')}}",
              type:"POST",
              data:{
                  kode_barang:kode_barang,
                  nama_barang:nama_barang,
                  harga_beli:harga_beli,
                  harga_jual:harga_jual,
                  _token:_token
              } ,
              success:function(response){
                  
                  if(response){
                      $("#dataTable tbody").prepend('<tr><td>'+response.kode_barang+'</td><td>'+response.nama_barang+'</td><td>'+response.harga_beli+'</td><td>'+response.harga_jual'</td></tr>')
                      $("#addFormProduk")[0].reset();
                      $("#addModalProduk").modal('hide');
                      location.reload();
                  }
              }
          })


      })
</script>

<script>
    function deleteProduk(id){
        if(confirm('Apakah anda yakin ingin menghapus data ini ?')){
            $.ajax({
                url:'/produk/'+id,
                type:'delete',
                data:{
                    _token:$("input[name=_token]").val()
                },
                success:function(response){
                    $("#sid"+id).remove();
                    location.reload();
                }
            })
        }
    }

   
</script>



</body>
</html>
