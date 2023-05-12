<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialCustomers extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'provider_user_id','provider','user'
    ];
    protected $primaryKey = 'user_id';
 	protected $table = 'tbl_social_customer';

 	public function customer(){
 		return $this->belongsTo('App\Customer','user');
 	}
}
