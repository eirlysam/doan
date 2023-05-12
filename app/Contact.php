<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'info_contact', 'info_map', 'info_logo', 'slogan_logo'
    ];
    protected $primaryKey = 'info_id';
 	protected $table = 'tbl_infomation';
}
