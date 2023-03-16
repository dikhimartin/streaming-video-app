<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PeterColes\Countries\CountriesFacade;
use Calendar;
use DB;
use DateTime;
use App\ProjectModel;
use App\FollowUp;
use App\Meeting;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\EntrustFacade as Entrust;

class AjaxController extends Controller
{
    
    public function get_client($id)
    {
        $info = DB::table('client')
                ->where('id_client',$id)->first();
        $data=array('data_client'=>$info);
        return response()->json($data);
    }


    public function get_client_byid(Request $request){
      $id =$request->id;
      $info = DB::table('client')
                ->where('id',$id)->first();

      $data_users = DB::table('users')->where('status','Y')->get();


      $data=array('data_client'=>$info,'data_users'=>$data_users);
      return response()->json($data);
    }


    public function get_project($id){


      if(Entrust::can('all-project')){
        $data = DB::table("project")
                    ->where("id_client",$id)
                    ->where("status_followed",'N')
                    ->pluck("id_project","nama_project");
      }else{
        $data = DB::table("project")
                    ->where("id_client",$id)
                    ->where("status_followed",'N')
                    ->where('project.created_by',Auth::user()->id_users)
                    ->pluck("id_project","nama_project");
      }
      return json_encode($data);
    }


    public function get_kendaraan(){
      $data = DB::table("mobil")
                    ->where("status",'Y')
                    ->pluck("id_mobil","nama_mobil");
      return json_encode($data);
    }

    public function get_supir(){
      $data = DB::table("supir")
                    ->where("status",'Y')
                    ->pluck("id_supir","nama_supir");
      return json_encode($data);
    }

    public function get_setting_follow_up($id){
      $info = DB::table('setting_calling')
                ->where('id_status_call',$id)->first();


      $count_days =$info->days_value;

      $date_now =date('Y-m-d h:i:s');

      $date_now_str_time=strtotime($date_now);
      // 7 hari next step to folowed document
      $telp_date_next =strtotime("+$count_days day", $date_now_str_time);
      $telp_date_next_fix=date('Y-m-d h:i:s',$telp_date_next);


      $data=array('data_setting'=>$info,'telp_date_next'=>$telp_date_next_fix);
      return response()->json($data);
    }


    function get_client_detail(Request $request){
      $id = $request->id;
      
      $info = DB::table('client')
                ->where('id',$id)->first();
        $data=array('data_client'=>$info);
      return response()->json($data);
    }


    function views_followup_detail(Request $request){

      $get_id_project = DB::table('project')
                        ->where('project_id',$request->id)->first();
      $id_project = $get_id_project->id_project;
      
      $data_project = new ProjectModel;
      $data_project_rest = $data_project->get_data_client_on_project($id_project)->first();

      $datax =new FollowUp;
      $data_followed = $datax->get_data_by_project($id_project)->get();
  
      $data_return =array('data_project'=>$data_project_rest,'data_followed'=>$data_followed);
        return response()->json($data_return);
    }


    function get_meeting_detail(Request $request){
      $id = $request->id;
      $datax =new Meeting;
      $data_followed = $datax->get_meeting_by_followup($id)->first();

      $id_meeting =$data_followed->id_meeting;
      $data_invite = DB::table('meeting_invitation')
                    ->select('meeting_invitation.id_meeting','users.id_users','users.name')
                    ->join('users', 'meeting_invitation.id_users', '=', 'users.id_users')
                    ->where('id_meeting',$id_meeting)
                    ->where('meeting_invitation.status','Y')
                    ->get();
     

      $row="";                  
      foreach ($data_invite as $key) {
          $id_users=$key->id_users;
          $name=$key->name;           
          $row[]=array("id"=>$id_users,"name"=>$name);
      }                    
      $data_update_invite= $row;

      $data=array('data_meeting'=>$data_followed,'data_invite'=>$data_invite,'data_update_invite'=>$data_update_invite);
      return response()->json($data);

      
    }

    function views_meeting(Request $request){
      $id =$request->id;
      $datax =new Meeting;
      $data_followed = $datax->get_meeting_by_id($id)->first();
      return response()->json($data_followed);
    }

    function views_meeting_reschedule(Request $request){
      $id = $request->id;
      $datax =new Meeting;
      $data_followed = $datax->get_meeting_by_id($id)->first();

      $data_invite = DB::table('meeting_invitation')
                    ->select('meeting_invitation.id_meeting','users.id_users','users.name')
                    ->join('users', 'meeting_invitation.id_users', '=', 'users.id_users')
                    ->where('id_meeting',$id)
                    ->where('meeting_invitation.status','Y')
                    ->get();
     

      $row="";                  
      foreach ($data_invite as $key) {
          $id_users=$key->id_users;
          $name=$key->name;           
          $row[]=array("id"=>$id_users,"name"=>$name);
      }                    
      $data_update_invite= $row;

      $dataxy=array("data_followed"=>$data_followed,'data_update_invite'=>$data_update_invite);

      return response()->json($dataxy);
    }


    function get_follow_win(Request $request){
      $id = $request->id;

      $datax = new FollowUp;

      $data_followed = $datax->get_data_byid($id)->first();
      return response()->json($data_followed);

    }


    function views_meeting_detail(Request $request){
      

      $data_project_rest =new FollowUp;

      $data_project = $data_project_rest->get_data_byid($request->id)->first();

      $data_followed =Meeting::select('meeting.*','users.name')
                                ->join('users', 'meeting.created_by', '=', 'users.id_users')
                                ->where('id_follow_up',$request->id)
                                ->where('type_meeting','win')
                                ->orderBy('meeting.start_meeting','ASC')->get();
      
      $data_return =array('data_project'=>$data_project,'data_followed'=>$data_followed);
        return response()->json($data_return);
    }


    function invite_users(){
      $list= DB::table('users')
              ->where('id_users','!=',Auth::user()->id_users)
              ->where('status','Y')->get();
        $row="";
        foreach ($list as $key) {

            $id_users=$key->id_users;
            $nama_users=$key->name;           

            $row[]=array("id"=>$id_users,"name"=>$nama_users);
        }
        echo json_encode($row);
    }

}
