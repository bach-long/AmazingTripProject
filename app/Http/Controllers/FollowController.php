<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;

class FollowController extends Controller
{
    public function getFollow()
    {
        $follow = Follow::all();
        return response()->json([
            'data' =>  $follow,
            'status' => 200,
            'message' => 'Get follow successfully'
        ]);
    }
    public function postFollow(Request $req)
    {
        if($req){
            $foll =  new Follow();
            $foll->follow_id = $req->input('follow_id');
            $foll->follwer = $req->input('follower');
            $foll->being_follower = $req->input('being_follower');
            if($foll->save()){
                $follow = Follow::all();
                return response()->json([
                    'data' => $follow,
                    'status' => 200,
                    'message' => 'Post follow successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $foll,
                    'status' => 400,
                    'message' => 'Post follow fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post follow false'
            ]);
        }
        
        
    }
    
    public function deleteFollow($id)
    {
        if(Follow::find($id)){
            if(Follow::find($id)->delete()){
                $follow = Follow::all();
                return response()->json([
                    'data' => $follow,
                    'status' => 200,
                    'message' => 'Delete follow successfully'
                ]); 
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete follow false'
                ]);
            }
        }
    }
}
