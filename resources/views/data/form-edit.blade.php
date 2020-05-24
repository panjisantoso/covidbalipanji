@extends('layout.layout')

@section('title','Data Management')
@section('content')
    <div class="panel-header panel-header-sm">
        
    </div>
    <div class="content">
        <div class="row">   
            <div class="col-md-6 offset-md-3 mr-auto ml-auto">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> 
                            Update Data COVID-19 Bali
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="/data/{{ $data->id }}" method="POST">
                        @csrf         
                        @method("PUT")               
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select class="form-control" style="width: 100%;" name="kabupaten" required>
                                @if ($data->id_kabupaten == 1)
                                    <option value="1" selected="selected">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 2)
                                    <option value="1">Denpasar</option>
                                    <option value="2" selected="selected">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 3)
                                    <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3" selected="selected">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 4)
                                    <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4" selected="selected">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 5)
                                <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5" selected="selected">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 6)
                                <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6" selected="selected">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 7)
                                <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7" selected="selected">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 8)
                                <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8" selected="selected">Karangasem</option>
                                    <option value="9">Klungkung</option>
                                @elseif($data->id_kabupaten == 9)
                                    <option value="1">Denpasar</option>
                                    <option value="2">Bangli</option>
                                    <option value="3">Badung</option>
                                    <option value="4">Tabanan</option>
                                    <option value="5">Jembrana</option>
                                    <option value="6">Buleleng</option>
                                    <option value="7">Gianyar</option>
                                    <option value="8">Karangasem</option>
                                    <option value="9" selected="selected">Klungkung</option>
                                @endif

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="date" name="tanggal" class="form-control" value="{{ $data->tgl_data }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sembuh</label>
                                <input type="number" name="sembuh" class="form-control" placeholder="Jumlah Sembuh" value="{{ $data->sembuh }}" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Dirawat</label>
                                <input type="number" name="rawat" class="form-control" placeholder="Jumlah Dirawat" value="{{ $data->rawat }}" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">meninggal</label>
                                <input type="number" name="meninggal" class="form-control" placeholder="Jumlah Meninggal" value="{{ $data->meninggal }}" required>
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