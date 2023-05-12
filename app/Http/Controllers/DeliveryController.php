<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\Province;
use App\Wards;

class DeliveryController extends Controller
{
    public function delivery(Request $request){

        $city = City::orderby('matp','ASC')->get();

        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if(isset($data['action']) && isset($data['ma_id'])){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
        else {
        // Trường dữ liệu không đầy đủ, không thực hiện xử lý
        echo 'Invalid data';
        }
        
    } 
}
