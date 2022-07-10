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
    public function NumberofGroups()
    {
        $group= Group::all();
        return $group->count(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postGroup(Request $request)
    {
         if($request){
            $Group= new Group;
            $Group->group_name=$request->input('group_name');
            $Group->group_image=$request->input('group_image');
            $Group->address_id=$request->input('address_id');
            $Group->group_admin= $request->input('group_admin');
            $Group->group_member=$request->input('group_member');

            if($Group->save()){
                $group = Group::all();
                return response()->json([ 
                    'data'=>$group,
                    'status'=>200,
                    'message'=>'success'
                ]);
                
            }else{
                return response()->json([
                    'data'=>$Group,
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

    public function GroupsByDate(){
        $date1 = date('Y-m-d', strtotime('-6 days'));
        $count1 = Group::whereDate('created_at', $date1)->count();
        $date2 = date('Y-m-d', strtotime('-5 days'));
        $count2 = Group::whereDate('created_at', $date2)->count();
        $date3 = date('Y-m-d', strtotime('-4 days'));
        $count3 = Group::whereDate('created_at', $date3)->count();
        $date4 = date('Y-m-d', strtotime('-3 days'));
        $count4 = Group::whereDate('created_at', $date4)->count();
        $date5 = date('Y-m-d', strtotime('-2 days'));
        $count5 = Group::whereDate('created_at', $date5)->count();
        $date6 = date('Y-m-d', strtotime('-1 days'));
        $count6 = Group::whereDate('created_at', $date6)->count();
        $date7 = date('Y-m-d', strtotime('-0 days'));
        $count7 = Group::whereDate('created_at', $date7)->count();
       

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
