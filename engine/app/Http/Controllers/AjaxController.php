<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class AjaxController extends Controller
{
    //
    public function kabupaten($id)
    {
        $cities = DB::table("regencies")
                    ->where("province_id",$id)
                    ->pluck("name","id");
        return json_encode($cities);
    }

    public function Kecamatan($id)
     {
         $cities = DB::table("districts")
                     ->where("regency_id",$id)
                     ->pluck("name","id");
         return json_encode($cities);
     }
     public function kelurahan($id)
      {
          $cities = DB::table("villages")
                      ->where("district_id",$id)
                      ->pluck("name","id");
          return json_encode($cities);
      }
}
