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

class TambahpropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if ($request->harga==''&&$request->hargasewa==''){
            $harga = 0;
        } elseif ($request->hargasewa!='') {
            $harga = $request->hargasewa;
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
        $dataproperty->property_jenis = $request->jenispropperty;
        $dataproperty->property_owner = $idowner;
        $dataproperty->property_agen = $request->agenlama.";".$request->agen;
        $dataproperty->property_kabupatenkota = $request->kabupatenkota;
        $dataproperty->property_lokasi = $request->lokasi;
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
        $avatarName5 = "";;
        $avatarName6 = "";;
        $avatarName7 = "";;
        $avatarName8 = "";;
        $avatarName9 = "";;
        $avatarName10 = "";
        $image = $request->file('avatar');
        if(!empty($image))
        {

            $avatarName = 'item' . rand(11111,99999) . '.' . 
            $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move('img/property/', $avatarName);
            $dataproperty->property_image = $avatarName;

        } else {
            $dataproperty->property_image = $request->img_utama;
        }

        $image1 = $request->file('gallery_1');
        if(!empty($image1))
        {

            $avatarName1 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_1')->getClientOriginalExtension();

            $request->file('gallery_1')->move('img/property/', $avatarName1);


        } else {
            $avatarName1 = $request->img_1;
        }
        $image2 = $request->file('gallery_2');
        if(!empty($image2))
        {

            $avatarName2 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_2')->getClientOriginalExtension();

            $request->file('gallery_2')->move('img/property/', $avatarName2);


        } else {
            $avatarName2 = $request->img_2;
        }
        $image3 = $request->file('gallery_3');
        if(!empty($image3))
        {

            $avatarName3 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_3')->getClientOriginalExtension();

            $request->file('gallery_3')->move('img/property/', $avatarName3);


        } else {
            $avatarName3 = $request->img_3;
        }
        $image4 = $request->file('gallery_4');
        if(!empty($image4))
        {

            $avatarName4 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_4')->getClientOriginalExtension();

            $request->file('gallery_4')->move('img/property/', $avatarName4);


        } else {
            $avatarName4 = $request->img_4;
        }
        $image5 = $request->file('gallery_5');
        if(!empty($image5))
        {

            $avatarName5 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_5')->getClientOriginalExtension();

            $request->file('gallery_5')->move('img/property/', $avatarName5);


        } else {
            $avatarName5 = $request->img_5;
        }
        $image6 = $request->file('gallery_6');
        if(!empty($image6))
        {

            $avatarName6 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_6')->getClientOriginalExtension();

            $request->file('gallery_6')->move('img/property/', $avatarName6);


        } else {
            $avatarName6 = $request->img_6;
        }
        $image7 = $request->file('gallery_7');
        if(!empty($image7))
        {

            $avatarName7 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_7')->getClientOriginalExtension();

            $request->file('gallery_7')->move('img/property/', $avatarName7);


        } else {
            $avatarName7 = $request->img_7;
        }
        $image8 = $request->file('gallery_8');
        if(!empty($image8))
        {

            $avatarName8 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_8')->getClientOriginalExtension();

            $request->file('gallery_8')->move('img/property/', $avatarName8);


        } else {
            $avatarName8 = $request->img_8;
        }
        $image9 = $request->file('gallery_9');
        if(!empty($image9))
        {

            $avatarName9 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_9')->getClientOriginalExtension();

            $request->file('gallery_9')->move('img/property/', $avatarName9);


        } else {
            $avatarName9 = $request->img_9;
        }
        $image10 = $request->file('gallery_10');
        if(!empty($image10))
        {

            $avatarName10 = 'item' . rand(11111,99999) . '.' . 
            $request->file('gallery_10')->getClientOriginalExtension();

            $request->file('gallery_10')->move('img/property/', $avatarName10);
            

        } else {
            $avatarName10 = $request->img_10;
        }


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
        $dataproperty->property_kantor = $request->kantorlama.";".$request->kantor;

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
    public function destroy($id)
    {
        //
    }
}
