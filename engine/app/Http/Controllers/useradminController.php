<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\useradmin;
use Image;
use Carbon\Carbon;
use DB;

class useradminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tampiluser = DB::table('users')
            ->where('role', 'admin')
            ->get();
        return view('adminlte::useradmin',['tampiluser' => $tampiluser]);
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
        $data = new useradmin();
        $data->name = $request->name;
        $data->password = bcrypt($request->password);
        $data->status = $request->status;
        $data->email = $request->email;
        $data->role = 'admin';
        
        $data->save();
        return redirect('adduser');
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
        $tampiledit = useradmin::where('id', $id)->first();

        return view('adminlte::edituser')
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
        $dataupdate = useradmin::findOrFail($id);
        $dataupdate->name = $request->name;
        $dataupdate->status = $request->status;
        $dataupdate->email = $request->email;
        if ($request->password=="") {
            # code...
        } else {
            $dataupdate->password = bcrypt($request->password);   
        }
        $dataupdate->update();

        return redirect('user')->with('alert-success','Data Hasbeen Saved!');
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
        $task = useradmin::findOrFail($id);

        $task->delete();

        
        return redirect('user')->with('alert-success','Data Hasbeen Saved!');
    }

    public function adduser()
    {
        return view('adminlte::adduser');
    }
}
