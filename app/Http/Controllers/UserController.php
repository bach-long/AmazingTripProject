<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BlogAddress;
use App\Models\Bookmark;
use App\Models\CommentBlogAddress;
use App\Models\Follow;
use App\Models\ReactionBlogAddress;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function getProfile($user_id, $current_user_id){
        if($user_id != 0){
            $profile = User::find($user_id);
            $follow = Follow::where('follower',$current_user_id)->where('being_follower',$user_id)->first();
//            $list_follow = [];
//            if(!empty($follow[0]->being_follower))
//            {
//                $a = explode(',', $follow[0]->being_follower);
//                foreach($a as $i)
//                {
//                    $user = User::find($i);
//                    array_push($list_follow, $user);
//
//                }
//            }
            $blog = BlogAddress::join('address','address.address_id','=','blog_address.address_id')
                ->where('id_user',$user_id)
                ->orderBy('blog_address.created_at', 'desc')
                ->get();
            foreach($blog as $i) {
                $i->commentCount = CommentBlogAddress::where('blog_address_id', $i->blog_address_id)->count();
                $i->likeCount = ReactionBlogAddress::where('blog_address_id', $i->blog_address_id)->where('reaction', 1)->count();
                $i->dislikeCount = ReactionBlogAddress::where('blog_address_id', $i->blog_address_id)->where('reaction', 0)->count();
            }
            if($profile){
                return response()->json(
                    [
                        'status' => 200,
                        'data'=>$profile,
                        'follow'=>$follow,
                        'blog'=>$blog
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Get profile fail'
                    ]
                );
            }
        }
    }


    public function getUserData($user_id){
        if($user_id != 0){
            $user = User::find($user_id);
            $bookmark = Bookmark::where('id_user', $user_id)->get();
            if($bookmark)
            {
                foreach($bookmark as $each)
                {
                    $inf = Address::where('address_id', $each->address_id)->first();
                    $each->address_name = $inf->address_name;
                }
            }
            $follow = Follow::where('follower',$user_id)->where('follow_status', '=', '1')->get();
            if($follow)
            {
                foreach($follow as $follower)
                {
                    $inf = User::select('nickname', 'avatar')->where('id', $follower->being_follower)->first();
                    $follower->nickname = $inf->nickname;
                    $follower->avatar = $inf->avatar;
                }
            }
            if($user){
                return response()->json(
                    [
                        'bookmark'=>$bookmark,
                        'follow'=>$follow,
                        'status' => 200,
                        'message' => 'Get profile successfully'
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Get profile fail'
                    ]
                );
            }
        }
    }
}
