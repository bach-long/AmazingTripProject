<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function getGroup()
    {
        $group= Group::all();
        return response()->json([
            'data'=>$group,
            'status'=>200,
            'message'=>'Get group successfullly'
        ]);
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

            if($Group->save()){
                return response()->json([ 
                    'data'=>$Group,
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
