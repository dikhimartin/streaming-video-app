<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;


class User extends Authenticatable
{
    use Notifiable,EntrustUserTrait;

    protected $table = 'users';


    protected $primaryKey = 'id_users';
    public $incrementing = false;

    protected $fillable = [
        'id_users','nik','username', 'password','email','telephone','address','date_birth','gender','id_level_user','id_setting_divisions','status','created_by','update_by','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_users_data($id_org){
        if ($id_org != '') {
          // code...
          $users = DB::table('users')
          ->select('users.*')
          ->where('users.id_setting_divisions', $id_org)
          ->where('users.status', 'Y')
          ;
        } else {
          $users = DB::table('users')
          ->select('users.*')
          ->where('users.status', 'Y')
          ;
        }
        return $users;
    }

    public function get_users_data_pos($id_pos){
        $users = DB::table('users')
        ->select('users.*','pos.nama_pos')
        ->leftJoin('pos', 'users.id_pos', '=', 'pos.id_pos')
        ->where('users.id_pos',$id_pos)
        ->where('users.status', 'Y');
        return $users;
    }

    public function get_users_data_byid($id){
        $users = DB::table('users')
        ->select('users.*')
        ->where('users.status', 'Y')
        ->where('users.id_users',$id);
        return $users;
    }


    public function get_role_users($id){
        $role_user= DB::table('role_user')
        ->select('*')
        ->Join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('user_id',$id);
        return $role_user;
    }

    public function get_company_users($id){
        $data_company = DB::table('companies')
        ->select('*')
        ->Join('users', 'companies.id_company', '=', 'users.id_company')
        ->where('users.id_users',$id);
        return $data_company;
    }




    public function get_role_org($id){
        $role_org= DB::table('org_role')
        ->select('*')
        ->where('id_divisi', $id);
        return $role_org;
    }

    public function get_data_users_level(){
        $product =DB::table('level_users')->where('status','Y');
        return $product;
    }

    public static function autonumber($table,$primary,$prefix){

        $q=DB::table($table)->select(DB::raw('MAX(RIGHT('.$primary.',5)) as kd_max'));

        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prefix.sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = $prefix."00001";
        }
        return $kd;
    }


}
