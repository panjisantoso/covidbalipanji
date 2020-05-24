@extends('layout.layout')

@section('title','Dashboard COVID Bali')
@section('content')
  <div class="panel-header panel-header-sm">
    
  </div>
  <div class="content">
    <div class="row">
      <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0" style="font-size:19px;">Terkonfirmasi Positif</h5>
                        <span class="h4 text-warning font-weight-bold mb-0"> {{$totalPositif[0]->positif}} Orang</span>
                    </div>
                </div>
                <p class="mt-4 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fa fa-arrow-up"></i> +{{ $diffPositif }}</span>
                    <span class="text-nowrap">Dari Kemarin</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0" style="font-size:19px;">Dirawat</h5>
                        <span class="h4 text-blue font-weight-bold mb-0">{{$totalDirawat[0]->rawat}} Orang</span>
                    </div>
                </div>
                <p class="mt-4 mb-0 text-muted text-sm">
                    <span class="text-blue mr-2"><i class="fa fa-arrow-up"></i> +{{ $diffDirawat }} </span>
                    <span class="text-nowrap">Dari Kemarin</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0" style="font-size:19px;">Sembuh</h5>
                        <span class="h4 text-success font-weight-bold mb-0">{{$totalSembuh[0]->sembuh}} Orang</span>
                    </div>
                </div>
                <p class="mt-4 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> +{{ $diffSembuh }}</span>
                    <span class="text-nowrap">Dari kemarin</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0" style="font-size:19px;">Meninggal</h5>
                        <span class="h4 text-danger font-weight-bold mb-0">{{$totalMeninggal[0]->meninggal}} Orang</span>
                    </div>
                </div>
                <p class="mt-4 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> +{{ $diffMeninggal }}</span>
                    <span class="text-nowrap">Dari kemarin</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card-body">
          <div class="row">   
          </div>
      </div>
    </div>
    
    <div class="col-lg-10">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title">Peta Sebaran COVID-19 Bali</h4>
          <h5 class="card-category">Tanggal {{$tanggalSekarang}}</h5>
          <!-- <div class="dropdown">
            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <a class="dropdown-item text-danger" href="#">Remove Data</a>
            </div>
          </div> -->
        </div>
        <div class="card-body">
          <div id="mapid" style="height: 500px"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="text-center" style>Warna Gradasi</h4>
        </div>
        <div class="card-body" style="height:480px;">
          <div class="chart-area">
            <div class="col-12" style="padding-top:50px;">
                Warna Awal
                <input type="color" value="#FFC124" class="form-control" id="colorStart" style="height:50px;">
              </div>
              <div class="col-12">
                Warna Akhir
                <input type="color" value="#FF6C53" class="form-control" id="colorEnd" style="height:50px;">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12" style="padding-top:0px;">
                <button class="btn btn-primary form-control" id="btnGenerateColor">Generate Color</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-lg-12">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title"> Data COVID-19 Bali</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="panel-body" style="height:340px;overflow:auto;">
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
                </thead>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">{{ucfirst($item->kabupaten)}}</td>
                    <td class="text-center">{{$item->positif}}</td>
                    <td class="text-center">{{$item->meninggal}}</td>
                    <td class="text-center">{{$item->sembuh}}</td>
                    <td class="text-center">{{$item->rawat}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section("js")
<script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
<script>
  $(document).ready(function () {
    var dataMap=null;
    var colorMap=[
      "FFC124",
      "FFB629",
      "FFAB2F",
      "FFA135",
      "FF963B",
      "FF8C41",
      "FF8147",
      "FF764D",
      "FF6C53"
    ];
    var tanggal = $('#tanggalSearch').val();
    console.log(tanggal);
    $.ajax({
      async:false,
      url:'getDataMap',
      type:'get',
      dataType:'json',
      data:{date: tanggal},
      success: function(response){
        dataMap = response;
      }
    });
    console.log(dataMap);
    var map = L.map('mapid',{
      fullscreenControl:true,
    });
    
    $('#btnGenerateColor').on('click',function(e){
      var colorStart = $('#colorStart').val();
      var colorEnd = $('#colorEnd').val();
      $.ajax({
        async:false,
        url:'/create-pallete',
        type:'get',
        dataType:'json',
        data:{start: colorStart, end:colorEnd},
        success: function(response){
          colorMap = response;
          setMapColor();
          
        }
      });
      
    });
    
    
    map.setView(new L.LatLng(-8.5000047,115.1869968),9);
    var OpenTopoMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 20,
            // zoomAnimation:true,
            id: 'mapbox/streets-v11',
            // tileSize: 512,
            // zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoid2lkaWFuYXB3IiwiYSI6ImNrNm95c2pydjFnbWczbHBibGNtMDNoZzMifQ.kHoE5-gMwNgEDCrJQ3fqkQ',
        }).addTo(map);
    OpenTopoMap.addTo(map);
    var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
    setMapColor();
    
    function setMapColor(){
      var BADUNG,BULELENG,BANGLI,DENPASAR,GIANYAR,JEMBRANA,KARANGASEM,KLUNGKUNG,TABANAN;
      dataMap.forEach(function(value,index){
        
        var colorKab = dataMap[index].kabupaten.toUpperCase();
        if(colorKab == "BADUNG"){
          BADUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="BULELENG"){
          BULELENG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        } else if(colorKab=="BANGLI"){
          BANGLI = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="DENPASAR"){
          DENPASAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="GIANYAR"){
          GIANYAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab =="JEMBRANA"){
          JEMBRANA = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="KARANGASEM"){
          KARANGASEM = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="TABANAN"){
          TABANAN = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab =="KLUNGKUNG"){
          KLUNGKUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }

      });
      var kmzParser = new L.KMZParser({
          onKMZLoaded: function (kmz_layer, name) {
              control.addOverlay(kmz_layer, name);
              var layers = kmz_layer.getLayers()[0].getLayers();
              layers.forEach(function(layer, index){
                var kab  = layer.feature.properties.NAME_2;
                kab = kab.toUpperCase();
                var kabLower = kab.toLowerCase();

                if(!Array.isArray(dataMap) || !dataMap.length == 0){
                // set sub layer default style positif covid
                  // var STYLE = {opacity:'1',color:'#000',fillOpacity:'1',fillColor:'#'+colorMap[index]}; 
                  // layer.setStyle(STYLE);
                  if(kab == 'BADUNG'){
                    layer.setStyle(BADUNG);
                  }else if(kab == 'BANGLI'){
                    layer.setStyle(BANGLI);
                  }else if(kab == 'BULELENG'){
                    layer.setStyle(BULELENG);
                  }else if(kab == 'DENPASAR'){
                    layer.setStyle(DENPASAR);
                  }else if(kab == 'GIANYAR'){
                    layer.setStyle(GIANYAR);
                  }else if(kab == 'JEMBRANA'){
                    layer.setStyle(JEMBRANA);
                  }else if(kab == 'KARANGASEM'){
                    layer.setStyle(KARANGASEM);
                  }else if(kab == 'KLUNGKUNG'){
                    layer.setStyle(KLUNGKUNG);
                  }else if(kab == 'TABANAN'){
                    layer.setStyle(TABANAN);
                  } 
                  var data = '<table width="130">';
                    data +='  <tr>';
                    data +='    <th colspan="2"><center>'+kab+'</center></th>';
                    data +='  </tr>';
        
                    data +='  <tr style="color:#FFC124">';
                    data +='    <td>Terkonfirmasi Positif</td>';
                    data +='    <td>: '+dataMap[index].positif+'</td>';
                    data +='  </tr>';

                    data +='  <tr style="color:grey">';
                    data +='    <td>Dirawat</td>';
                    data +='    <td>: '+dataMap[index].rawat+'</td>';
                    data +='  </tr>';    

                    data +='  <tr style="color:green">';
                    data +='    <td>Sembuh</td>';
                    data +='    <td>: '+dataMap[index].sembuh+'</td>';
                    data +='  </tr>'; 

                    data +='  <tr style="color:red">';
                    data +='    <td>Meninggal</td>';
                    data +='    <td>: '+dataMap[index].meninggal+'</td>';
                    data +='  </tr>';
            
                    data +='</table>';
                }else{
                  var data = "Tidak ada Data pada tanggal tersebut"
                  layer.setStyle(defStyle);
                }
                layer.bindPopup(data);
              });
              kmz_layer.addTo(map);
          }
      });
      kmzParser.load('bali-kabupaten.kmz');
      var control = L.control.layers(null, null, {
          collapsed: true
      }).addTo(map);
      $('.leaflet-control-layers').hide();

    }
  });
</script>
@endsection