<?php

namespace App\Http\Controllers;

use App\Data;
use App\Kabupaten;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
class DataController extends Controller
{
    private $dateTimeNow;
    private $dateNow;
    private $dateFormatName;
    public function __construct(){
        
        $this->dateTimeNow = Carbon::now()->addHours(8);
        $this->dateNow = Carbon::now()->format('Y-m-d');
        $this->dateFormatName = Carbon::now()->locale('id')->isoFormat('LL');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kabupatens = Data::select("tb_data.id","tb_kabupaten.kabupaten","tb_data.positif","tb_data.meninggal","tb_data.sembuh","tb_data.rawat","tb_data.tgl_data","tb_data.status")
        ->join('tb_kabupaten', 'tb_kabupaten.id','=','tb_data.id_kabupaten')->orderBy('tb_data.tgl_data', 'ASC')
        ->get();
        $tanggalSekarang = $this->dateFormatName;
        $kabupaten = Kabupaten::get();
        $kabupatenBelumUpdate = Kabupaten::whereDoesntHave('data', function($query){
            $query->where('tgl_data','=',$this->dateNow)->where('updated_at','!=','0000-00-00 00:00:00');
        })->get();

        

        return view('data.index', compact("kabupatens","kabupaten","kabupatenBelumUpdate","tanggalSekarang"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tanggalSekarang = $this->dateFormatName;
        $kabupaten = Kabupaten::get();
        $kabupatenBelumUpdate = Kabupaten::whereDoesntHave('data', function($query){
            $query->where('tgl_data','=',$this->dateNow)->where('updated_at','!=','0000-00-00 00:00:00');
        })->get();
        return view('data.form-add', compact("kabupatens","kabupaten","kabupatenBelumUpdate","tanggalSekarang"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Data::where('id_kabupaten',$request->kabupaten)->where('tgl_data',$request->tanggal)->count();
        if($cek == 0){
            $data = new Data();
        }else{
            $data = Data::where('id_kabupaten',$request->kabupaten)->where('tgl_data',$request->tanggal)->first();
        }
        
        $data->id_kabupaten = $request->kabupaten;
        $data->meninggal = $request->meninggal;
        $data->sembuh = $request->sembuh;
        $data->rawat = $request->rawat;
        $data->tgl_data = $request->tanggal;
        $data->positif = $request->sembuh + $request->rawat + $request->meninggal;
        $data->status = 1;
        if($cek == 0){
            $data->save();
        }else{
            $data->update();
        }
        
        return redirect('/data');
        return $request;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tanggalSekarang = $this->dateFormatName;
        $kabupaten = Kabupaten::get();
        $kabupatenBelumUpdate = Kabupaten::whereDoesntHave('data', function($query){
            $query->where('tgl_data','=',$this->dateNow)->where('updated_at','!=','0000-00-00 00:00:00');
        })->get();
        $data = Data::find($id);
        return view("data.form-edit", compact("data","kabupaten","kabupatenBelumUpdate","tanggalSekarang"));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cek = Data::where('id_kabupaten',$request->kabupaten)->where('tgl_data',$request->tanggal)->count();
        if($cek == 0){
            $data = new Data();
        }else{
            $data = Data::where('id_kabupaten',$request->kabupaten)->where('tgl_data',$request->tanggal)->first();
        }
        $data->id_kabupaten = $request->kabupaten;
        $data->meninggal = $request->meninggal;
        $data->sembuh = $request->sembuh;
        $data->rawat = $request->rawat;
        $data->tgl_data = $request->tanggal;
        $data->positif = $request->sembuh + $request->rawat + $request->meninggal;
        
        $data->save();
        
        return redirect('/data');
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabupatens = Data::find($id);
        $kabupatens->status = 0;
        $kabupatens->save();
        return redirect("/data");
    }

    

}
