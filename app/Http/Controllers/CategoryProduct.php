<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\CategoryProductModel;
use App\Product;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function arrange_category(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $cate_id = $data['page_id_array'];
        foreach ($cate_id as $key => $value) {
            $category = CategoryProductModel::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Updated';
    }

    public function index_shop(Request $request){
        //seo
        $meta_desc = "Sản phẩm"; 
        $meta_keywords = "Sản phẩm";
        $meta_title = "Sản phẩm";
        $url_canonical = $request->url();
        //endseo
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        return view('pages.shop')->with('category',$cate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function add_category_product(){
        $this->AuthLogin();
        $category = CategoryProductModel::where('category_parent',0)->orderBy('category_id','DESC')->get();
    	return view('admin.add_category_product')->with(compact('category'));
    }

    public function all_category_product(){
        $this->AuthLogin();
        $category_product = CategoryProductModel::where('category_parent',0)->orderBy('category_id','DESC')->get();
    	$all_category_product = DB::table('tbl_category_product')->orderBy('category_parent','DESC')->orderBy('category_order','ASC')->paginate(10);
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product)->with('category_product', $category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message', 'Thêm danh mục sản phẩm thành công!');
    	return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
    	DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
    	Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công!');
    	return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
    	DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
    	Session::put('message', 'Kích hoạt sản phẩm thành công!');
    	return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = CategoryProductModel::orderBy('category_id','DESC')->get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category', $category);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    } 

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công!');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công!');
        return Redirect::to('all-category-product');
    }

    // End Function Admin Page

    public function show_category_shop(Request $request,$slug_category_product){
        

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

        $category_by_slug = CategoryProductModel::where('slug_category_product',$slug_category_product)->get();

        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $min_price_range = $min_price + 1000;
        $max_price_range = $max_price + 100000;

        foreach ($category_by_slug as $key => $cate) {
            $category_id = $cate->category_id;
        }

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $category_by_id = Product::with('category')->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_price','ASC')->paginate(6);
        
        }else{
            $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','DESC')->paginate(6);
        }

        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);

        foreach($cate_product as $key => $val){
            //seo
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
            //endseo
        }

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();

        
        
        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }
}

