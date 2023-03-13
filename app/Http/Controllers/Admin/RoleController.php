<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Role;
use App\Permission;
use DB;

use Datatables;


class RoleController extends Controller
{

    private $controller = 'roles';

    private function title(){
        return __('main.user_role');
    }

    public function index(Request $request){

        if (!Auth::user()->can($this->controller.'-list')){
            return view('backend.errors.403')->with(['url' => '/admin']);
        }

        // Filter Data
        $field_filter       = $request->get('field_filter');
        $operator_filter    = $request->get('operator_filter');
        $text_filter        = $request->get('text_filter');


        $controller  = $this->controller;
        $page_active = "roles";
        $pages_title = $this->title();

        $role = new Role;
        $datas = $role->get_data();
        if ($text_filter !== false && $operator_filter == "LIKE"){
            $datas->where('roles.'.$field_filter.'','LIKE','%'.$text_filter.'%');        
        }else if ($text_filter !== false && $operator_filter == "="){
            $datas->where('roles.'.$field_filter.'', '=', "".$text_filter."");      
        }

        $datas->orderBy('id','DESC');
        $roles = $datas->paginate(10);

        return view('backend.role_index',compact('roles','pages_title','page_active','controller', 'text_filter', 'operator_filter', 'field_filter'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(){

        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.403')->with(['url' => '/admin']);
        }

        $controller =$this->controller;
        $pages_title =$this->title();
        $permission = Permission::orderBy('urutan','ASC')->get();
        $page_active ="roles";

        $arrGroup = [];
        foreach ($permission as $row){
            $splices = explode('-', $row->name);
            if (count($splices) > 1){
                unset($splices[count($splices)-1]);    
            }
            
            $groupName = implode('-', $splices);
            $arrGroup[$groupName][] = $row;
        }
        
        return view('backend.role_create',compact('permission','pages_title','page_active','controller','arrGroup'));
    }

    public function store(Request $request){

        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.403')->with(['url' => '/admin']);
        }

        $this->validate($request, [
            'name'          => 'required|unique:roles,name',
            'display_name'  => 'required',
            'status'        => 'required',
            'description'   => 'required',
            'permission'    => 'required',
        ]);

        $role = new Role();
        $role->name         = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->status       = $request->input('status');
        $role->description  = $request->input('description');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    public function edit($id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return view('backend.errors.403')->with(['url' => '/admin']);
        }

        $controller     = $this->controller;
        $page_active    = "roles";
        $pages_title    = $this->title();
        $page_active    = "roles";
        $role = Role::find($id);
        // $permission = Permission::get();
        $permission = Permission::orderBy('urutan','ASC')->get();
        $arrGroup = [];
        foreach ($permission as $row){
            $splices = explode('-', $row->name);
            if (count($splices) > 1){
                unset($splices[count($splices)-1]);    
            }
            
            $groupName = implode('-', $splices);
            $arrGroup[$groupName][] = $row;
        }
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->pluck('permission_role.permission_id','permission_role.permission_id')->all();

        return view('backend.role_edit',compact('role','permission','rolePermissions','pages_title','page_active','controller', 'arrGroup'));
    }

    public function update(Request $request, $id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return view('backend.errors.403')->with(['url' => '/admin']);
        }        

        $this->validate($request, [
            'display_name'  => 'required',
            'description'   => 'required',
            'status'        => 'required',
            'permission'    => 'required',
        ]);

        $role               = Role::find($id);
        $role->display_name = $request->input('display_name');
        $role->status       = $request->input('status');
        $role->description  = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    public function change_status_active($id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return json_encode("error_403");
        }    

        $pk = Role::find($id);
        $pk->status = "Y";
        $pk->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "info",
                "message"=> __('main.data_already_active')
            )

        );
        return json_encode($result);
    }

    public function change_status_inactive($id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return json_encode("error_403");
        }    

        $pk = Role::find($id);
        $pk->status = "N";
        $pk->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=> __('main.data_inactive')
            )
        );
        return json_encode($result);
    }

    public function delete(Request $request){

        if (!Auth::user()->can($this->controller.'-delete')){
            return json_encode("error_403");
        }    

        $pk = Role::find($request->id);
        $pk->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        return json_encode($result);
    }

    public function delete_all($id){

        if (!Auth::user()->can($this->controller.'-delete')){
            return json_encode("error_403");
        }    

        DB::table("roles")->whereIn('id',explode(",",$id))->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        return json_encode($result);
    }

    public function get_roles_byid(Request $request){

        if (!Auth::user()->can($this->controller.'-list')){
            return json_encode("error_403");
        }    
        $id = $request->id;
        $data_role = Role::find($id);
        $data_rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();

        $data_return =array('data_role'=>$data_role,'data_rolePermissions'=>$data_rolePermissions);
        return response()->json($data_return);
    }

}