<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BlogAddress;
use App\Models\FormRegister;
use App\Models\User;

class AddressController extends Controller
{
    public function getAddress()
    {
        $address = Address::all();
        foreach($address as $i){
            $user = User::where('id', $i->id_host)->first();
            $i->nickname=$user->nickname;
            $i->avatar=$user->avatar;
            $i->blogCount=BlogAddress::where('address_id', $i->address_id)->first();
           // $i->formCount=FormRegister::where('address_id', $i->address_id)->first();
        }
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
                $address = Address::where('id_host', $req->id_host)->get();
                foreach($address as $i){
                    $user = User::where('id', $i->id_host)->first();
                    $i->nickname=$user->nickname;
                    $i->avatar=$user->avatar;
                    $i->blogCount=BlogAddress::where('address_id', $i->address_id)->first();
                    $i->formCount=FormRegister::where('address_id', $i->address_id)->first();
                }
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


    public function getEachAddress(Request $req , $id)
    {
        $item = Address::find($id);
        if($req){
            $user = User::where('id', $item->id_host)->first();
                    $item->nickname=$user->nickname;
                    $item->avatar=$user->avatar;
                    $item->blogCount=BlogAddress::where('address_id', $item->address_id)->first();
                    //$item->formCount=FormRegister::where('address_id', $item->address_id)->first();
            return response()->json([
                'data' => $item,
                'status' => 200,
                'message' => 'Founded address successfully'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Address not found'
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
    public function deleteAddress($req)
    {
        if($req){
            if(Address::find($req->id)->delete()){
                $address = Address::where('id_host', $req->id_host)->get();
                foreach($address as $i){
                    $user = User::where('id', $i->id_host)->first();
                    $i->nickname=$user->nickname;
                    $i->avatar=$user->avatar;
                    $i->blogCount=BlogAddress::where('address_id', $i->address_id)->first();
                    $i->formCount=FormRegister::where('address_id', $i->address_id)->first();
                }
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
            $user = User::where('id', $result->id_host)->first();
            $result->nickname=$user->nickname;
            $result->avatar=$user->avatar;
            $result->blogCount=BlogAddress::where('address_id', $result->address_id)->first();
            $result->formCount=FormRegister::where('address_id', $result->address_id)->first();
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

}
