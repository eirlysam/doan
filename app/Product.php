<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'category_id','product_name', 'product_slug', 'product_desc','product_content','product_price','product_image','product_status','product_views','price_cost'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';

 	public function comment(){
 		return $this->hasMany('App\Comment');
 	}

 	public function category(){
 		return $this->belongsTo('App\CategoryProductModel','category_id');
 	}
}
