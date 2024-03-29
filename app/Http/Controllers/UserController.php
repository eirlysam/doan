<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Admin;
use App\Roles;
use Session;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response 
	*/
    public function index()
    {
    	$admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
    	return view('admin.users.all_users')->with(compact('admin'));
    }

    public function add_users(){
    	return view('admin.users.add_users');
    }

    public function assign_roles(Request $request){
    	$data = $request->all();
    	$user = Admin::where('admin_email',$data['admin_email'])->first();
    	$user->roles()->detach();
    	if($request['author_role']){
    		$user->roles()->attach(Roles::where('name','author'))->first();
    	}
    	if($request['user_role']){
    		$user->roles()->attach(Roles::where('name','user'))->first();
    	}
    	if($request['admin_role']){
    		$user->roles()->attach(Roles::where('name','admin'))->first();
    	}
    	return redirect()->back();
    }

    public function store_users(Request $request){
    	$data = $request->all();
    	$admin = new Admin();
    	$admin->admin_name = $data['admin_name'];
    	$admin->admin_phone = $data['admin_phone'];
    	$admin->admin_email = $data['admin_email'];
    	$admin->admin_password = $data['admin_password'];
    	$admin->save();
    	$admin->roles()->attach(Roles::where('name','user')->first());
    	Session::put('message','Thêm users thành công');
    	return Redirect::to('users');
    }
}
