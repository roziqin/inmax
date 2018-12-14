<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Owner;
use App\Agen;
use App\Laravel;
use App\Provinsi;
use App\Property;
use Carbon\Carbon;
use DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
            
        $tgl = Carbon::now();
            //echo Carbon::now()->startOfMonth()->addMonths(-1)->toDateString()."<br>";
            //echo Carbon::now()->endOfMonth()->toDateString();
        $tampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
            ->whereBetween('property_tanggal', array(Carbon::now()->startOfMonth()->addMonths(-1)->toDateString(), Carbon::now()->endOfMonth()->toDateString()))
             ->where([
                ['property_image', '<>',''],
                ['property_publish', '=','1']
                ])
            ->orderBy('property_view', 'DESC')
            ->limit(6)
            ->get();
            
        $tampilpropertybulan = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
            ->whereBetween('property_tanggal', array(Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()))
             ->where([
                ['property_image', '<>',''],
                ['property_publish', '=','1']
                ])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $tampiljenis = DB::table('jenis_property')
            ->get();
            //echo $tgl->startOfMonth()->toDateString();
            //echo $tgl->endOfMonth()->toDateString();
        //return view('adminlte::welcome',['tampilproperty' => $tampilproperty]);
        return view('welcome')
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampilproperty', $tampilproperty)
            ->with('tampilpropertybulan', $tampilpropertybulan)
            ->with('tampiljenis', $tampiljenis);
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
    public function detail($id)
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        $jml = 0;
        $cat = 0;

        $tampilagen =  Agen::all();
        $props = DB::table('property')
            ->where('property_id', $id)
            ->get();

        foreach ($props as $prop)
        {
            $jml = $prop->property_view+1;
            $cat = $prop->property_jenis;
            $stat = $prop->property_status;
        }
        $dataproperty = DB::table('property')
            ->where('property_id', $id)
            ->update(['property_view' => $jml]);

        $tampilproperty = DB::table('property')
            ->leftjoin('owner', 'property_owner', '=', 'owner.id')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
            ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where('property_id', $id)
            ->get();

        $relatedproperty = DB::table('property')
            ->leftjoin('owner', 'property_owner', '=', 'owner.id')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
            ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
            ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                    ['property_jenis', '=', $cat],
                    ['property_status', 'LIKE', '%'.$stat.'%'],
                    ['property_id', '<>', $id],
                    ['property_image', '<>', ''],
                ])
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('detail')
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen_2', $tampilagen)
            ->with('tampilproperty', $tampilproperty)
            ->with('relatedproperty', $relatedproperty);
        //return view('detail');
    }

    public function tentangkami()
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        return view('tentangkami')
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampiljenisproperty', $tampiljenisproperty);
    }

   public function referral() 
   {
       $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        return view('referral')
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampiljenisproperty', $tampiljenisproperty);
   }

   public function simulasikpr() 
   {
       $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        return view('simulasikpr')
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampiljenisproperty', $tampiljenisproperty);
   }

   public function joinus() 
   {
       $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        return view('joinus')
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampiljenisproperty', $tampiljenisproperty);
   }

}
