<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BlogAddress;
use App\Models\Bookmark;
use App\Models\CommentBlogAddress;
use App\Models\Follow;
use App\Models\GroupMember;
use App\Models\ReactionBlogAddress;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getProfile($user_id, $current_user_id)
    {
        if ($user_id != 0) {
            $profile = User::query()
                ->select('user_travel.id',
                    'user_travel.nickname',
                    'user_travel.avatar',
                    'user_travel.birthday',
                    'user_travel.address',
                    'user_travel.created_at',
                )
                ->where('user_travel.id', '=', $user_id)
                ->first();
            $follow = Follow::query()
                ->select('follow_status')
                ->where('follower', '=', $current_user_id)
                ->where('being_follower', '=', $user_id)
                ->where('follow_status', '=', '1')
                ->first();
            if($follow)
                $profile->follow_status = $follow->follow_status;
            else
                $profile->follow_status = null;
            $blog = BlogAddress::query()
                ->join('address', 'blog_address.address_id', '=', 'address.address_id')
                ->join('user_travel', 'blog_address.id_user', '=', 'user_travel.id')
                ->select('blog_address.blog_address_id',
                    'blog_address.blog_address_vote',
                    'blog_address.blog_address_image',
                    'blog_address.blog_address_content',
                    'blog_address.created_at',
                    'address.address_name',
                    'address.address_id',
                    'user_travel.id',
                    'user_travel.avatar',
                    'user_travel.nickname'
                )
                ->where('blog_address.id_user', '=', $user_id)
                ->orderBy('blog_address.created_at', 'desc')
                ->get();
            foreach ($blog as $i) {
                $i->commentCount = CommentBlogAddress::query()->where('blog_address_id', $i->blog_address_id)->count();
                $i->likeCount = ReactionBlogAddress::query()->where('blog_address_id', $i->blog_address_id)->where('reaction', 1)->count();
                $i->dislikeCount = ReactionBlogAddress::query()->where('blog_address_id', $i->blog_address_id)->where('reaction', 0)->count();
            }
            if ($profile) {
                return response()->json(
                    [
                        'status' => 200,
                        'data' => $profile,
                        'blog' => $blog
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Get profile fail'
                    ]
                );
            }
        }
    }


    public function getUserData($user_id)
    {
        if ($user_id != 0) {
            $bookmark = Bookmark::query()
                ->join('address', 'bookmark.address_id', '=', 'address.address_id')
                ->select('address.address_id', 'address.address_name')
                ->where('id_user', $user_id)
                ->get();

            $follow = Follow::query()
                ->join('user_travel', 'follow.being_follower', '=', 'user_travel.id')
                ->select('user_travel.id', 'user_travel.nickname', 'user_travel.avatar')
                ->where('follower', '=', $user_id)
                ->where('follow_status', '=', '1')
                ->get();

            $group = GroupMember::query()
                ->join('group', 'group_members.group_id', '=', 'group.group_id')
                ->select('group.group_name', 'group_members.group_id')
                ->where('group_members.id_user', '=', $user_id)
                ->orderBy('group_members.created_at', 'desc')
                ->get();

            return response()->json(
                [
                    'bookmark' => $bookmark,
                    'follow' => $follow,
                    'group' => $group,
                    'status' => 200,
                    'message' => 'Get profile successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Get profile fail'
                ]
            );
        }
    }
}
