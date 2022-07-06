<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\CommentBlog;

class CommentBlogController extends Controller
{
    //
    public function getAllCommentBlog ($blog_id){
        return response()->json([
            'data'=> CommentBlog::where('blog_id', $blog_id)->get(),
            'status'=>200,
            'message'=>'all comments'
        ]);
    }

    public function createCommentBlog(Request $request){
        $comment = new CommentBlog();
        $comment->blog_id=$request->blog_id;
        $comment->id_user=$request->id_user;
        $comment->comment_blog_content= $request->comment_blog_content;
        if($comment->save()){
            return response()->json([
                'data'=> CommentBlog::all(),
                'status'=>200,
                'message'=>'comment success'
            ]);
        } else {
            return response()->json([
                'data'=> CommentBlog::all(),
                'status'=>400,
                'message'=>'comment failed'
            ]);
        }
    }

    public function editCommentBlog(Request $request){
        $comment = CommentBlog::find($request->comment_address_id);
        if($comment){
            $comment->comment_address_content = $request->comment_address_content;
            if($comment->save()){
                return response()->json([
                    'data'=> CommentBlog::all(),
                    'status'=>200,
                    'message'=>'comment edited'
                ]);
            } else {
                return response()->json([
                    'data'=> CommentBlog::all(),
                    'status'=>400,
                    'message'=>'edit failed'
                ]);
            }
        } else {
            return response()->json([
                'data'=> CommentBlog::all(),
                'status'=>404,
                'message'=>'doesnt exist'
            ]);
        }
    }

    public function deleteCommentBlog($comment_blog_id) {
        $comment = CommentBlog::find($comment_blog_id);
        if($comment){
            if($comment->delete()){
                return response()->json([
                    'data'=> CommentBlog::all(),
                    'status'=>200,
                    'message'=>'deleted'
                ]);
            } else {
                return response()->json([
                    'data'=> CommentBlog::all(),
                    'status'=>400,
                    'message'=>'cant delete'
                ]);
            }
        } else {
            return response()->json([
                'data'=> CommentBlog::all(),
                'status'=>404,
                'message'=>'doesnt exist'
            ]);
        }
    }
}
