<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    public function getGroup($address_id)
    {
        $group= Group::where('address_id', $address_id)->get();
        return response()->json([
            'data'=>$group,
            'status'=>200,
            'message'=>'Get group successfullly'
        ]);
    }

    public function showGroup($id)
    {
        $group= Group::where('group_id', $id)->first();
        $admin = User::where('id', $group->group_admin)->first();
        $address = Address::where('address_id', $group->address_id)->first();
        $group->admin_name = $admin->nickname;
        $group->admin_image = $admin->avatar;
        $group->address = $address->address_map;
        if($group) {
            return response()->json([
                'data' => $group,
                'status' => 200,
                'message' => 'Get group successfullly'
            ]);
        } else {
            return response()->json([
                'data' => $group,
                'status' => 400,
                'message' => 'Get group false'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postGroup(Request $request)
    {
         if($request){
            $Group= new Group();
            $Group->group_name=$request->input('group_name');
            $Group->group_image=$request->input('group_image');
            $Group->address_id=$request->input('address_id');
            $Group->group_admin= $request->input('group_admin');
            //$Group->group_member=$request->input('group_member');
            if($Group->save()){
                $group = Group::orderBy('created_at', 'desc')->first();
                return response()->json([
                    'data'=>$group,
                    'status'=>200,
                    'message'=>'success'
                ]);
            }else{
                return response()->json([
                    'status'=>400,
                    'message'=>'false'

                ]);
            }
         }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post group fail'
            ]);
         }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editGroup(Request $request,$id)
    {
        $group= Group::find($id);
        if($request){
            $group->group_name=$request->input('group_name');
            $group->group_image=$request->input('group_image');
            //$group->address_id=$request->input('address_id');
           // $group->group_admin= $request->input('group_admin');
            $group->group_member=$request->input('group_member');
            if($group->save()){

                return response()->json([
                   'data'=>$group,
                   'status'=>200,
                   'message'=>'Update group successfullly'
                ]);
            }else{
                return response()->json([
                    'status'=>400,
                    'message'=>'Update group false'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */

    public function destroyGroup($id){
         if(Group::find($id)->delete()){
            $group= Group::all();
            return response()->jison([
                'data'=>$group,
                'status'=>200,
                'message'=>'Delete group successfull'
                ]);

         }else{
            return response()->json([
                'status'=>400,
                'message'=>'Delete group false'
                ]);

         }

    }
}
