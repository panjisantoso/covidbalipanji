@extends('layout.layout')

@section('title','Data Management')
@section('content')
    <div class="panel-header panel-header-sm">
    
    </div>
      <div class="content">
        <div class="row">
        <div class="col-lg-12">
        @if ($kabupatenBelumUpdate->count() > 0)
            <div class="alert alert-danger">
                <div>                        
                    <i class=""></i> Data kabupaten tanggal <i>{{$tanggalSekarang}}</i> belum ter-update. Silahkan tambah data
                </div>
            </div>
        @else
            <div class="alert alert-success">
                <p style="font-size: 20px;">
                    <b>Semua Data Kabupaten Sudah Ter-update</b>
                </p>
            </div>
        @endif
        </div>
    <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Data COVID-19 Bali
                  <!-- <input class="form-control" style="float:right; width:40%; font-size:12; height:30;" type="text" id="search1" placeholder="Type to search"> -->
                </h4>
                @if ($kabupatenBelumUpdate->count() > 0)
                    <a href="/data/create"><button type="button" class="btn btn-primary" style="float: right;">Tambah Data</button></a>
                @else
                <a href="/data/create"><button type="button" class="btn btn-primary" style="float: right;">Tambah Data</button></a>
                @endif
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
               
                <div class="panel-heading">
                <!-- <h3 class="panel-title"><center>Tabel Kualitas Udara</h3> -->
              </div>
              <div class="panel-body" style="height:420px;overflow:auto;">
                <table class="table" id="table2">
                  <thead class=" text-primary">
                    <th class="text-center">
                      <b>No</b>
                    </th>
                    <th class="text-center">
                      <b>Kabupaten</b>
                    </th>
                    <th class="text-center">
                      <b>Positif</b>
                    </th>
                    <th class="text-center">
                      <b>Meninggal</b>
                    </th>
                    <th class="text-center">
                      <b>Sembuh</b> 
                    </th>
                    <th class="text-center">
                      <b>Dirawat</b>
                    </th>
                    <th class="text-center">
                      <b>Tanggal</b>
                    </th>
                    <th class="text-center">
                      <b>Edit</b>
                    </th>
                    <th class="text-center">
                      <b>Hapus</b>
                    </th>
                  </thead>
                  <tbody>
                    @for ($i = 1; $i <= sizeof($kabupatens); $i++)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="text-center">{{ $kabupatens[$i-1]->kabupaten }}</td>
                            <td class="text-center">{{ $kabupatens[$i-1]->positif }}</td>
                            <td class="text-center">{{ $kabupatens[$i-1]->meninggal }}</td>
                            <td class="text-center">{{ $kabupatens[$i-1]->sembuh }}</td>
                            <td class="text-center">{{ $kabupatens[$i-1]->rawat }}</td>
                            <td class="text-center">
                            @php
                                 $date[$i-1] = date('d-F-Y', strtotime($kabupatens[$i-1]->tgl_data)) 
                                
                            @endphp
                            {{ $date[$i-1] }}
                            </td>
                            @if( $kabupatens[$i-1]->status == 1 )
                            <td class="text-center">
                                <form action="/data/{{$kabupatens[$i-1]->id}}/edit" method="GET">
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                            @if( $kabupatens[$i-1]->status == 1 )
                            <td class="text-center">
                                <form action="/data/{{$kabupatens[$i-1]->id}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td> 
                           @endif
                        </tr>
                    @endfor
                  </tbody>
                </table>   
              </div>
                </div>
              </div>
            </div>
          </div>


        

    </div>
</div>
          </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
{{-- <script src="/js/app.js"></script> --}}
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection