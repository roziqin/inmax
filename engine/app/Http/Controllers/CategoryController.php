<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category =  category::where('taxonomi', '=' ,'category')->get();
        return view('adminlte::category',['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('adminlte::category');
    }

    public function create_slug($str)
    {
        
        return $str;
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
        //validation
          $this->validate($request,[
          'name'=> 'required',
        ]);

        $data = new category();
        $data->parent_id = NULL;
        $data->order = 0;
        $data->name = $request->name;
        $str = strtolower(trim($request->name));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        $data->slug = $str;
        $data->taxonomi = 'category';
        $data->save();
    
       //echo "kjgjg" ;
        return redirect('category'); 
        //return response ()->json ( $data );
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
        $tampiledit = Category::where('id', $id)->first();
        return view('adminlte::editcategory')->with('tampiledit', $tampiledit);
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
        // validation
        $this->validate($request,[
          'name'=> 'required',
      ]);

        $data = Category::where('id', $id)->first();
        $data->parent_id = NULL;
        $data->order = 0;
        $data->name = $request->name;
        $str = strtolower(trim($request->name));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        $data->slug = $str;
        $data->taxonomi = 'category';
        $data->update();

        return redirect('category');
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('category');
    }
}
