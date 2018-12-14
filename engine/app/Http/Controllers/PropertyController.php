<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Owner;
use App\Ownermeta;
use App\Agen;
use App\Provinsi;
use App\Property;
use App\propertymeta;
use App\Kawasan;
use App\Kabupaten;
use Image;
use Carbon\Carbon;
use DB;
use Session;
use Redirect;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a='';
        $b='';
        $user = DB::table('users')
            ->where('id', $_GET['status'])
            ->get();
        foreach ($user as $user) {
            $a = $user->role;
            $b = $user->status;
        }
        if ($a=='superuser') {

            $tampilagen =  Agen::all();
            $tampilproperty = DB::table('property')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->leftjoin('agen', 'property_agen', '=', 'agen.agen_id')
                ->leftjoin('owner', 'property_owner', '=', 'owner.id')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                /*->where([
                    ['status', '=', '1'],
                    ['subscribed', '<>', '1'],
                ])*/
                ->get();
        } else {
            $tampilagen = DB::table('agen')
                ->where('agen_keterangan', 'LIKE','%'. $b.'%')
                ->get();
            $tampilproperty = DB::table('property')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                //->leftjoin('agen', 'property_agen' , '=', 'agen.agen_id')
                ->leftjoin('owner', 'property_owner', '=', 'owner.id')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->where('property_kantor', 'LIKE','%'. $b.'%')
                /*->where([
                    ['status', '=', '1'],
                    ['subscribed', '<>', '1'],
                ])*/
                ->get();
        }
        
        return view('adminlte::property')
            ->with('tampilproperty', $tampilproperty)
            ->with('tampilagen', $tampilagen);

        //return view('adminlte::property',['tampilproperty' => $tampilproperty]);

        // ->with('agenarray', $agenarray[]);
    }
    
    public function getagen($status, $kantor, $agen) {
        $kantor = explode(";",$kantor);
            $agen = explode(";",$agen);
            for ($k=0; $k < count($kantor); $k++) { 
                # code...
                if ($kantor[$k]==$status) {
                    # code...

                    echo $agen[$k];
                }
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $idowner = 0;
        $owner = $request->pilihowner;
        if ($owner == "ownerlama") {
            # code...
            $idowner = $request->owner;

        } else {
            # code...

            if ($request->ket!='ada') {
                # code...
                $data = new Owner();
                $data->nama = $request->namaowner;
                $data->alamat = $request->alamatowner;
                $data->no_ktp = $request->noktpowner;
                $data->save();
            }

            $owner = Owner::where('no_ktp', $request->noktpowner)->first();

            $data1 = new Ownermeta();
            $data1->owner_id = $owner->id;
            $data1->status = $request->kantor;
            $data1->value = $request->nohpowner.";".$request->bbmowner.";".$request->emailowner;
            $data1->save();

            $idowner = $owner->id;



        }

        $idlokasi = '';
        $lokasi = $request->tambahlokasi;
        if ($lokasi == "") {
            # code...
            $idlokasi = $request->lokasi;

        } else {
            # code...

            $data = new Kawasan();
            $data->nama_kawasan = $request->lokasibaru;
            
            $data->save();

            $lokasi = DB::table('kawasan')
                ->orderBy('id_kawasan', 'desc')
                ->limit(1)
                ->get();

            foreach ($lokasi as $lokasi)
            {
                $idlokasi = $lokasi->id_kawasan;
            }



        }
        //echo $idowner ;

        if ($request->harga==''){
            $harga = 0;
        } elseif ($request->harga!='') {
            $harga = $request->harga;
        }  else {
            $harga = $request->harga;
        }
        if ($request->hargasewajual==''){
            $hargasewajual = 0;
        } else {
            $hargasewajual = $request->hargasewajual;
        }
        if ($request->hargapermeter==''){
            $hargapermeter = 0;
        } else {
            $hargapermeter = $request->hargapermeter;
        }
        $dataproperty = new property();
        $dataproperty->property_status = $request->status;
        $dataproperty->property_jenis = $request->jenispropperty;
        $dataproperty->property_owner = $idowner;
        $dataproperty->property_agen = $request->agen.";";
        $dataproperty->property_agen_2 = $request->agen_2;
        $dataproperty->property_kabupatenkota = $request->kabupatenkota;
        $dataproperty->property_lokasi = $idlokasi;
        $dataproperty->property_lokasi_detail = $request->detaillokasi;
        $dataproperty->property_kawasan = $request->kawasan;
        $dataproperty->property_harga = $harga;
        $dataproperty->property_harga_sewa = $hargasewajual;
        $dataproperty->property_harga_meter = $hargapermeter;
        $dataproperty->property_tanggal = Carbon::now();
        $dataproperty->property_image = '';
        $avatarName1 = "";
        $avatarName2 = "";
        $avatarName3 = "";
        $avatarName4 = "";
        $avatarName5 = "";
        $avatarName6 = "";
        $avatarName7 = "";
        $avatarName8 = "";
        $avatarName9 = "";
        $avatarName10 = "";
        $ketimage = 0;
        $image = $request->file('avatar');
        if(!empty($image))
        {

            $avatarName = 'item' . rand(11111,99999) . '.' . 
            $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move('img/property/', $avatarName);
            $dataproperty->property_image = $avatarName;
            $ketimage = 1;

        }
        $image1 = $request->file('gallery_1');
        if(!empty($image1))
        {

            $avatarName1 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_1')->getClientOriginalExtension();

            $request->file('gallery_1')->move('img/property/', $avatarName1);


        }
        $image2 = $request->file('gallery_2');
        if(!empty($image2))
        {

            $avatarName2 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_2')->getClientOriginalExtension();

            $request->file('gallery_2')->move('img/property/', $avatarName2);


        }
        $image3 = $request->file('gallery_3');
        if(!empty($image3))
        {

            $avatarName3 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_3')->getClientOriginalExtension();

            $request->file('gallery_3')->move('img/property/', $avatarName3);


        }
        $image4 = $request->file('gallery_4');
        if(!empty($image4))
        {

            $avatarName4 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_4')->getClientOriginalExtension();

            $request->file('gallery_4')->move('img/property/', $avatarName4);


        }
        $image5 = $request->file('gallery_5');
        if(!empty($image5))
        {

            $avatarName5 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_5')->getClientOriginalExtension();

            $request->file('gallery_5')->move('img/property/', $avatarName5);


        }
        $image6 = $request->file('gallery_6');
        if(!empty($image6))
        {

            $avatarName6 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_6')->getClientOriginalExtension();

            $request->file('gallery_6')->move('img/property/', $avatarName6);


        }
        $image7 = $request->file('gallery_7');
        if(!empty($image7))
        {

            $avatarName7 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_7')->getClientOriginalExtension();

            $request->file('gallery_7')->move('img/property/', $avatarName7);


        }
        $image8 = $request->file('gallery_8');
        if(!empty($image8))
        {

            $avatarName8 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_8')->getClientOriginalExtension();

            $request->file('gallery_8')->move('img/property/', $avatarName8);


        }
        $image9 = $request->file('gallery_9');
        if(!empty($image9))
        {

            $avatarName9 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_9')->getClientOriginalExtension();

            $request->file('gallery_9')->move('img/property/', $avatarName9);


        }
        $image10 = $request->file('gallery-10');
        if(!empty($image10))
        {

            $avatarName10 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_10')->getClientOriginalExtension();

            $request->file('gallery_10')->move('img/property/', $avatarName10);

            

        }
        $dataproperty->property_gallery = $avatarName1.";".$avatarName2.";".$avatarName3.";".$avatarName4.";".$avatarName5.";".$avatarName6.";".$avatarName7.";".$avatarName8.";".$avatarName9.";".$avatarName10;


         $tglshgb = $request->tglshgb;
        if($tglshgb == NULL) {
            $tglshgb = "";
        }

        $kepemilikanlainnya = $request->kepemilikanlainnya;
        if($kepemilikanlainnya == NULL) {
            $kepemilikanlainnya = "";
        }

        $detailurniture = $request->detailfurniture;
        if($detailurniture == NULL) {
            $detailurniture = "";
        }
        
        $ketruangan = $request->ketruangan;
        if($ketruangan == NULL) {
            $ketruangan = "";
        }
        
        $ruanglain = $request->ruangtamu.";".$request->ruangkeluarga.";".$request->musholla.";".$request->gudang.";".$request->dapurbasah.";".$request->pantry.";".$request->garasi.";".$request->carport.";".$request->halamandepan.";".$request->halamanbelakang.";".$request->kolamrenang.";".$request->kmtidurpembantu.";".$request->kmmandipembantu;

        $fasilitasumum = $request->listrik."-".$request->dayalistrik.";".$request->internet.";".$request->telepon."-".$request->jumlahtelepon.";".$request->tv.";".$request->pdam.";".$request->sumur.";".$request->olah.";".$request->ac."-".$request->jumlahac.";".$request->heater.";".$request->furnitur;
        $ltanah = 0;
        if ($request->luastanah==''){
            $ltanah = 0;
        } else {
            $ltanah = $request->luastanah;
        }
        $ktidur = 0;
        if ($request->kmtidur==''){
            $ktidur = 0;
        } else {
            $ktidur = $request->kmtidur;
        }

        $dataproperty->property_luas_tanah = $ltanah;
        $dataproperty->property_luas_bangunan = $request->luasbangunan;
        $dataproperty->property_dimensi_luas_tanah = $request->dimensitanah;
        $dataproperty->property_dimensi_luas_bangunan = $request->dimensibangunan;
        $dataproperty->property_tingkat = $request->tingkat;
        $dataproperty->property_arah_hadap = $request->arahhadap.";".$request->arahhadaplain;
        $dataproperty->property_kamar_tidur = $ktidur;
        $dataproperty->property_kamar_mandi = $request->kmmandi.";".$request->kmmandidalam;
        $dataproperty->property_keterangan_ruangan = $request->ketruangan;
        $dataproperty->property_ruang_lain = $ruanglain;
        $dataproperty->property_fasilitas_umum = $fasilitasumum;
        $dataproperty->property_detail_furnitur = $request->detailfurniture;
        $dataproperty->property_status_listing = $request->listing;
        $dataproperty->property_status_kepemilikan = $request->kepemilikan;
        $dataproperty->property_tgl_shgb = $tglshgb;
        $dataproperty->property_status_lainnya = $kepemilikanlainnya;
        $dataproperty->property_imb = $request->imb;
        $dataproperty->property_pbb = $request->pbb;
        $dataproperty->property_jaminan_bank = $request->bank;
        $dataproperty->property_view = 0;
        $dataproperty->property_map = $request->map;
        $dataproperty->property_kantor = $request->kantor;
        $dataproperty->property_keterangan_image = $ketimage;
        $dataproperty->property_publish = $request->publish;
        


        $dataproperty->save();

        $ida = $request->idadmin;
        return redirect('property?status='.$ida)->with('alert-success','Data Hasbeen Saved!');


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
        $tampilkabupaten =  Kabupaten::all();

        $user = DB::table('users')
            ->where('id', $_GET['status'])
            ->get();
        foreach ($user as $user) {
            $a = $user->role;
            $b = $user->status;
        }
        if ($a=='superuser') {
            $tampilowner =  Owner::all();
            $tampilagen =  Agen::all();
        } else {
            $tampilowner = DB::table('owner')
            ->leftjoin('owner_meta', 'owner.id', '=', 'owner_id')
            ->where('status', $b)
            ->get();

            
            $tampilagen = DB::table('agen')
                ->where('agen_keterangan', $b)
                ->get();
        }

        $tampiljenis = DB::table('jenis_property')
            ->get();
        $tampilarah = DB::table('arah_hadap')
            ->get();
        $tampilarahlain = DB::table('arah_hadap')
            ->get();
        $owners = DB::table('owner')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        $tampilproperty = DB::table('property')
            ->leftjoin('agen', 'property_agen', '=', 'agen.agen_id')
            ->leftjoin('owner', 'property_owner', '=', 'owner.id')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->where('property_id', $id)
            ->first();


        $tampilkawasan = DB::table('kawasan')
            ->orderBy('nama_kawasan', 'ASC')
            ->get();

        return view('adminlte::editproperty',['tampilproperty' => $tampilproperty])
            ->with('tampilowner', $tampilowner)
            ->with('tampilagen2', $tampilagen)
            ->with('tampilagen', $tampilagen)
            ->with('tampiljenis', $tampiljenis)
            ->with('owners', $owners)
            ->with('tampilarah', $tampilarah)
            ->with('tampilarahlain', $tampilarahlain)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
        
        //$tampiledit = Property::where('property_id', $id)->first();
        //return view('adminlte::editproperty')->with('tampiledit', $tampiledit);
    }

    public function cek($id)
    {
        //
        $tampilkabupaten =  Kabupaten::all();

        $user = DB::table('users')
            ->where('id', $_GET['status'])
            ->get();
        foreach ($user as $user) {
            $a = $user->role;
            $b = $user->status;
        }
        if ($a=='superuser') {
            $tampilowner =  Owner::all();
            $tampilagen =  Agen::all();
        } else {
            $tampilowner = DB::table('owner')
            ->leftjoin('owner_meta', 'owner.id', '=', 'owner_id')
            ->where('status', $b)
            ->get();

            
            $tampilagen = DB::table('agen')
                ->where('agen_keterangan', $b)
                ->get();
        }

        $tampiljenis = DB::table('jenis_property')
            ->get();
        $tampilarah = DB::table('arah_hadap')
            ->get();
        $tampilarahlain = DB::table('arah_hadap')
            ->get();
        $owners = DB::table('owner')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        $tampilproperty = DB::table('property')
            ->leftjoin('agen', 'property_agen', '=', 'agen.agen_id')
            ->leftjoin('owner', 'property_owner', '=', 'owner.id')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->where('property_id', $id)
            ->first();


        $tampilkawasan = DB::table('kawasan')
            ->orderBy('nama_kawasan', 'ASC')
            ->get();

        return view('adminlte::cekproperty',['tampilproperty' => $tampilproperty])
            ->with('tampilowner', $tampilowner)
            ->with('tampilagen', $tampilagen)
            ->with('tampiljenis', $tampiljenis)
            ->with('owners', $owners)
            ->with('tampilarah', $tampilarah)
            ->with('tampilarahlain', $tampilarahlain)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
        
        //$tampiledit = Property::where('property_id', $id)->first();
        //return view('adminlte::editproperty')->with('tampiledit', $tampiledit);
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
        $idowner = 0;
        $owner = $request->pilihowner;
        if ($owner == "ownerlama") {
            # code...
            $idowner = $request->owner;

        } else {
            # code...

            if ($request->ket!='ada') {
                # code...
                $data = new Owner();
                $data->nama = $request->namaowner;
                $data->alamat = $request->alamatowner;
                $data->no_ktp = $request->noktpowner;
                $data->save();
            }

            $owner = Owner::where('no_ktp', $request->noktpowner)->first();

            $data1 = new Ownermeta();
            $data1->owner_id = $owner->id;
            $data1->status = $request->kantor;
            $data1->value = $request->nohpowner.";".$request->bbmowner.";".$request->emailowner;
            $data1->save();

            $idowner = $owner->id;



        }

        $idlokasi = '';
        $lokasi = $request->tambahlokasi;
        if ($lokasi == "") {
            # code...
            $idlokasi = $request->lokasi;

        } else {
            # code...

            $data = new Kawasan();
            $data->nama_kawasan = $request->lokasibaru;
            
            $data->save();

            $lokasi = DB::table('kawasan')
                ->orderBy('id_kawasan', 'desc')
                ->limit(1)
                ->get();

            foreach ($lokasi as $lokasi)
            {
                $idlokasi = $lokasi->id_kawasan;
            }



        }
        //echo $idowner ;

        if ($request->harga==''){
            $harga = 0;
        } elseif ($request->harga!='') {
            $harga = $request->harga;
        }  else {
            $harga = $request->harga;
        }
        if ($request->hargasewajual==''){
            $hargasewajual = 0;
        } else {
            $hargasewajual = $request->hargasewajual;
        }
        if ($request->hargapermeter==''){
            $hargapermeter = 0;
        } else {
            $hargapermeter = $request->hargapermeter;
        }

        $dataproperty = Property::findOrFail($id);
        $dataproperty->property_status = $request->status;
        $dataproperty->property_jenis = $request->jenisproperty;
        $dataproperty->property_owner = $idowner;
         
        $other_agen = explode(";",$request->other_agen);
        if ($other_agen[1] == 0) {
            $dataproperty->property_agen = $other_agen[0].";".$request->agen;   
        } elseif ($other_agen[1] == 1) {
            # code...
            $dataproperty->property_agen = $request->agen.";".$other_agen[0];
        } else {
            $dataproperty->property_agen = $request->agen;
        
        }
        $dataproperty->property_agen_2 = $request->agen_2;
        
        $dataproperty->property_kabupatenkota = $request->kabupatenkota;
        $dataproperty->property_lokasi = $idlokasi;
        $dataproperty->property_lokasi_detail = $request->detaillokasi;
        $dataproperty->property_kawasan = $request->kawasan;
        $dataproperty->property_harga = $harga;
        $dataproperty->property_harga_sewa = $hargasewajual;
        $dataproperty->property_harga_meter = $hargapermeter;
        $dataproperty->property_tanggal = Carbon::now();
        $dataproperty->property_map = $request->latitude.",".$request->longitude;
        
        $avatarName1 = "";
        $avatarName2 = "";
        $avatarName3 = "";
        $avatarName4 = "";
        $avatarName5 = "";
        $avatarName6 = "";
        $avatarName7 = "";
        $avatarName8 = "";
        $avatarName9 = "";
        $avatarName10 = "";
        
        $image = $request->file('avatar');
        if(!empty($image) || $image!='')
        {

            $avatarName = 'item' . rand(11111,99999) . '.' . 
            $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move('img/property/', $avatarName);
            $dataproperty->property_image = $avatarName;
            $ketimage = 1;

        } elseif($request->check_img_utama=='hapus') {
            $dataproperty->property_image = '';
            $ketimage = 0;
        } else {
            $dataproperty->property_image = $request->img_utama;
            $ketimage = 1;
        }
        $image1 = $request->file('gallery_1');
        if(!empty($image1) || $image1!='')
        {

            $avatarName1 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_1')->getClientOriginalExtension();

            $request->file('gallery_1')->move('img/property/', $avatarName1);


        } elseif ($request->check_img_0=='hapus') {
            $avatarName1 = '';
        } else {
            $avatarName1 = $request->img_1;
        }
        $image2 = $request->file('gallery_2');
        if(!empty($image2) || $image2!='')
        {

            $avatarName2 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_2')->getClientOriginalExtension();

            $request->file('gallery_2')->move('img/property/', $avatarName2);


        } elseif ($request->check_img_1=='hapus') {
            $avatarName2 = '';
        } else {
            $avatarName2 = $request->img_2;
        }
        $image3 = $request->file('gallery_3');
        if(!empty($image3) || $image3!='')
        {

            $avatarName3 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_3')->getClientOriginalExtension();

            $request->file('gallery_3')->move('img/property/', $avatarName3);


        } elseif ($request->check_img_2=='hapus') {
            $avatarName3 = '';
        } else {
            $avatarName3 = $request->img_3;
        }
        $image4 = $request->file('gallery_4');
        if(!empty($image4) || $image4!='')
        {

            $avatarName4 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_4')->getClientOriginalExtension();

            $request->file('gallery_4')->move('img/property/', $avatarName4);


        } elseif ($request->check_img_3=='hapus') {
            $avatarName4 = '';

        } else {
            $avatarName4 = $request->img_4;
        }
        $image5 = $request->file('gallery_5');
        if(!empty($image5) || $image5!='')
        {

            $avatarName5 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_5')->getClientOriginalExtension();

            $request->file('gallery_5')->move('img/property/', $avatarName5);


        } elseif ($request->check_img_4=='hapus') {
            $avatarName5 = '';
        } else {
            $avatarName5 = $request->img_5;
        }
        $image6 = $request->file('gallery_6');
        if(!empty($image6) || $image6!='')
        {

            $avatarName6 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_6')->getClientOriginalExtension();

            $request->file('gallery_6')->move('img/property/', $avatarName6);


        } elseif ($request->check_img_5=='hapus') {
            $avatarName6 = '';
        } else {
            $avatarName6 = $request->img_6;
        }
        $image7 = $request->file('gallery_7');
        if(!empty($image7) || $image7!='')
        {

            $avatarName7 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_7')->getClientOriginalExtension();

            $request->file('gallery_7')->move('img/property/', $avatarName7);


        } elseif ($request->check_img_6=='hapus') {
            $avatarName7 = '';
        } else {
            $avatarName7 = $request->img_7;
        }
        $image8 = $request->file('gallery_8');
        if(!empty($image8) || $image8!='')
        {

            $avatarName8 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_8')->getClientOriginalExtension();

            $request->file('gallery_8')->move('img/property/', $avatarName8);


        } elseif ($request->check_img_7=='hapus') {
            $avatarName8 = '';
        } else {
            $avatarName8 = $request->img_8;
        }
        $image9 = $request->file('gallery_9');
        if(!empty($image9) || $image9!='')
        {

            $avatarName9 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_9')->getClientOriginalExtension();

            $request->file('gallery_9')->move('img/property/', $avatarName9);


        } elseif ($request->check_img_8=='hapus') {
            $avatarName9 = '';
        } else {
            $avatarName9 = $request->img_9;
        }
        $image10 = $request->file('gallery_10');
        if(!empty($image10) || $image10!='')
        {

            $avatarName10 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_10')->getClientOriginalExtension();

            $request->file('gallery_10')->move('img/property/', $avatarName10);
            

        } elseif ($request->check_img_9=='hapus') {
            $avatarName10 = '';
        } else {
            $avatarName10 = $request->img_10;
        }
        
        //echo $avatarName.";".$avatarName1.";".$avatarName2.";".$avatarName3.";".$avatarName4.";".$avatarName5.";".$avatarName6.";".$avatarName7.";".$avatarName8.";".$avatarName9.";".$avatarName10;
         
        $dataproperty->property_gallery = $avatarName1.";".$avatarName2.";".$avatarName3.";".$avatarName4.";".$avatarName5.";".$avatarName6.";".$avatarName7.";".$avatarName8.";".$avatarName9.";".$avatarName10;
         $tglshgb = $request->tglshgb;
        
         $tglshgb = $request->tglshgb;
        if($tglshgb == NULL) {
            $tglshgb = "";
        }

        $kepemilikanlainnya = $request->kepemilikanlainnya;
        if($kepemilikanlainnya == NULL) {
            $kepemilikanlainnya = "";
        }

        $detailurniture = $request->detailfurniture;
        if($detailurniture == NULL) {
            $detailurniture = "";
        }
        
        $ketruangan = $request->ketruangan;
        if($ketruangan == NULL) {
            $ketruangan = "";
        }
        
        $ruanglain = $request->ruangtamu.";".$request->ruangkeluarga.";".$request->musholla.";".$request->gudang.";".$request->dapurbasah.";".$request->pantry.";".$request->garasi.";".$request->carport.";".$request->halamandepan.";".$request->halamanbelakang.";".$request->kolamrenang.";".$request->kmtidurpembantu.";".$request->kmmandipembantu;

        $fasilitasumum = $request->listrik."-".$request->dayalistrik.";".$request->internet.";".$request->telepon."-".$request->jumlahtelepon.";".$request->tv.";".$request->pdam.";".$request->sumur.";".$request->olah.";".$request->ac."-".$request->jumlahac.";".$request->heater.";".$request->furnitur;

        if ($request->luastanah==''){
            $ltanah = 0;
        } else {
            $ltanah = $request->luastanah;
        }
        
        $ktidur = 0;
        if ($request->kmtidur==''){
            $ktidur = 0;
        } else {
            $ktidur = $request->kmtidur;
        }
        $dataproperty->property_luas_tanah = $ltanah;
        $dataproperty->property_luas_bangunan = $request->luasbangunan;
        $dataproperty->property_dimensi_luas_tanah = $request->dimensitanah;
        $dataproperty->property_dimensi_luas_bangunan = $request->dimensibangunan;
        $dataproperty->property_tingkat = $request->tingkat;
        $dataproperty->property_arah_hadap = $request->arahhadap.";".$request->arahhadaplain;
        $dataproperty->property_kamar_tidur = $request->kmtidur;
        $dataproperty->property_kamar_mandi = $request->kmmandi.";".$request->kmmandidalam;
        $dataproperty->property_keterangan_ruangan = $request->ketruangan;
        $dataproperty->property_ruang_lain = $ruanglain;
        $dataproperty->property_fasilitas_umum = $fasilitasumum;
        $dataproperty->property_detail_furnitur = $request->detailfurniture;
        $dataproperty->property_status_listing = $request->listing;
        $dataproperty->property_status_kepemilikan = $request->kepemilikan;
        $dataproperty->property_tgl_shgb = $tglshgb;
        $dataproperty->property_status_lainnya = $kepemilikanlainnya;
        $dataproperty->property_imb = $request->imb;
        $dataproperty->property_pbb = $request->pbb;
        $dataproperty->property_jaminan_bank = $request->bank;
        $dataproperty->property_view = 0;
        $dataproperty->property_map = $request->map;
        $dataproperty->property_kantor = $request->kantor;
        $dataproperty->property_keterangan_image = $ketimage;
        $dataproperty->property_publish = $request->publish;
        $dataproperty->update();

        $ida = $request->idadmin;
        return redirect('property?status='.$ida)->with('alert-success','Data Hasbeen Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $property = DB::table('property')
            ->where('property_id', $id)
            ->get();
        foreach ($property as $property) {
            $a = $property->property_kantor;
            $idagen = $property->property_agen;
        }
        if ( $a=="harmony;premiere" || $a=="premiere;harmony" ) {
            # code...
            if ($request->status=="harmony") {
                # code...
                $status = "premiere";
            } else {
                # code...
                $status = "harmony";
            }
            
            $idagen = explode(";",$idagen);
            $size = sizeof($idagen);
            for ($i=0; $i < $size; $i++) { 
                if ($request->idagen!=$idagen[$i]) {
                    $agen = $idagen[$i];
                }
            }
            $dataproperty = Property::findOrFail($id);
            $dataproperty->property_agen = $agen.";";
            $dataproperty->property_kantor = $status;
            $dataproperty->update();

        } else {
            # code...
            $task = Property::findOrFail($id);

            $task->delete();
        }
        
        //
        $ida = $request->idadmin;

        Session::flash('flash_message', 'Property successfully deleted!');
        return redirect('property?status='.$ida);
    }

    public function kabupaten($ids)
    {
        
        $cities = DB::table("regencies")
                    ->where("province_id",$ids)
                    ->pluck("name_regencies","id");
        return json_encode($cities);
    }

    public function Kecamatan($ids)
     {
         $cities = DB::table("districts")
                     ->where("regency_id",$ids)
                     ->pluck("name_districts","id");
         return json_encode($cities);
     }
     public function kelurahan($ids)
      {
          $cities = DB::table("villages")
                      ->where("district_id",$ids)
                      ->pluck("name_villages","id");
          return json_encode($cities);
      }
      public function ceklokasi($id)
    {
        
        $cari = explode(";",$id);
        $tampil = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->leftjoin('owner', 'property_owner', '=', 'owner.id')
            ->leftjoin('agen', 'property_agen', '=', 'agen_id')
            ->where([
                ['property_lokasi', 'LIKE','%'. $cari[0].'%'],
                ['property_lokasi_detail', 'LIKE','%'. $cari[1].'%'],
                ['property_kabupatenkota', 'LIKE','%'. $cari[2].'%'],
            ])
            ->get();
          //->pluck("property_id","property_status","property_jenis");
      return json_encode($tampil);
    }

    public function tambahproperty(Request $request, $id)
    {
        echo "string";
    }
   
}
