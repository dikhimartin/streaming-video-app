<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use DB;


class Role extends EntrustRole
{

    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['id','name', 'display_name', 'description','status', 'created_at', 'updated_at', 'additional'];

    public function get_data(){
    	$data = DB::table('roles')
        ->select('roles.*')
        ->orderBy('id','ASC');
        return $data;
    }

}
