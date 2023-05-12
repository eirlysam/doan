<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use File;
use App\Product;
use App\Gallery;
use App\Comment;
use App\Rating;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Ashion';
        $comment->save();
    }

    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));

    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm) {
            
            $output.= '
                <div class="row style_comment">
                    <div class="col-md-2">
                        <img width="60%" src="'.url('/public/frontend/images/avt.png').'" class="img img-responsive img-thumbnail">
                    </div>
                    <div class="col-md-10">
                        <p style="color: green;">@'.$comm->comment_name.'</p>
                        <p style="color: #000;">'.$comm->comment_date.'</p>
                        <p>'.$comm->comment.'</p>
                    </div>
                </div><p></p>
            ';
            foreach ($comment_rep as $key => $rep_comment) {
                if($rep_comment->comment_parent_comment == $comm->comment_id) {
                    $output.= '<div class="row style_comment"style="margin:5px 40px">
                        <div class="col-md-2">
                            <img width="70%" src="'.url('/public/frontend/images/admin.png').'" class="img img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-10">
                            <p style="color: brown;">@Admin</p>
                            <p style="color: #000;">'.$rep_comment->comment.'</p>
                            <p></p>
                        </div>
                    </div><p></p>';
                }      
            }
        }
        echo $output; 
    }

    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery'] = '';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'].= '<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'"></p>';
        }

        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').'đ';
        $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';

        $output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" id="buy_quickview" data-id_product="'.$product->product_id.'" name="add-to-cart">';

        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">

        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">

        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">

        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">

        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">

        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';

        echo json_encode($output);
    }

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	return view('admin.add_product')->with('cate_product', $cate_product);
    }

    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product = view('admin.all_product')->with('all_product', $all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
    	$data = array();

        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);

    	$data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $product_price;
        $data['price_cost'] = $price_cost;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
    	$data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
 
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;

        $gallery->save();
        
        Session::put('message', 'Thêm sản phẩm thành công!');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
    	Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công!');
    	return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
    	Session::put('message', 'Kích hoạt danh mục sản phẩm thành công!');
    	return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    } 

    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();

        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);

        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $product_price;
        $data['price_cost'] = $price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
 
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message', 'Cóa sản phẩm thành công!');
        return Redirect::to('all-product'); 
    }

    // End Admin Page

    public function details_product(Request $request, $product_slug){
         $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

         $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.product_slug',$product_slug)->get();

        foreach ($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_cate = $value->category_name;
            $cate_slug = $value->slug_category_product;
            //seo 
                $meta_desc = $value->product_desc;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
                // $image_og = url('public/uploads/product/'.$value->product_image);
                //--seo
        }

        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get();

        //update views
        $product = Product::where('product_id',$product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();
        
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$product_slug])->orderby(DB::raw('RAND()'))->paginate(3);

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('gallery',$gallery)->with('product_cate',$product_cate)->with('cate_slug',$cate_slug)->with('rating',$rating);
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
