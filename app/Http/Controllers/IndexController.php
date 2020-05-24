<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Kabupaten;
use App\Data;
use Carbon\Carbon as Carbon;
class IndexController extends Controller
{

    private $dateTimeNow;
    private $dateNow;
    private $dateFormatName;
    private $dateFormatName1;

    public function __construct()
    {
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
        // return $this->dateNow->locale('in')->format('Y/m/d');
        // $now1 = date("F d, Y h:i:s A");
        // return $now1;
        // 
        $tanggalSekarang = $this->dateFormatName;
        $data = Data::select('kabupaten','meninggal','positif','rawat','sembuh','tgl_data','status')
            ->join('tb_kabupaten','tb_data.id_kabupaten','=','tb_kabupaten.id')
            ->where('tgl_data',$this->dateNow)
            ->orderBy('positif','DESC')
            ->get();
        $totalMeninggal = Data::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tgl_data',$this->dateNow)->get();
        $totalPositif = Data::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tgl_data',$this->dateNow)->get();
        $totalDirawat = Data::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tgl_data',$this->dateNow)->get();
        $totalSembuh = Data::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tgl_data',$this->dateNow)->get();
        
        $tanggal = Data::select('tgl_data')
        ->groupBy('tgl_data')->orderBy('tgl_data', 'DESC')->take(2)->get();
        $dataAja = Data::get();
        $diffPos = array();
        $diffRaw = array();
        $diffSem = array();
        $diffMen = array();

        for ($i=0; $i < count($tanggal); $i++) {
            $perbedaanPositif[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.positif');
            $perbedaanRawat[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.rawat');
            $perbedaanSembuh[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.sembuh');
            $perbedaanMeninggal[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.meninggal');
            array_push($diffPos, $perbedaanPositif[$i]);
            array_push($diffRaw, $perbedaanRawat[$i]);
            array_push($diffSem, $perbedaanSembuh[$i]);
            array_push($diffMen, $perbedaanMeninggal[$i]);
        }
        
        for ($i=0; $i < count($perbedaanPositif); $i++) {
            $data1[$i] = $perbedaanPositif[$i];
        }
        for ($i=0; $i < count($perbedaanRawat); $i++) {
            $data2[$i] = $perbedaanRawat[$i];
        }
        for ($i=0; $i < count($perbedaanSembuh); $i++) {
            $data3[$i] = $perbedaanSembuh[$i];
        }
        for ($i=0; $i < count($perbedaanMeninggal); $i++) {
            $data4[$i] = $perbedaanMeninggal[$i];
        }
        $diffPositif = $data1[0] - $data1[1];
        $diffDirawat = $data2[0] - $data2[1];
        $diffSembuh = $data3[0] - $data3[1];
        $diffMeninggal = $data4[0] - $data4[1];
        
        return view('index',compact("diffPositif","diffDirawat","diffSembuh","diffMeninggal", "data","totalMeninggal","totalPositif","totalDirawat","totalSembuh","tanggalSekarang"));
    }

    public function search(Request $request){
        // return $request;
        $tanggal = $request->tanggal;
        $tanggalSekarang = Carbon::parse($request->tanggal)->format('d F Y');
        $cekData = Data::select('kabupaten','meninggal','positif','rawat','sembuh','tgl_data')
            ->rightjoin('tb_kabupaten','tb_data.id_kabupaten','=','tb_kabupaten.id')
            ->where('tgl_data',$request->tanggal)
            ->orderBy('positif','DESC')
            ->get();
        if (count($cekData) == 0) {
            $data = Kabupaten::select('kabupaten',DB::raw('IFNULL("0",0) as meninggal'), DB::raw('IFNULL("0",0) as positif'), DB::raw('IFNULL("0",0) as rawat'),DB::raw('IFNULL("0",0) as sembuh'))->get();
        }else{
            $data = $cekData;
        }
        $totalMeninggal = Data::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tgl_data',$request->tanggal)->get();
        $totalPositif = Data::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tgl_data',$request->tanggal)->get();
        $totalDirawat = Data::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tgl_data',$request->tanggal)->get();
        $totalSembuh = Data::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tgl_data',$request->tanggal)->get();
        
        $tanggal = Data::select('tgl_data')
        ->groupBy('tgl_data')->orderBy('tgl_data', 'DESC')->take(2)->get();
        $dataAja = Data::get();
        $diffPos = array();
        $diffRaw = array();
        $diffSem = array();
        $diffMen = array();

        for ($i=0; $i < count($tanggal); $i++) {
            $perbedaanPositif[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.positif');
            $perbedaanRawat[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.rawat');
            $perbedaanSembuh[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.sembuh');
            $perbedaanMeninggal[$i] = DB::table('tb_data')->where("tgl_data", date("Y-m-d", strtotime($tanggal[$i]->tgl_data)))->sum('tb_data.meninggal');
            array_push($diffPos, $perbedaanPositif[$i]);
            array_push($diffRaw, $perbedaanRawat[$i]);
            array_push($diffSem, $perbedaanSembuh[$i]);
            array_push($diffMen, $perbedaanMeninggal[$i]);
        }
        
        for ($i=0; $i < count($perbedaanPositif); $i++) {
            $data1[$i] = $perbedaanPositif[$i];
        }
        for ($i=0; $i < count($perbedaanRawat); $i++) {
            $data2[$i] = $perbedaanRawat[$i];
        }
        for ($i=0; $i < count($perbedaanSembuh); $i++) {
            $data3[$i] = $perbedaanSembuh[$i];
        }
        for ($i=0; $i < count($perbedaanMeninggal); $i++) {
            $data4[$i] = $perbedaanMeninggal[$i];
        }
        $diffPositif = $data1[0] - $data1[1];
        $diffDirawat = $data2[0] - $data2[1];
        $diffSembuh = $data3[0] - $data3[1];
        $diffMeninggal = $data4[0] - $data4[1];

        return view('index',compact("diffPositif","diffDirawat","diffSembuh","diffMeninggal", "data","totalMeninggal","totalPositif","totalDirawat","totalSembuh","tanggalSekarang","tanggal"));
    }

    public function getDataMap(Request $request){
        if (is_null($request->date)) {
            $tanggal = $this->dateNow;
        }else{
            $tanggal = $request->date;
        }
        $data = Data::select('kabupaten','meninggal','positif','rawat','sembuh','tgl_data')
        ->rightjoin('tb_kabupaten','tb_data.id_kabupaten','=','tb_kabupaten.id')
        ->where('tgl_data', $tanggal)
        ->orderBy('positif','DESC')
        ->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createPallette(Request $request)
    {

        $HexFrom = ltrim($request->start, '#');
        $HexTo = ltrim($request->end, '#');

    
        $ColorSteps = 9;
        $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
        $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
        $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
    
        $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
        $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
        $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));
    
        $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
        $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
        $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
    
        $GradientColors = array();
    
        for($i = 0; $i <= $ColorSteps; $i++) {
        $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
        $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
        $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));
    
        $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
        $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
        $HexRGB['b'] = sprintf('%02x', ($RGB['b']));
    
        $GradientColors[] = implode(NULL, $HexRGB);
        }
        $collect = collect($GradientColors);
        $filtered = $collect->filter(function($value, $key){
            return strlen($value) == 6;
        });
        return $filtered;
    }

    
    function len($val){
        return (strlen($val) == 6 ? true : false );
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
