<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\FormRegister;
use App\Models\Discount;
class UserController extends Controller
{
    public function getProfile($id){
        if($id != 0){
            $profile = User::find($id);
            if($profile){
                return response()->json(
                    [
                        'status' => 200,
                        'id' => $profile->id,
                        'username' => $profile->username,
                        'birthday' => $profile->birthday,
                        'email' => $profile->email,
                        'phone' => $profile->phone,
                        'address' => $profile->address,
                        'nickname' => $profile->nickname,
                        'role' => $profile->role
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Get profile fail'
                    ]
                );
            }
        
        }
        
    }

    public function getHostInfo(){
        $hosts=User::where('role','=',1)->get();
        $datas=[];
        $i=0;
        if($hosts){
            foreach($hosts as $host){
                $num_of_address=Address::where('id_host',$host->id)->count();

                $addresses=Address::where('id_host',$host->id)->get();
                $num_of_customer=0;
                foreach($addresses as $address){
                    $discounts=Discount::where('address_id','=',$address->address_id)->get();
                    foreach($discounts as $discount){
                        $num_of_customer+= $discount->number_registed;
                    }
                }
                $data=[
                    'name' => $host->username,
                    'phone'=>$host->phone,
                    'email'=>$host->email,
                    'created at'=> $host->created_at,
                    'number of address'=>$num_of_address,
                    'number of customer'=>$num_of_customer
                ];
                $datas[$i]=$data;
                $i++;
            }
                return response()->json([
                     'data'=>$datas,
                     'status'=>200,
                     'message'=>'get host information successfully'
                ]);
            
           
        } else{
            return response()->json([
                'status'=>400,
                'message'=>'no host had found'
            ]);
        }           

    }
}
