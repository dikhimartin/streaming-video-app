<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PeterColes\Countries\CountriesFacade;

class AjaxController extends Controller
{

  public function index(){

      $data['propinsi'] = DB::table("local_provinces")
                    ->pluck("name","id");
      return view('dropdown')->with($data);;
  }

   public function kabupaten($id)
    {
        $cities = DB::table("local_regencies")
                    ->where("province_id",$id)
                    ->pluck("name","id");
        return json_encode($cities);
    }

    public function get_workers($id)
    {
        $info = DB::table('worker')
                ->select('worker.*','local_regencies.name as regensi','local_provinces.name as propinsi','code_experience.code')
                ->join('local_regencies', 'worker.id_regensi', '=', 'local_regencies.id')
                ->join('local_provinces', 'worker.id_provinsi', '=', 'local_provinces.id')
                ->leftjoin('code_experience','worker.code_experience','=','code_experience.id')
                ->where('id_worker',$id)->first();

        $countries =CountriesFacade::lookup(LaravelLocalization::getCurrentLocale());
        $data=array('data_worker'=>$info,'data_tujuan'=>$countries[$info->country]);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return response()->json($data);
    }

    public function Kecamatan($id)
     {
         $cities = DB::table("local_districts")
                     ->where("regency_id",$id)
                     ->pluck("name","id");
         return json_encode($cities);
     }
     public function kelurahan($id)
      {
          $cities = DB::table("local_villages")
                      ->where("district_id",$id)
                      ->pluck("name","id");
          return json_encode($cities);
      }

    public function source($id){
      $cities = DB::table("link_sosmed")
                    ->join('sosmed','sosmed.id_sosmed','=','link_sosmed.id_sosmed')
                    ->where("id_worker",$id)
                    ->pluck("sosmed.nama_sosmed","link_sosmed");
        return json_encode($cities);
    }


    function get_client_detail(){
      $id = $request->id;
        $workers = new Workers();
        $source = new LinkSosmed();
        $data_source = $source->get_data_source_byid($id)->get();
        $data_worker =$workers->get_data_worker_byid($id)->first();


        $countries =CountriesFacade::lookup(LaravelLocalization::getCurrentLocale());
        $data_return =array('data_worker'=>$data_worker,'data_source'=>$data_source,'data_negara'=>$countries[$data_worker->country]);
        return response()->json($data_return);
    }


    


}