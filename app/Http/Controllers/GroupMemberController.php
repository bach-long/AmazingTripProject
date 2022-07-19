<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\GroupMember;

class GroupMemberController extends Controller
{
    //
    public function joinGroup($id_user, $group_id){
        $join = new GroupMember();
        $join->id_user=$id_user;
        $join->group_id = $group_id;
        if($join->save()){
            return response()->json([
                'data'=> $join,
                'status'=> 200,
                'message'=> 'joined group'
            ]);
        }
    }
    public function getGroupForUser($id_user) {
        $tempt = GroupMember::where('id_user', $id_user)->get();
        $groups=[];
        if($tempt){
            foreach($tempt as $item){
                array_push($groups, Group::find($item->group_id));
            }            
        }
        return response()->json([
            'data'=>$groups,
            'status'=>200,
            'messsage'=>'groups for user'
        ]);
    }

    public function outGroup($id_user, $group_id){
        $out = GroupMember::where('id_user', $id_user)->where('group_id', $group_id)->first();
        $out->delete();
        return response()->json([
            'status'=>200,
            'message'=>'out group'
        ]);
    }

    public function getMemberOfGroup($group_id){
        $tempt = GroupMember::where('group_id', $group_id)->get();
        $members=[];
        if($tempt){
            foreach($tempt as $item){
                array_push($members, User::find($item->id_user));
            }            
        }
        return response()->json([
            'data'=>$members,
            'status'=>200,
            'messsage'=>'members of a group'
        ]);
    }
}
