<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Auth;

class SliderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_slider(){
    	$all_slide = Slider::orderBy('slider_id','DESC')->get();
    	return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function add_slider(){
    	return view('admin.slider.add_slider');
    }

    public function unactive_slide($slider_id){
        $this->AuthLogin();
    	DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
    	Session::put('message', 'Không kích hoạt slide thành công!');
    	return Redirect::to('manage-slider');
    }
    public function active_slide($slider_id){
        $this->AuthLogin();
    	DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
    	Session::put('message', 'Kích hoạt slide thành công!');
    	return Redirect::to('manage-slider');
    }

    public function insert_slider(Request $request){
    	$data = $request->all();
    	// dd($data);
    	$this->AuthLogin();
    	
        $get_image = $request->file('slider_image');
 
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
            
            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();

            Session::put('message', 'Thêm slider thành công!');
            return Redirect::to('add-slider');
        }else{
        	Session::put('message', 'Vui lòng thêm hình ảnh!');
    		return Redirect::to('add-slider');
        }
    }

    public function delete_slide($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        Session::put('message', 'Xóa slider thành công');
        return Redirect::to('manage-slider'); 
    }
}
