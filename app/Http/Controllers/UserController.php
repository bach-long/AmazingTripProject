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
    public function getNumberofUsers(){
        $users = User::where('role', '2')->get();
        return  $users->count();
    }
    public function getNumberofHosts(){
        $users = User::where('role', '1')->get();
        return  $users->count();
    }

    public function getInfomationOfHosts(){
        $users = User::where('role', '1')->get();
        return  $users;
    }

    public function getInfomationOfUsers(){
        $users = User::where('role', '2')->get();
        return  $users;
    }

    public function deleteUser($id){
       if( User::find($id)->delete()){
        return 'Delete user successfully';
       }
       else {
        return 'Cannot delete this user';
       }
        
    }

    public function getUsersByDate(){
        $data = array();
        $date1 = date('Y-m-d', strtotime('-6 days'));
        $count1 = User::whereDate('created_at', $date1)->where('role', '2')->count();
        $date2 = date('Y-m-d', strtotime('-5 days'));
        $count2 = User::whereDate('created_at', $date2)->where('role', '2')->count();
        $date3 = date('Y-m-d', strtotime('-4 days'));
        $count3 = User::whereDate('created_at', $date3)->where('role', '2')->count();
        $date4 = date('Y-m-d', strtotime('-3 days'));
        $count4 = User::whereDate('created_at', $date4)->where('role', '2')->count();
        $date5 = date('Y-m-d', strtotime('-2 days'));
        $count5 = User::whereDate('created_at', $date5)->where('role', '2')->count();
        $date6 = date('Y-m-d', strtotime('-1 days'));
        $count6 = User::whereDate('created_at', $date6)->where('role', '2')->count();
        $date7 = date('Y-m-d', strtotime('-0 days'));
        $count7 = User::whereDate('created_at', $date7)->where('role', '2')->count();
       

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

    public function getHostsByDate(){
        $date1 = date('Y-m-d', strtotime('-6 days'));
        $count1 = User::whereDate('created_at', $date1)->where('role', '1')->count();
        $date2 = date('Y-m-d', strtotime('-5 days'));
        $count2 = User::whereDate('created_at', $date2)->where('role', '1')->count();
        $date3 = date('Y-m-d', strtotime('-4 days'));
        $count3 = User::whereDate('created_at', $date3)->where('role', '1')->count();
        $date4 = date('Y-m-d', strtotime('-3 days'));
        $count4 = User::whereDate('created_at', $date4)->where('role', '1')->count();
        $date5 = date('Y-m-d', strtotime('-2 days'));
        $count5 = User::whereDate('created_at', $date5)->where('role', '1')->count();
        $date6 = date('Y-m-d', strtotime('-1 days'));
        $count6 = User::whereDate('created_at', $date6)->where('role', '1')->count();
        $date7 = date('Y-m-d', strtotime('-0 days'));
        $count7 = User::whereDate('created_at', $date7)->where('role', '1')->count();
       

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
