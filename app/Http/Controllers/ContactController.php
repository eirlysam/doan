<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Contact;
use App\Slider;
use App\Icons;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
    public function add_nut(Request $request){
        $data = $request->all();
        $icons = new Icons();
        $name = $data['name'];
        $link = $data['link'];

        $get_image = $request->file('file');

        $path = 'public/uploads/icons/';
 
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $icons->image = $new_image;
        }
        $icons->name = $name;
        $icons->link = $link;
        $icons->save();
    }

    public function delete_icons(){
        $id = $_GET['id'];
        $icons = Icons::find($id);
        $icons->delete();
    }

    public function list_nut(){
        $icons = Icons::orderBy('id_icons', 'DESC')->get();
        // dd($icons);
        $output = '';
        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tên mạng xã hội</th>
                        <th>Link mạng xã hội</th>
                        <th>Hình ảnh</th>
                        <th></th>
                </thead>
                <tbody>';
                foreach($icons as $icon){
                    $output .= '
                    <tr>
                        <td>'.$icon->name.'</td>
                        <td><img height="25px" width="25px" src="'.url('/public/uploads/icons/'.$icon->image).'"></td>
                        <td>'.$icon->link.'</td>
                        <td><a id="'.$icon->id_icons.'" class="" onclick="delete_icons(this.id)"><i class="fa fa-times text-danger"></i></a></td>
                    </tr>';
                }   
                $output .= '</tbody>
            </table>
        </div>';
        echo $output;
    }

    public function lien_he(Request $request){
    	//seo 
        $meta_desc = "Liên hệ"; 
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ chúng tôi";
        $url_canonical = $request->url();
	    //--seo
	    //slide
	    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


	   	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
	   	$contact = Contact::where('info_id',1)->get();

    	return view('pages.lienhe.contact')->with('category',$cate_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('contact',$contact);
    }

    public function info(){
    	$contact = Contact::where('info_id',1)->get();
    	return view('admin.information.add_info')->with(compact('contact'));
    }

    public function update_info(Request $request, $info_id){
    	$data = $request->all();
    	$contact = Contact::find($info_id);
    	$contact->info_contact = $data['info_contact'];
    	$contact->info_map = $data['info_map'];
        $contact->slogan_logo = $data['slogan_logo'];
    	
    	$get_image = $request->file('info_logo');
    	$path = 'public/uploads/contact/';
    	if($get_image){
    		unlink($path.$contact->info_logo);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }
        $contact->save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công!');
    }

    public function save_info(Request $request){
    	$data = $request->all();
    	$contact = new Contact();
    	$contact->info_contact = $data['info_contact'];
    	$contact->info_map = $data['info_map'];
    	
    	$get_image = $request->file('info_logo');
    	$path = 'public/uploads/contact/';
    	if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }
        $contact->save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công!');
    }
}
