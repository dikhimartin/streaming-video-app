<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use DB;

class Multimedia extends Model
{
    Use Uuid;

    protected $table = 'multimedia';
    protected $fillable = [
        'title', 'file_name','file_size','original_file_name','absolute_path','relative_path','description','status'
    ];
       
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function get_data(){
    	$data = DB::table('multimedia')
        ->select('multimedia.*')
        ->orderBy('id','ASC');
        return $data;
    }
}
