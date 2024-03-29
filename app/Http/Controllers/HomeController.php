<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Slider;
use App\Icons;
session_start();

class HomeController extends Controller
{
   public function index(Request $request){
    //get icons social
    $icons = Icons::orderBy('id_icons','DESC')->get();
    //seo 
        $meta_desc = "Chuyên bán phụ kiện - văn phòng phẩm giá rẻ và chất lượng."; 
        $meta_keywords = "Decor, phụ kiện";
        $meta_title = "MaTuStore - phụ kiện, văn phòng phẩm";
        $url_canonical = $request->url();
    //--seo
    //slide
    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


   	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
   	$all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6);
   	return view('pages.home')->with('category',$cate_product)->with('all_product',$all_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('icons',$icons);
   }

   public function search(Request $request){
        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo

		$keywords = $request->keywords_submit;

		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	// $all_product = DB::table('tbl_product')
     //    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
     //    ->orderby('tbl_product.product_id','desc')->get();

    	$search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

    	return view('pages.sanpham.search')->with('category',$cate_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
	}   

  public function autocomplete_ajax(Request $request){
    $data = $request->all();

    if($data['query']){
      $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach ($product as $key => $val) {
        $output .= '
        <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
        ';
      }
      $output .= '</ul>';
      echo $output;
    }
  }
}
