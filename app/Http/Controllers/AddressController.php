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
    public function getNumberofAddress()
    {
        $address = Address::all();
        return $address->count();
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


    public function getEachAddress(Request $req , $id)
    {
        $item = Address::find($id);
        if($req){
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
    public function AddressesByDate(){
        $date1 = date('Y-m-d', strtotime('-6 days'));
        $count1 = Address::whereDate('created_at', $date1)->count();
        $date2 = date('Y-m-d', strtotime('-5 days'));
        $count2 = Address::whereDate('created_at', $date2)->count();
        $date3 = date('Y-m-d', strtotime('-4 days'));
        $count3 = Address::whereDate('created_at', $date3)->count();
        $date4 = date('Y-m-d', strtotime('-3 days'));
        $count4 = Address::whereDate('created_at', $date4)->count();
        $date5 = date('Y-m-d', strtotime('-2 days'));
        $count5 = Address::whereDate('created_at', $date5)->count();
        $date6 = date('Y-m-d', strtotime('-1 days'));
        $count6 = Address::whereDate('created_at', $date6)->count();
        $date7 = date('Y-m-d', strtotime('-0 days'));
        $count7 = Address::whereDate('created_at', $date7)->count();
       

        // $dateExact = substr($date, 0, 10);
        return response()->json([
            'date1' => $date1,
            'count1' => $count1,
            'date2' => $date2,
            'count2' => $count2,
            'date3' => $date3,
            'count3' => $count3,
            'date4' => $date4,
            'count4' => $count4,
            'date5' => $date5,
            'count5' => $count5,
            'date6' => $date6,
            'count6' => $count6,
            'date7' => $date7,
            'count7' => $count7,
        ]);


    }


}
