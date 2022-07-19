<?php

namespace App\Http\Controllers;

use App\Models\BlogAddress;
use App\Models\CommentBlogAddress;
use App\Models\Follow;
use App\Models\ReactionBlogAddress;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function getProfile($id){
        if($id != 0){
            $profile = User::find($id);
            $follow = Follow::where('follower',$id)->get();
            $list_follow = [];
            if(!empty($follow[0]->being_follower))
            {
                $a = explode(',', $follow[0]->being_follower);
                foreach($a as $i)
                {
                    $user = User::find($i);
                    array_push($list_follow, $user);
                }
            }
            $blog = BlogAddress::join('address','address.address_id','=','blog_address.address_id')
                ->where('id_user',$id)
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
                        'follow'=>$list_follow,
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
}
