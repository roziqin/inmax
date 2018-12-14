<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Kabupaten;
use Image;
use Carbon\Carbon;
use DB;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampilkabupaten =  Kabupaten::all();
        return view('adminlte::kabupatenkota',['tampilkabupaten' => $tampilkabupaten]);
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
        $data = new Kabupaten();
        $data->nama_kabupaten = $request->name;
        
        $data->save();
        return redirect('kabupatenkota');
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
        $tampilkabupaten = Kabupaten::where('id_kabupaten', $id)->first();

        return view('adminlte::editkabupatenkota')
            ->with('tampilkabupaten', $tampilkabupaten);
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
        $dataupdate = Kabupaten::findOrFail($id);
        $dataupdate->nama_kabupaten = $request->name;
        $dataupdate->update();

        return redirect('kabupatenkota')->with('alert-success','Data Hasbeen Saved!');
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
        $task = Kabupaten::findOrFail($id);

        $task->delete();

        
        return redirect('kabupatenkota')->with('alert-success','Data Hasbeen Saved!');
    }
}
