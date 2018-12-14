<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Owner;
use App\Agen;
use App\Laravel;
use App\Kawasan;
use App\Kabupaten;
use App\Provinsi;
use App\Property;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('adminlte::home');
    }

    public function tes()
    {
        //show data
        $laravel =  Laravel::all();
        return view('adminlte::tes',['laravel' => $laravel]);
    }

    public function addtes()
    {
        return view('adminlte::addtes');
    }

    public function edittes()
    {
        return view('adminlte::edittes');
    }

    public function addproperty()
    {
        $tampilkabupaten =  Kabupaten::all();
        $idowner=0;
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

        $tampilkawasan = DB::table('kawasan')
            ->orderBy('nama_kawasan', 'ASC')
            ->get();

        return view('adminlte::addproperty')
            ->with('tampilowner', $tampilowner)
            ->with('tampilagen', $tampilagen)
            ->with('tampilagen2', $tampilagen)
            ->with('tampilarah', $tampilarah)
            ->with('tampilarahlain', $tampilarahlain)
            ->with('owners', $owners)
            ->with('tampilkawasan', $tampilkawasan)
            ->with('tampilkabupaten', $tampilkabupaten)
            ->with('tampiljenis', $tampiljenis);
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {

         // validation
          $this->validate($request,[
          'nama'=> 'required',
          'email' => 'required',
        ]);

        $test = new laravel();
        $test->nama = $request->nama;
        $test->email = $request->email;
        $test->save();
        return redirect('tes')->with('message','data update!'); 

        //return redirect()->route('adminlte::tes');
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //create new data
        return view('adminlte::tes');
    }
    public function show($id)
    {
    //
    }

    public function edit($id)
    {
        $blog = Laravel::findOrFail($id);
        // return to the edit views
        return view('edittes',compact('laravel'));
    }

    public function update(Request $request, $id)
    {
        // validation
        $this->validate($request,[
          'nama'=> 'required',
          'email' => 'required',
      ]);

        $blog = Laravel::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->update();

        return redirect('tes')->with('alert-success','Data Hasbeen Saved!');
    }

     public function destroy($id)
    {
        // delete data
        $laravel = Laravel::findOrFail($id);
        $laravel->delete();
        return redirect('tes')->with('alert-success','Data Hasbeen Saved!');
    }


    public function kabupaten($id)
    {
        
        $cities = DB::table("regencies")
                    ->where("province_id",$id)
                    ->pluck("name_regencies","id");
        return json_encode($cities);
        
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
   
}