<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupUser extends Model
{

    protected $table = 'group_users';
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['id','name_group', 'description', 'status','additional', 'created_at', 'updated_at'];

    public function get_data(){
    	$data = DB::table('group_users')
        ->select('group_users.*')
        ->orderBy('id','ASC');
        return $data;
    }
}
