<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function getAddress()
    {
        $address = Address::all();
        return response()->json([
            'data' => $address,
            'status' => 200,
            'message' => 'Get address successfully'
        ]);
    }
    public function postAddress(Request $req)
    {
        if($req){
            $add =  new Address();
            $add->id_host = $req->input('id_host');
            $add->address_name = $req->input('address_name');
            $add->address_description = $req->input('address_description');
            $add->address_image = $req->input('address_image');
            $add->address_map = $req->input('address_map');

            if($add->save()){
                $address = Address::all();
            
                return response()->json([
                    'data' => $address,
                    'status' => 200,
                    'message' => 'Post address successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $add,
                    'status' => 400,
                    'message' => 'Post address fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post address fail'
            ]);
        }
        
        
    }
    public function editAddress(Request $req , $id)
    {
        $item = Address::find($id);
        if($req){
            $item->id_host = $req->input('id_host');
            $item->address_name = $req->input('address_name');
            $item->address_description = $req->input('address_description');
            $item->address_image = $req->input('address_image');
            $item->address_map = $req->input('address_map');
            if($item->save()){
                
                return response()->json([
                    'data' => $item,
                    'status' => 200,
                    'message' => 'Edit address successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Edit address fail'
                ]);
            }
        }

    }
    public function deleteAddress($id)
    {
        if($id){
            if(Address::find($id)->delete()){
                $address = Address::all();
                return response()->json([
                    'data' => $address,
                    'status' => 200,
                    'message' => 'Delete address successfully'
                ]); 
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete address fail'
                ]);
            }
        }
    }

    public function getAddressByHost($id)
    {
        if($id == 1){
            $result = Address::where('id_host', $id)->get();
            if($result)
            {
                return response()->json([
                    'data' => $result,
                    'status' => 200,
                    'message' => 'Get address by id host'
                ]); 
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete address fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'You are not a host'
            ]);
        }
    }
    public function getAddressbyId($id){
        
            $address=Address::find($id);
            if(!$address){
                return response()->json([
                    'status'=>404,
                    'message'=>'no data'
                ]);
            }else{
                return response()->json([
                    'data'=>$address,
                    'status'=>200,
                    'message'=>'get address successfull'
                ]);
            }
/*

        $address=Address::all();
        if(!$address){
            return response()->json([
                'status'=>404,
                'message'=>'Not found data'
            ]);
        }else{
            return response()->json([
                'data'=>$address->id,
                'status'=>200,
                'message'=>'get address by id success'
            ]);
        }
        */
    }

        
}
