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
            $follow = Follow::where('follower', $req->follower)->where('being_follower', $req->being_follower)->orderBy('created_at', 'desc')->first();
            if($follow)
            {
                $follow->follow_status = $req->follow_status;
                $follow->save();
                return response()->json([
                    'data' => $follow,
                    'status' => 200,
                    'message' => 'Follow successfully'
                ]);
            } else {
                $follow =  new Follow();
                $follow->follwer = $req->input('follower');
                $follow->being_follower = $req->input('being_follower');
                $follow->follow_status = $req->input('follow_status');
                if($follow->save()){
                    $follow = Follow::all();
                    return response()->json([
                        'data' => $follow,
                        'status' => 200,
                        'message' => 'Post follow successfully'
                    ]);
                }else{
                    return response()->json([
                        'data' => $follow,
                        'status' => 400,
                        'message' => 'Post follow fail'
                    ]);
                }
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
