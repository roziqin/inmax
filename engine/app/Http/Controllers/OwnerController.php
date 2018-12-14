<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Owner;
use App\Ownermeta;
use Image;
use Carbon\Carbon;
use DB;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = DB::table('users')
            ->where('id', $_GET['status'])
            ->get();
        foreach ($user as $user) {
            $a = $user->role;
            $b = $user->status;
        }
        if ($a=='superuser') {
            $tampilowner =  Owner::all();
        } else {
            $tampilowner = DB::table('owner')
            ->leftjoin('owner_meta', 'owner.id', '=', 'owner_id')
            ->where('status', $b)
            ->get();
        }
        
        return view('adminlte::owner',['tampilowner' => $tampilowner]);
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
        ////
        if ($request->ket!='ada') {
            # code...
            $data = new Owner();
            $data->nama = $request->name;
            $data->alamat = $request->alamat;
            $data->no_ktp = $request->ktp;
            $data->save();
        }

        $owner = Owner::where('no_ktp', $request->ktp)->first();

        $data1 = new Ownermeta();
        $data1->owner_id = $owner->id;
        $data1->status = $request->status;
        $data1->value = $request->hp.";".$request->bbm.";".$request->email;
        
        $data1->save();

        $ida = $request->idadmin;
        return redirect('owner?status='.$ida);

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
        $ownerproperty = DB::table('property')
            ->where('property_owner', $id)
            ->get();

        $user = DB::table('users')
            ->where('id', $_GET['status'])
            ->get();
        foreach ($user as $user) {
            $a = $user->role;
            $b = $user->status;
        }
        if ($a=='superuser') {
            $tampiledit = Owner::where('id', $id)->first();
        } else {
            $tampiledit = DB::table('owner')
            ->leftjoin('owner_meta', 'owner.id', '=', 'owner_id')
            ->where('id', $id)
            ->first();

            if ($tampiledit->status!=''){
                $tampiledit = DB::table('owner')
                ->leftjoin('owner_meta', 'owner.id', '=', 'owner_id')
                ->where([
                    ['id', '=', $id],
                    ['status', '=', $b],
                ])
                ->first();
            }
            
        }

        return view('adminlte::editowner')
            ->with('ownerproperty', $ownerproperty)
            ->with('tampiledit', $tampiledit);
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
        
        $dataupdate = Owner::findOrFail($id);
        $dataupdate->nama = $request->name;
        $dataupdate->alamat = $request->alamat;
        $dataupdate->no_ktp = $request->ktp;
        $dataupdate->update();

        if ($request->ket=='update') {
            # code...
            $dataupdate1 = Ownermeta::findOrFail($request->idmeta);
            $dataupdate1->value = $request->hp.";".$request->bbm.";".$request->email;

            $dataupdate1->update();
        } else {
            $data1 = new Ownermeta();
            $data1->owner_id = $request->idmeta;
            $data1->status = $request->status;
            $data1->value = $request->hp.";".$request->bbm.";".$request->email;
            $data1->save();
        }
        $ida = $request->idadmin;
        return redirect('owner?status='.$ida)->with('alert-success','Data Hasbeen Saved!');
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
        $task = Ownermeta::findOrFail($id);
        $task->delete();

        $ida = $request->idadmin;
        
        return redirect('owner?status='.$ida);
    }

    public function addowner()
    {
        return view('adminlte::addowner');
    }

    public function cekktp($id)
    {
        
        $owner = DB::table("owner")
                    ->where("no_ktp",$id)
                    ->pluck("alamat","nama");
        return json_encode($owner);
    }
}
