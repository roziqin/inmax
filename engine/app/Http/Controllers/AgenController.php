<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Agen;
use Image;
use Carbon\Carbon;
use DB;

class AgenController extends Controller
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
            # code...
            $tampilagen =  Agen::all();
        } else {
        $tampilagen = DB::table('agen')
            ->where('agen_keterangan', $b)
            ->get();
        }

        //$tampilagen =  Agen::all();
        return view('adminlte::agen',['tampilagen' => $tampilagen]);
        
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
        $data = new agen();
        $data->agen_nama = $request->name;
        $data->agen_hp = $request->hp;
        $data->agen_email = $request->email;
        $data->agen_bbm = $request->bbm;
        $data->agen_anggota = Carbon::now('Asia/jakarta');
        $data->agen_keterangan = $request->status;
        $data->agen_avatar = '';
        
        $image = $request->file('avatar');
        if(!empty($image))
        {

            $avatarName = 'item' . rand(11111,99999) . '.' . 
            $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move('img/avatar/', $avatarName
            );
            $data->agen_avatar = $avatarName;
        }
        
        $data->agen_alamat = $request->alamat;
        $data->save();
        $ida = $request->idadmin;
        return redirect('agen?status='.$ida);
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
        $tampiledit = Agen::where('agen_id', $id)->first();
        return view('adminlte::editagen')->with('tampiledit', $tampiledit);
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
        $dataupdate = Agen::findOrFail($id);
        $dataupdate->agen_nama = $request->name;
        $dataupdate->agen_alamat = $request->alamat;
        $dataupdate->agen_email = $request->email;
        $dataupdate->agen_hp = $request->hp;
        $dataupdate->agen_bbm = $request->bbm;
        $image = $request->file('avatar');
        if(!empty($image))
        {
            echo "string";
            $avatarName = 'item' . rand(11111,99999) . '.' . 
            $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move('img/avatar/', $avatarName);
            $dataupdate->agen_avatar = $avatarName;
        }
        $dataupdate->update();

        $ida = $request->idadmin;
        return redirect('agen?status='.$ida)->with('alert-success','Data Hasbeen Saved!');
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
        $task = Agen::findOrFail($id);

        $task->delete();

        $ida = $request->idadmin;
        
        return redirect('agen?status='.$ida);
    }

    public function addagen()
    {
        return view('adminlte::addagen');
    }
}
