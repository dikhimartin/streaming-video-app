<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Traits\RespondsWithHttpStatus;
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

        $datas->orderBy('created_at','DESC');
        $rows = $datas->paginate(10);

        return view('backend.'.$this->controller.'.list', compact('rows'))->with(array('controller' => $this->controller, 'pages_title' => $this->title(), 'text_filter' => $text_filter , 'operator_filter' => $operator_filter, 'field_filter' => $field_filter));
    }

    private function _validate_data(Request $request, $source){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->title == ''){
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
        if ($source == 'save') {
            if (!$request->hasFile('file')) {
                $data['inputerror'][] = 'file';
                $data['error_string'][] = 'File is required';
                $data['status'] = FALSE;
            }else{
                $fileSize = $request->file('file')->getSize();
                $maxFileSize = config('app.upload_max_size', 2048); // Maximum file size in kilobytes
                if ($fileSize > $maxFileSize * 1024) {
                    $data['inputerror'][] = 'file';
                    $data['error_string'][] = 'The file size must not exceed ' . $maxFileSize . ' KB';
                    $data['status'] = FALSE;
                }
            }
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function save(Request $request){
        // Check user permissions
        if (!Auth::user()->can($this->controller . '-create')) {
            return json_encode("error_403");
        }

        // Validate request data
        MultimediaController::_validate_data($request, "save");
    
        // Create a new multimedia object
        $data = new Multimedia();
    
        // Handle file upload
        if ($request->file('file')) {
            $video = $request->file('file');
            $original_file_name = $video->getClientOriginalName();
            $file_ext = $video->getClientOriginalExtension();
            $file_size = $video->getSize();
            $filename = 'P-' . time() . '-' . Str::random(10) . '.' . $file_ext;
    
            // Generate a UUID to use in the file path
            $sub = Str::uuid();
    
            // Build the full path to the directory where the file will be stored
            $path = env("ROOT_PATH", "multimedia");
            $full_path = $path . '/' . $sub;
    
            // Build the destination directory path
            $destination_path = './'. $full_path .'/';
    
            // Build the file paths for the different representations of the file
            $relative_path = $full_path . '/' . $filename;
            $absolute_path = config('app.url') . '/' . $relative_path;
    
            // Move the uploaded file to the destination directory
            $video->move($destination_path, $filename);
    
            // Set multimedia object properties
            $data->file_name = $filename;
            $data->file_size = $file_size;
            $data->original_file_name = $original_file_name;
            $data->path = $full_path;
            $data->absolute_path = $absolute_path;
            $data->relative_path = $relative_path;
        }
    
        // Set remaining multimedia object properties
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = "Y";
        $data->save();
    
        // Return success response
        $result = [
            "data_post" => [
                "status" => true,
                "class" => "success",
                "message" => __('main.data_added_succesfully'),
            ],
        ];
        return json_encode($result);
    }

    public function update(Request $request){
        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }
        
        MultimediaController::_validate_data($request, "update");
        
        $res = Multimedia::find($request->id);
        if (!$res) {
            return  json_encode("record not found");
        }

        // Handle file upload
        if ($request->file('file')) {
            if(!File::exists(public_path($res->relative_path))){
                return  json_encode("file not found");
            }
            File::delete(public_path($res->relative_path));

            $video = $request->file('file');
            $original_file_name = $video->getClientOriginalName();
            $file_ext = $video->getClientOriginalExtension();
            $file_size = $video->getSize();
            $filename = 'P-' . time() . '-' . Str::random(10) . '.' . $file_ext;
    
            // Build the full path to the directory where the file will be stored
            $full_path = $res->path;
    
            // Build the destination directory path
            $destination_path = './'. $full_path .'/';
    
            // Build the file paths for the different representations of the file
            $relative_path = $full_path . '/' . $filename;
            $absolute_path = config('app.url') . '/' . $relative_path;
    
            // Move the uploaded file to the destination directory
            $video->move($destination_path, $filename);
    
            // Set multimedia object properties
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

    public function delete_all(Request $request){
        if (!Auth::user()->can($this->controller.'-delete')){
            echo json_encode("error_403");
        }
    
        $ids = $request->input('id');
        $multimedia = Multimedia::whereIn('id', $ids)->get();
    
        foreach ($multimedia as $file) {
            if (File::exists(public_path($file->relative_path))) {
                File::delete(public_path($file->relative_path));
            }
        }
    
        Multimedia::whereIn('id', $ids)->delete();
    
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
