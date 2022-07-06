<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentBlogAddress;

class CommentBlogAddressController extends Controller
{
    //
    public function getAllCommentBlog ($blog_address_id){
        return response()->json([
            'data'=> CommentBlogAddress::where('blog_address_id', $blog_address_id)->get(),
            'status'=>200,
            'message'=>'all comments'
        ]);
    }

    public function createCommentBlog(Request $request){
        $comment = new CommentBlogAddress();
        $comment->blog_address_id=$request->blog_address_id;
        $comment->id_user=$request->id_user;
        $comment->comment_address_content= $request->comment_address_content;
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
            $comment->comment_address_content = $request->comment_address_content;
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
        $comment = CommentBlogAddress::where('comment_blog_id', $comment_blog_id);
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
