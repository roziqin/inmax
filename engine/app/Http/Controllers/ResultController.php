<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agen;
use App\Property;
use App\Kawasan;
use App\Kabupaten;
use DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampilprovinsi =  Provinsi::all();

        return view('result')
            ->with('tampilprovinsi', $tampilprovinsi);
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

    public function jenis_property($name)
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        $tampilkabupaten =  Kabupaten::all();
        $tampilagen =  Agen::all();
        $tampilkawasan = DB::table('property')
            ->groupBy('property_kawasan')
            ->get();
        $tampiljenis = DB::table('jenis_property')
            ->where('slug', $name)
            ->get();
        $tampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where('property_publish', '=','1')
            ->paginate(7);

        $counttampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where('property_publish', '=','1')
            ->get();

        //return view('adminlte::welcome',['tampilproperty' => $tampilproperty]);
        return view('jenisproperty')
            ->with('tampilproperty', $tampilproperty)
            ->with('counttampilproperty', $counttampilproperty)
            ->with('tampiljenis', $tampiljenis)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen2', $tampilagen)
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
    }
    public function jenis_property_ket($ket,$name)
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        $tampilkabupaten =  Kabupaten::all();
        $tampilkawasan = DB::table('property')
            ->groupBy('property_kawasan')
            ->get();
        $tampiljenis = DB::table('jenis_property')
            ->where('slug', $name)
            ->get();

         $tampiljenisall = DB::table('jenis_property')
            ->get();
        $tampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                ['slug', '=', $name],
                ['property_status', 'LIKE', '%'.$ket.'%'],
                ['property_publish', '=','1']
            ])
            ->orderBy('property_keterangan_image','desc')
            ->orderBy('property_id')
            ->paginate(7);

        $counttampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                ['slug', '=', $name],
                ['property_status', 'LIKE', '%'.$ket.'%'],
                ['property_publish', '=','1']
            ])
            ->get();

        $tampilpropertylain = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                ['slug', '=', $name],
                ['property_status', 'LIKE', '%'.$ket.'%'],
                ['property_publish', '=','1']
            ])
            ->get();
        
        $tampilagen =  Agen::all();
        //return view('adminlte::welcome',['tampilproperty' => $tampilproperty]);
        return view('jenisproperty')
            ->with('tampilproperty', $tampilproperty)
            ->with('counttampilproperty', $counttampilproperty)
            ->with('tampiljenisall', $tampiljenisall)
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampiljenis', $tampiljenis)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen2', $tampilagen)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
        
    }

    public function jenis_property_ket_lain($ket,$name,$sort)
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        $tampilkabupaten =  Kabupaten::all();
        $tampilkawasan = DB::table('kawasan')
            ->orderBy('nama_kawasan', 'ASC')
            ->get();
        $tampiljenis = DB::table('jenis_property')
            ->where('slug', $name)
            ->get();
        $tampiljenisall = DB::table('jenis_property')
            ->get();
        $tampilagen =  Agen::all();
        $counttampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_tanggal', 'DESC')
                ->get();
        if ($sort=='terbaru') {
            $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_tanggal', 'DESC')
                ->paginate(7);
        } elseif ($sort=='populer') {
            $tampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                ['slug', '=', $name],
                ['property_status', 'LIKE', '%'.$ket.'%'],
                ['property_publish', '=','1']
            ])
            ->orderBy('property_keterangan_image', 'DESC')
            ->orderBy('property_view', 'DESC')
            ->paginate(7);
        } elseif ($sort=='hargarendah') {
            if ($ket=='dijual') {
                # code...
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
            ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga', 'ASC')
                ->paginate(7);
            } elseif ($ket=='disewa') {
                # code...
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga_sewa', 'ASC')
                ->paginate(7);
            } else {
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga', 'ASC')
                ->paginate(7);
            }
            
        } elseif ($sort=='hargatinggi') {
            if ($ket=='dijual') {
                # code...
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga', 'DESC')
                ->paginate(7);
            } elseif ($ket=='disewa') {
                # code...
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga_sewa', 'DESC')
                ->paginate(7);
            } else {
                $tampilproperty = DB::table('property')
                ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                ->where([
                    ['slug', '=', $name],
                    ['property_status', 'LIKE', '%'.$ket.'%'],
                    ['property_publish', '=','1']
                ])
                ->orderBy('property_keterangan_image', 'DESC')
                ->orderBy('property_harga', 'DESC')
                ->paginate(7);
            }
        } else {
            $tampilproperty = DB::table('property')
            ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
            ->where([
                ['slug', '=', $name],
                ['property_status', 'LIKE', '%'.$ket.'%'],
                ['property_publish', '=','1']
            ])
            ->orderBy('property_keterangan_image', 'DESC')
            ->paginate(7);
        }
        
        

        //return view('adminlte::welcome',['tampilproperty' => $tampilproperty]);
        return view('jenisproperty')
            ->with('tampilproperty', $tampilproperty)
            ->with('counttampilproperty', $counttampilproperty)
            ->with('tampiljenisall', $tampiljenisall)
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen2', $tampilagen)
            ->with('tampiljenis', $tampiljenis)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
    }

    public function kabupaten($id)
    {
     
        //$url = Request::segments(2);   
        $cities = DB::table("regencies")
                    ->where("province_id",$id)
                    ->pluck("name_regencies","id");
        return json_encode($cities);

        // return $url;
        
        //$blog = kabupaten::findOrFail($id);
        //return Response::json($blog);
        //return view('edittes',compact('laravel'));
    }

    public function Kecamatan($id)
     {
         $cities = DB::table("districts")
                     ->where("regency_id",$id)
                     ->pluck("name_districts","id");
         return json_encode($cities);
     }
     public function kelurahan($id)
      {

          $cities = DB::table("villages")
                      ->where("district_id",$id)
                      ->pluck("name_villages","id");
          return json_encode($cities);

      }

    public function search(Request $request)
    {
        $tampiljenisproperty = DB::table('jenis_property')
            ->orderBy('id', 'ASC')
            ->get();
            
        $tampilkabupaten =  Kabupaten::all();
        $tampilkawasan = DB::table('kawasan')
            ->orderBy('nama_kawasan', 'ASC')
            ->get();
        $tampiljenisall = DB::table('jenis_property')
            ->get();

        $tampiljenis = DB::table('jenis_property')
            ->where('id', $request->get('jenispropperty'))
            ->get();

        $tampilagen =  Agen::all();
        if ($request->get('harga-min')==0) {
            # code...
            $hargamin = 0;
        } else {
            $hargamin = str_replace('.', '', $request->get('harga-min'));
        }
        $hargamax = str_replace('.', '', $request->get('harga-max'));
        $view = $request->get('view');

        if ($request->get('filter')=='normal') {
            # code...
            
            if ($request->get('ket')=='harga') {
                 $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere('property_kawasan', 'LIKE','%'. $request->get('alamat').'%')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                    ->get();
                # code...
                if ($request->get('status')=='disewa') {
                    # code...
                    if ($view=='terbaru') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_tanggal', 'DESC')
                        ->paginate(7);
                    } elseif($view=='populer') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_view', 'DESC')
                        ->paginate(7);
                    } elseif($view=='hargarendah') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'ASC')
                        ->paginate(7);
                    } elseif($view=='hargatinggi') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'DESC')
                        ->paginate(7);

                    } else {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga_sewa', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->paginate(7);
                    }

                } elseif ($request->get('status')=='dijual') {
                    if ($view=='terbaru') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_tanggal', 'DESC')
                        ->paginate(7);
                    } elseif($view=='populer') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_view', 'DESC')
                        ->paginate(7);
                    } elseif($view=='hargarendah') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'ASC')
                        ->paginate(7);
                    } elseif($view=='hargatinggi') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'DESC')
                        ->paginate(7);

                    } else {
                        # code...

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->paginate(7);
                    }
                } else {
                    if ($view=='terbaru') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kabupaten', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_lokasi_detail', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->where('property_publish', '=','1')
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_tanggal', 'DESC')
                        ->paginate(7);
                    } elseif($view=='populer') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kabupaten', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_lokasi_detail', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->where('property_publish', '=','1')
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_view', 'DESC')
                        ->paginate(7);
                    } elseif($view=='hargarendah') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kabupaten', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_lokasi_detail', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->where('property_publish', '=','1')
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'ASC')
                        ->paginate(7);
                    } elseif($view=='hargatinggi') {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kabupaten', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_lokasi_detail', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->where('property_publish', '=','1')
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->orderBy('property_harga', 'DESC')
                        ->paginate(7);

                    } else {
                        # code...
                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kabupaten', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->orWhere([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_lokasi_detail', 'LIKE','%'. $request->get('alamat').'%'],
                        ])
                        ->where('property_publish', '=','1')
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image', 'DESC')
                        ->paginate(7);
                    }
                }

            } else {
                # code...
                $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->orWhere('property_kawasan', 'LIKE','%'. $request->get('alamat').'%')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                    ->get();
                if ($view=='terbaru') {
                    # code...
                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                ->orderBy('property_keterangan_image', 'DESC')
                    ->orderBy('property_tanggal', 'DESC')
                    ->paginate(7);
                } elseif($view=='populer') {
                    # code...
                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                ->orderBy('property_keterangan_image', 'DESC')
                    ->orderBy('property_view', 'DESC')
                    ->paginate(7);
                } elseif($view=='hargarendah') {
                    # code...
                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                ->orderBy('property_keterangan_image', 'DESC')
                    ->orderBy('property_harga', 'ASC')
                    ->paginate(7);
                } elseif($view=='hargatinggi') {
                    # code...
                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                ->orderBy('property_keterangan_image', 'DESC')
                    ->orderBy('property_harga', 'DESC')
                    ->paginate(7);
                } else {
                    # code...
                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['nama_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_publish', '=','1']
                        ])
                ->orderBy('property_keterangan_image', 'DESC')
                    ->paginate(7);
                }

            }
        } else {
            
            if ($view=='terbaru') {
                # code...
                if ($request->get('kabupaten')!='0') {
                    # code...
                    if ($request->get('lokasi')!='0') {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_tanggal', 'DESC')
                        ->paginate(7);
                    } else {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_tanggal', 'DESC')
                        ->paginate(7);

                    }
                    
                } else {
                    $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->get();

                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->orderBy('property_keterangan_image')
                    ->orderBy('property_tanggal', 'DESC')
                    ->paginate(7);
                }
                
            } elseif($view=='populer') {
                # code...
                if ($request->get('kabupaten')!='0') {
                    # code...
                    if ($request->get('lokasi')!='0') {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_view', 'DESC')
                        ->paginate(7);
                    } else {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_view', 'DESC')
                        ->paginate(7);

                    }
                    
                } else {
                    $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->get();

                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->orderBy('property_keterangan_image')
                    ->orderBy('property_view', 'DESC')
                    ->paginate(7);
                }
                
            } elseif($view=='hargarendah') {
                # code...
                if ($request->get('kabupaten')!='0') {
                    # code...
                    if ($request->get('lokasi')!='0') {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_harga', 'ASC')
                        ->paginate(7);
                    } else {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_harga', 'ASC')
                        ->paginate(7);

                    }
                    
                } else {
                    $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->get();

                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->orderBy('property_keterangan_image')
                    ->orderBy('property_harga', 'ASC')
                    ->paginate(7);
                }

            } elseif($view=='hargatinggi') {
                # code...
                if ($request->get('kabupaten')!='0') {
                    # code...
                    if ($request->get('lokasi')!='0') {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_harga', 'DESC')
                        ->paginate(7);
                    } else {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->orderBy('property_keterangan_image')
                        ->orderBy('property_harga', 'DESC')
                        ->paginate(7);

                    }
                    
                } else {
                    $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->get();

                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->orderBy('property_keterangan_image')
                    ->orderBy('property_harga', 'DESC')
                    ->paginate(7);
                }
                

            } else {
                # code...
                if ($request->get('kabupaten')!='0') {
                    # code...
                    if ($request->get('lokasi')!='0') {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_lokasi', '=', $request->get('lokasi')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image')
                        ->paginate(7);
                    } else {
                        # code...
                        $counttampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                        ->get();

                        $tampilproperty = DB::table('property')
                        ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                        ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                        ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                        ->where([
                            ['property_kabupatenkota', '=', $request->get('kabupaten')],
                            ['property_status', 'LIKE','%'. $request->get('status').'%'],
                            ['jenis_property.id', '=', $request->get('jenispropperty')],
                            ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                            ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                            ['property_publish', '=','1']
                        ])
                        ->whereBetween('property_harga', array($hargamin, $hargamax))
                ->orderBy('property_keterangan_image')
                        ->paginate(7);

                    }
                    
                } else {
                    $counttampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
                    ->get();

                    $tampilproperty = DB::table('property')
                    ->leftjoin('jenis_property', 'property_jenis', '=', 'jenis_property.id')
                    ->leftjoin('kawasan', 'property_lokasi', '=', 'id_kawasan')
                    ->leftjoin('kabupaten', 'property_kabupatenkota', '=', 'id_kabupaten')
                    ->where([
                        ['property_status', 'LIKE','%'. $request->get('status').'%'],
                        ['jenis_property.id', '=', $request->get('jenispropperty')],
                        ['property_kawasan', 'LIKE','%'. $request->get('alamat').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangtamu').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('ruangkeluarga').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('musholla').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('gudang').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('dapurbasah').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('pantry').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('garasi').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('carport').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamandepan').'%'],
                        ['property_ruang_lain', 'LIKE','%'. $request->get('halamanbelakang').'%'],
                        ['property_publish', '=','1']
                    ])
                    ->whereBetween('property_harga', array($hargamin, $hargamax))
            ->orderBy('property_keterangan_image')
                    ->paginate(7);
                }

            }
        }
        
        

        return view('result', compact('tampilproperty'))
            ->with('tampiljenisall', $tampiljenisall)
            ->with('counttampilproperty', $counttampilproperty)
            ->with('tampiljenisproperty', $tampiljenisproperty)
            ->with('tampiljenispropertys', $tampiljenisproperty)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen2', $tampilagen)
            ->with('tampiljenis', $tampiljenis)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten);
        

    }

}
