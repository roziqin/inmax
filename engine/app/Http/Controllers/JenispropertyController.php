<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Jenisproperty;
use Image;
use Carbon\Carbon;
use DB;

class JenispropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampiljenis =  Jenisproperty::all();
        return view('adminlte::jenisproperty',['tampiljenis' => $tampiljenis]);
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
        $data = new Jenisproperty();
        $data->nama_jenis = $request->name;
        $data->slug = $request->slug;
        
        $data->save();
        return redirect('jenisproperty');
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
        $tampiledit = Jenisproperty::where('id', $id)->first();

        return view('adminlte::editjenis')
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
        $dataupdate = Jenisproperty::findOrFail($id);
        $dataupdate->nama_jenis = $request->name;
        $dataupdate->slug = $request->slug;
        $dataupdate->update();

        return redirect('jenisproperty')->with('alert-success','Data Hasbeen Saved!');
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
        $task = Jenisproperty::findOrFail($id);

        $task->delete();

        
        return redirect('jenisproperty')->with('alert-success','Data Hasbeen Saved!');
    }
}
