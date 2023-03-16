<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Levelusers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User_role;
use App\Permission;
use File;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $controller = 'users';

    private function title(){
        return __('main.user_list');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $id_level_user = Auth::user()->id_level_user;

        $data['page_active'] ="users";
        $data['controller'] =$this->controller;
        $data['pages_title'] =$this->title();
        $data['dt_level'] = DB::table('roles')->where('roles.id','!=',3)->get();

        $permission = DB::table('users')
        ->select('users.id_users','users.nik','users.name','users.email','users.gender','users.id_level_user')
        ->where('users.id_level_user',$id_level_user)
        ->where('users.status','Y')
        ->first();

        return view('backend.setting.users',compact('permission'))->with($data);
    }

    public function get_users_data(){

        $id_level_user = Auth::user()->id_level_user;

        $permission = DB::table('users')
        ->select('users.id_users','users.nik','users.name','users.email','users.gender','users.id_level_user')
        ->where('users.id_level_user',$id_level_user)
        ->where('users.status','Y')
        ->first();

        if($permission->id_level_user == 3){

            $user = DB::table('users')
            ->select('users.id_users','users.nik','users.name','roles.display_name','roles.description','users.email','users.gender','role_user.role_id')
            ->leftjoin('role_user', 'users.id_users', '=', 'role_user.user_id')
            ->where('users.status','Y')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id');
        } elseif ($permission->id_level_user == 1) {

            $user = DB::table('users')
            ->select('users.id_users','users.nik','users.name','roles.display_name','roles.description','users.email','users.gender','role_user.role_id')
            ->leftjoin('role_user', 'users.id_users', '=', 'role_user.user_id')
            ->where('users.id_level_user','!=',3)
            ->where('users.status','Y')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id');
        }else{
            $user = DB::table('users')
            ->select('users.id_users','users.nik','users.name','roles.display_name','roles.description','users.email','users.gender','role_user.role_id')
            ->leftjoin('role_user', 'users.id_users', '=', 'role_user.user_id')
            ->where('users.status','Y')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id');
        }

        $data_users =$user->get();

        $data = array();
        $no = 0;
        foreach ($data_users as $users) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $users->display_name;
            $row[] = $users->name;
            $row[] = $users->email;

            if ($users->gender == "L") {
                $row[] = __('main.male');
            }else{
                $row[] = __('main.female');
            }

            $option="<div class='hidden-sm hidden-sm action-buttons center'>";

            $user = User::where('id_users', '=', Auth::user()->id_users)->first();
            if($user->can(['users-edit'])){
                $option .="<a href='javascript:void(0)' onclick=edited('".$users->id_users."') class='btn waves-effect waves-light btn-rounded btn-sm btn-info' title='Edited'><i class='ace-icon fa fa-pencil bigger-130'></i></a>&nbsp;";
            }
            if($user->can(['users-delete'])){
                $option .="<a href='javascript:void(0)' onclick=removed('".$users->id_users."') class='btn waves-effect waves-light btn-rounded btn-sm btn-danger' title='Deleted'><i class='ace-icon fa fa-trash-o bigger-130'></i></a>";
            }
            $option .="</div>";
            $row[] =$option;
            $data[] = $row;
        }

        $output = array(
                        "data" => $data,
                    );
        return json_encode($output);
    }

    private function _validate_data(Request $request){
        
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->nik == '')
        {
            $data['inputerror'][] = 'nik';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if($request->names == '')
        {
            $data['inputerror'][] = 'names';
            $data['error_string'][] = 'name is required';
            $data['status'] = FALSE;
        }
        if($request->email == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email is required';
            $data['status'] = FALSE;
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Invalid email format';
            $data['status'] = FALSE;
        }


        if($request->id_role == '')
        {
            $data['inputerror'][] = 'id_role';
            $data['error_string'][] = 'level user is required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function save_users(Request $request){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $check_nik = DB::table('users')->where('nik', $request->nik)->count();

        if($check_nik >= 1)
        {
            $data['inputerror'][] = 'nik';
            $data['error_string'][] = 'nik Can not be the same';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }

        UsersController::_validate_data($request);
        $table="users";
        $primary="id_users";
        $prefik="K";
        $Kode_unik=User::autonumber($table,$primary,$prefik);

        $pk = new User;
        $pk->id_users   = $Kode_unik;
        $pk->nik        = $request->nik;
        $pk->name       = $request->names;
        $pk->email      = $request->email;
        $pk->telephone  = $request->telephone;
        $pk->date_birth = $request->date_birth;
        $pk->address    = $request->address;
        $pk->gender     = $request->gender;
        $pk->password   = bcrypt($request->password);

        if(!empty($request->file('image'))){
            $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $Extension  = $file->getClientOriginalExtension();
            $FileUpload = md5($fileName.$Kode_unik).".".$Extension;
            $request->file('image')->move("images/profile/", $FileUpload);
            $pk->image = $FileUpload;
        }

        $pk->created_by =Auth::user()->id_users;
        $pk->status ='Y';
        $pk->id_level_user = $request->id_role;;
        $pk->save();

        $role_user = new User_role;
        $role_user->user_id=$Kode_unik;
        $role_user->role_id=$request->id_role;
        $role_user->save();

        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "success",
                "message"=>"Success ! Added Data"
            )
        );
        echo json_encode($result);
    }

    public function update_users(Request $request){
        UsersController::_validate_data($request);

        $pk = User::find($request->id_users);
        $pk->nik = $request->nik;
        $pk->name = $request->names;
        $pk->email = $request->email;
        $pk->telephone = $request->telephone;
        $pk->address = $request->address;        
        $pk->date_birth = $request->date_birth;        
        $pk->gender = $request->gender;
        if(!empty($request->password)){
            $pk->password =bcrypt($request->password);
        }

        if ($request->status_image == "0") {
            // delete_image
           $path_delete = 'images/profile/'.$pk->image;
           $deleted = File::delete($path_delete);
           $pk->image = "";

        }else{
            if(!empty($request->file('image'))){
                // delete_image
               $path_delete = 'images/profile/'.$pk->image;
               $deleted = File::delete($path_delete);

                $file       = $request->file('image');
                $fileName   = $file->getClientOriginalName();
                $Extension  = $file->getClientOriginalExtension();
                $FileUpload = md5($fileName.$request->id_users).".".$Extension;
                $request->file('image')->move("images/profile/", $FileUpload);
                $pk->image = $FileUpload;
            }
        }


        $pk->updated_by =Auth::user()->id_users;
        $pk->save();

        $role_id =$request->id_role;
        $user_id =$request->id_users;

        DB::table('role_user')
            ->where('user_id', $user_id)
            ->update(['role_id' => $role_id]);


        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=>"Success ! Updated Data"
            )
        );
        echo json_encode($result);
    }

    public function deleted_users(Request $request){
        $pk = User::find($request->id);
        // delete_image
        $path_delete = 'images/profile/'.$pk->image;
        $deleted = File::delete($path_delete);        
        $pk->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=>"Success ! Deleted data"
                )
            );
        echo json_encode($result);
    }

    public function get_users_data_byid(Request $request){
        $id = $request->id;
        $user = new User();

        $data_users =$user->get_users_data_byid($id)->first();
        $data_role = $user->get_role_users($id)->first();


        $data_return =array('data_users'=>$data_users,'data_role'=>$data_role);
        return response()->json($data_return);
    }
}
