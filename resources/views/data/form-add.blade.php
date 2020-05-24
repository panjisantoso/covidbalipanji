@extends('layout.layout')

@section('title','Data Management')
@section('content')
    <div class="panel-header panel-header-sm">
        
    </div>
    <div class="content">
        <div class="row">   
            <div class="col-md-6 offset-md-3 mr-auto ml-auto">
            @if ($kabupatenBelumUpdate->count() > 0)
                <div class="alert alert-warning">
                    <div>                        
                    <i class="icon fa fa-calendar red"></i> Data Kabupaten Yang Belum Diupdate per <strong>{{$tanggalSekarang}}</strong>
                        <p>
                            @foreach ($kabupatenBelumUpdate as $item)
                                {{$item->kabupaten}} ,
                            @endforeach    
                        </p>                    
                    </div>
                </div>
            @else
                <div class="alert alert-success">
                    <div>                        
                        <p style="font-size: 20px;">
                            <b>Semua Data Kabupaten Sudah Ter-update</b>
                        </p>                   
                    </div>
                </div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> 
                            Create Data COVID-19 Bali
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="/data" method="POST">
                        @csrf                        
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select class="form-control" style="width: 100%;" name="kabupaten" required>
                                    <option value="">Pilih kabupaten</option>
                                    @foreach ($kabupaten as $item)
                                        <option value="{{$item->id}}">{{ucfirst($item->kabupaten)}}</option>      
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sembuh</label>
                                <input type="number" name="sembuh" class="form-control" placeholder="Jumlah Sembuh" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Dirawat</label>
                                <input type="number" name="rawat" class="form-control" placeholder="Jumlah Dirawat" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">meninggal</label>
                                <input type="number" name="meninggal" class="form-control" placeholder="Jumlah Meninggal" required>
                            </div>               
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>          
                    </div>
                </form>
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