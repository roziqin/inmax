<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Kawasan;
use Image;
use Carbon\Carbon;
use DB;

class KawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampilkawasan =  Kawasan::all();
        return view('adminlte::kawasan',['tampilkawasan' => $tampilkawasan]);
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
        $data = new Kawasan();
        $data->nama_kawasan = $request->name;
        
        $data->save();
        return redirect('kawasan');
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
        $tampilkawasan = Kawasan::where('id_kawasan', $id)->first();

        return view('adminlte::editkawasan')
            ->with('tampilkawasan', $tampilkawasan);
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
        $dataupdate = Kawasan::findOrFail($id);
        $dataupdate->nama_kawasan = $request->name;
        $dataupdate->update();

        return redirect('kawasan')->with('alert-success','Data Hasbeen Saved!');
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
        $task = Kawasan::findOrFail($id);

        $task->delete();

        
        return redirect('kawasan')->with('alert-success','Data Hasbeen Saved!');
    }
}
