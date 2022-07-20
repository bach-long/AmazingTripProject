<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function getGroup($address_id)
    {
        $group= Group::query()
            ->where('address_id', $address_id)
            ->get();
        return response()->json([
            'data'=>$group,
            'status'=>200,
            'message'=>'Get group successfully'
        ]);
    }

    public function showGroup($id)
    {
        $group= DB::table('Group')
            ->join('User_travel', 'Group.group_admin', '=', 'User_travel.id')
            ->join('Address', 'Group.address_id', '=', 'Address.address_id')
            ->select('Group.*',
                'User_travel.nickname',
                'User_travel.avatar',
                'Address.address_map',
            )
            ->where('Group.group_id', $id)
            ->first();

        $group_member = DB::table('Group_members')
            ->select(DB::raw('count(id_user) as number_member'))
            ->where('group_id', '=', $group->group_id)
            ->groupBy('group_id')
            ->first();

        if($group_member)
            $group->number_member = $group_member->number_member + 1;
        else
            $group->number_member = 1;

        $members = DB::table('Group_members')
            ->join('User_travel', 'Group_members.id_user', '=', 'User_travel.id')
            ->select('User_travel.id',
                'User_travel.nickname',
                'User_travel.avatar',
            )
            ->where('group_id', '=', $group->group_id)
            ->get();

        if($group) {
            return response()->json([
                'data' => $group,
                'members' => $members,
                'status' => 200,
                'message' => 'Get group successfully'
            ]);
        } else {
            return response()->json([
                'data' => $group,
                'status' => 400,
                'message' => 'Get group false'
            ]);
        }
    }

    public function joinGroup(Request $request)
    {
        $group_member= new GroupMember();
        $group_member->group_id=$request->input('group_id');
        $group_member->id_user=$request->input('id_user');

        if($group_member->save()){
            $group_member = GroupMember::query()
                ->where('group_id', $group_member->group_id)
                ->where('id_user', $group_member->id_user)
                ->orderBy('created_at', 'desc')
                ->first();
            return response()->json([
                'data'=>$group_member,
                'status'=>200,
                'message'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'false'

            ]);
        }
    }

    public function outGroup($group_id, $id_user)
    {
        $group_member = GroupMember::query()
            ->where('group_id', $group_id)
            ->where('id_user', $id_user)
            ->orderBy('created_at', 'desc')
            ->first();
        if($group_member->delete()){
            return response()->json([
                'data'=>[],
                'status'=>200,
                'message'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'false'

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