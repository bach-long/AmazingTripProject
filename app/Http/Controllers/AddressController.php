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
        echo($item);
    }

        
}
