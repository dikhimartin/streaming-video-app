<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use App\Multimedia;
use App\User;
use DB;

class MultimediaController extends Controller
{
    
    private $controller = 'multimedia';

    private function title(){
        return __('main.multimedia');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){ 

        if (!Auth::user()->can($this->controller.'-list')){
            return view('backend.errors.401')->with(['url' => '/admin']);
        }

        // Filter Data
        $field_filter       = $request->get('field_filter');
        $operator_filter    = $request->get('operator_filter');
        $text_filter        = $request->get('text_filter');

        $row = new Multimedia;
        $datas = $row->get_data();
        
        if ($text_filter !== false && $operator_filter == "LIKE"){
            $datas->where('multimedia.'.$field_filter.'','LIKE','%'.$text_filter.'%');        
        }else if ($text_filter !== false && $operator_filter == "="){
            $datas->where('multimedia.'.$field_filter.'', '=', "".$text_filter."");      
        }

        $datas->orderBy('id','DESC');
        $rows = $datas->paginate(10);

        return view('backend.'.$this->controller.'.list', compact('rows'))->with(array('controller' => $this->controller, 'pages_title' => $this->title(), 'text_filter' => $text_filter , 'operator_filter' => $operator_filter, 'field_filter' => $field_filter));
    }

    private function _validate_data(Request $request){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->title == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
        if ($request->file('file')) {
            $fileSize = $request->file('file')->getSize();
            $maxFileSize = env("UPLOAD_MAX_FILESIZE", 2048); // Maximum file size in kilobytes
            if ($fileSize > $maxFileSize * 1024) {
                $data['inputerror'][] = 'file';
                $data['error_string'][] = 'The file size must not exceed ' . $maxFileSize . ' KB';
                $data['status'] = FALSE;
            }
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function save(Request $request){
        if (!Auth::user()->can($this->controller.'-create')){
            return  json_encode("error_403");
        }

        MultimediaController::_validate_data($request);

        $data = new Multimedia();
        if ($request->file('file')) {
            $file = $request->file('file');
            $original_file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $filename = 'P-'.time().'-'.Str::random(10) . '.' . $file_ext;
            
            $path = env("ROOT_PATH", "multimedia");
            $destination_path = './'. $path .'/';
            $relative_path = $path.'/'.$filename;
            $absolute_path = env("APP_URL","http://localhost:8000").'/'.$path.'/'.$filename;
            if (!$file->move($destination_path, $filename)) {
                return $this->errorInternal('Cannot upload file');
            }

            $data->file_name = $filename;
            $data->file_size = $file_size;
            $data->original_file_name = $original_file_name;
            $data->absolute_path = $absolute_path;
            $data->relative_path = $relative_path;
        }    
        
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = "Y";
        $data->save();

        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "success",
                "message"=> __('main.data_added_succesfully')
            )
        );
        echo json_encode($result);
    }

    public function update(Request $request){
        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }

        MultimediaController::_validate_data($request);

        $res = Multimedia::find($request->id);
        if (!$res) {
            return $this->errorNotFound("record not found");
        }
        if ($request->file('file')) {
            if(!File::exists(public_path($res->relative_path))){
                return $this->errorNotFound("file not found");
            }
            File::delete(public_path($res->relative_path));

            $file = $request->file('file');
            $original_file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $filename = 'P-'.time().'-'.Str::random(10) . '.' . $file_ext;
            
            $path = env("ROOT_PATH", "multimedia");
            $destination_path = './'. $path .'/';
            $relative_path = $path.'/'.$filename;
            $absolute_path = env("APP_URL","http://localhost:8000").'/'.$path.'/'.$filename;
            if (!$file->move($destination_path, $filename)) {
                return $this->errorInternal('Cannot upload file');
            }

            $res->file_name = $filename;
            $res->file_size = $file_size;
            $res->original_file_name = $original_file_name;
            $res->absolute_path = $absolute_path;
            $res->relative_path = $relative_path;
        }    

        $res->title = $request->title;
        $res->description = $request->description;
        $res->status = $request->status;
        
        $res->save();
        
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=> __('main.data_succesfully_changed')
            )
        );
        echo json_encode($result);
    }

    public function change_status_active($id){
        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }


        $pk = Multimedia::find($id);
        $pk->status = "Y";
        $pk->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "info",
                "message"=> __('main.data_already_active')
            )

        );
        echo json_encode($result);
    }

    public function change_status_inactive($id){
        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }

        $pk = Multimedia::find($id);
        $pk->status = "N";
        $pk->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=> __('main.data_inactive')
            )
        );
        echo json_encode($result);
    }

    public function delete(Request $request){
        if (!Auth::user()->can($this->controller.'-delete')){
            echo json_encode("error_403");
        }
        $res = Multimedia::find($request->id);
        if(!File::exists(public_path($res->relative_path))){
            return $this->errorNotFound("file not found");
        }
        File::delete(public_path($res->relative_path));
        $res->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        echo json_encode($result);
    }

    public function delete_all($id){
        if (!Auth::user()->can($this->controller.'-delete')){
            echo json_encode("error_403");
        }

        DB::table("multimedia")->whereIn('id',explode(",",$id))->delete();

        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        echo json_encode($result);
    }

    public function get_group_user_data_byid(Request $request){
        if (!Auth::user()->can($this->controller.'-list')){
            echo json_encode("error_403");
        }

        $id = $request->id;

        $data = DB::table('multimedia')->select('multimedia.*')
        ->where('id',$id)
        ->first();

        $data_return =array('data_multimedia'=>$data);
        return response()->json($data_return);
    }

}
