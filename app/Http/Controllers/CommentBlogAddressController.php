<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentBlogAddress;

class CommentBlogAddressController extends Controller
{
    //
    public function getAllCommentBlog ($blog_id){
        return response()->json([
            'data'=> CommentBlogAddress::where('blog_id', $blog_id)->get(),
            'status'=>200,
            'message'=>'all comments'
        ]);
    }

    public function createCommentBlog(Request $request){
        $comment = new CommentBlogAddress();
        $comment->blog_id=$request->blog_id;
        $comment->id_user=$request->id_user;
        $comment->bomment_blog_content= $request->comment_blog_content;
        if($comment->save()){
            return response()->json([
                'data'=> CommentBlogAddress::all(),
                'status'=>200,
                'message'=>'comment success'
            ]);
        } else {
            return response()->json([
                'data'=> CommentBlogAddress::all(),
                'status'=>400,
                'message'=>'comment failed'
            ]);
        }
    }

    public function editCommentBlog(Request $request){
        $comment = CommentBlogAddress::find($request->comment_blog_id);
        if($comment){
            $comment->comment_blog_content = $request->comment_blog_content;
            if($comment->save()){
                return response()->json([
                    'data'=> CommentBlogAddress::all(),
                    'status'=>200,
                    'message'=>'comment edited'
                ]);
            } else {
                return response()->json([
                    'data'=> CommentBlogAddress::all(),
                    'status'=>400,
                    'message'=>'edit failed'
                ]);
            }
        } else {
            return response()->json([
                'data'=> CommentBlogAddress::all(),
                'status'=>404,
                'message'=>'doesnt exist'
            ]);
        } 
    }

    public function deleteCommentBlog($comment_blog_id) {
        $comment = CommentBlogAddress::find($comment_blog_id);
        if($comment){
            if($comment->delete()){
                return response()->json([
                    'data'=> CommentBlogAddress::all(),
                    'status'=>200,
                    'message'=>'deleted'
                ]);
            } else {
                return response()->json([
                    'data'=> CommentBlogAddress::all(),
                    'status'=>400,
                    'message'=>'cant delete'
                ]);
            }
        } else {
            return response()->json([
                'data'=> CommentBlogAddress::all(),
                'status'=>404,
                'message'=>'doesnt exist'
            ]);
        }
    }
}
