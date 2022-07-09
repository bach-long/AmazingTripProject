<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\CommentBlog;
use App\Models\ReactionBlog;
use App\Models\User;

class BlogController extends Controller
{
    public function getBlog($group_id)
    {
        $blog = Blog::where('address_id', $group_id)->get();
        foreach($blog as $i){
            $user = User::where('id', $i->id_user)->first();
            $i->nickname=$user->nickname;
            $i->avatar=$user->avatar;
            $i->commentCount = CommentBlog::where('blog_address_id', $i->blog_address_id)->count();
            $i->likeCount = ReactionBlog::where('blog_address_id', $i->blog_address_id)->where('reaction', 1)->count();
            $i->dislikeCount=ReactionBlog::where('blog_address_id', $i->blog_address_id)->where('reaction', 0)->count();
        }
            return response()->json([
                'data' => $blog,
                'status' => 200,
                'message' => 'Get blog successfully'
            ]);
    }
    public function postBlog(Request $req)
    {
        if($req){
            $blo =  new Blog();
            $blo->id_user = $req->input('id_user');
            $blo->address_id = $req->input('address_id');
            $blo->blog_address_title = $req->input('blog_address_title');
            $blo->blog_address_image = $req->input('blog_address_image');
            $blo->blog_address_content = $req->input('blog_address_content');


            $image = $req->blog_address_image;
            if(!empty($image))
            {
                $req->blog_address_image = $image->getClientOriginalName();
                $image->move('upload/blog_address',$image->getClientOriginalName());
            }else{
                $blo->blog_address_image = 'default.jpg';
            }


            if($blo->save()){
                $blog = Blog::where('address_id', $req->address_id)->get();
                foreach($blog as $i){
                    $user = User::where('id', $i->id_user)->first();
                    $i->nickname=$user->nickname;
                    $i->avatar=$user->avatar;
                    $i->commentCount = CommentBlog::where('blog_address_id', $i->blog_address_id)->count();
                    $i->likeCount = ReactionBlog::where('blog_address_id', $i->blog_address_id)->where('reaction', 1)->count();
                    $i->dislikeCount=ReactionBlog::where('blog_address_id', $i->blog_address_id)->where('reaction', 0)->count();
                }
                return response()->json([
                    'data' => $blog,
                    'status' => 200,
                    'message' => 'Post blog address successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $blo,
                    'status' => 400,
                    'message' => 'Post blog address fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Post data fail'
            ]);
        }
    }
    public function editBlog(Request $req , $id)
    {
        $item = Blog::find($id);
        if($req){
            $item->id_user = $req->input('id_user');
            $item->group_id = $req->input('group_id');
            $item->blog_title = $req->input('blog_title');
            $item->blog_image = $req->input('blog_image');
            $item->blog_content = $req->input('blog_content');
            if($item->save()){

                return response()->json([
                    'data' => $item,
                    'status' => 200,
                    'message' => 'Edit blog successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Edit blog fail'
                ]);
            }
        }

    }
    public function deleteBlog($id)
    {
        if(Blog::find($id)){
            if(Blog::find($id)->delete()){
                $blog = Blog::all();
                return response()->json([
                    'data' => $blog,
                    'status' => 200,
                    'message' => 'Delete blog successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete blog fail'
                ]);
            }
        }
    }
}
