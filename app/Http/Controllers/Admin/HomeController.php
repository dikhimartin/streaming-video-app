<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PeterColes\Countries\CountriesFacade;
use Calendar;
use DB;
use DateTime;
use URL;
use App\User;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\EntrustFacade as Entrust;

class HomeController extends Controller
{
    private $controller = 'home';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function title(){
        return __('main.dashboard');
    }

    public function index(){

      $controller =$this->controller;
      $pages_title="Dashboard";
      $page_active='dashboard';

      $data_user = DB::table('users')
        ->select('users.nik','users.name','users.id_level_user','roles.display_name')
        ->leftjoin('roles','users.id_level_user','=','roles.id')
        ->where('users.id_users',Auth::user()->id_users)
      ->first();

      return view('backend.home',compact('controller','page_active','pages_title','data_user'));
    }


}
