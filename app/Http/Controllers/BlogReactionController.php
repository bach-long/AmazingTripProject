<?php

namespace App\Http\Controllers;

use App\Models\ReactionBlog;
use Illuminate\Http\Request;
use App\Models\ReactionBlogAdress;

class BlogReactionController extends Controller
{
    //
    public function reactionBlogUpdate(Request $request){
        $react = ReactionBlog::where('blog_id', $request->blog_id)->where('id_user', $request->id_user)->first();
        if($react) {
            $react->reaction = $request->reaction;
            $react->save();
            return response()->json([
                'data'=> ReactionBlog::where('blog_id', $request->blog_id)->get(),
                'likeCount'=>ReactionBlog::where('blog_id', $request->blog_id)->where('reaction', 1)->count(),
                'dislikeCount'=>ReactionBlog::where('blog_id', $request->blog_id)->where('reaction', 0)->count(),
                'status'=>200,
                'message'=>'reacted'
            ]);
        } else {
            $react = new ReactionBlog();
            $react->blog_id = $request->blog_id;
            $react->id_user = $request->id_user;
            $react->reaction = $request->reaction;
            $react->save();
            return response()->json([
                'data'=> ReactionBlog::where('blog_id', $request->blog_id)->get(),
                'likeCount'=>ReactionBlog::where('blog_id', $request->blog_id)->where('reaction', 1)->count(),
                'dislikeCount'=>ReactionBlog::where('blog_id', $request->blog_id)->where('reaction', 0)->count(),
                'status'=>200,
                'message'=>'reacted'
            ]);
        }
    }
    public function reactionBlogAddressUpdate(Request $request){
        $react = ReactionBlogAdress::where('blog_id', $request->blog_id)->where('id_user', $request->id_user)->first();
        if($react) {
            $react->reaction = $request->reaction;
            $react->save();
            return response()->json([
                'data'=> ReactionBlogAdress::where('blog_id', $request->blog_id)->get(),
                'likeCount'=>ReactionBlogAdress::where('blog_id', $request->blog_id)->where('reaction', 1)->count(),
                'dislikeCount'=>ReactionBlogAdress::where('blog_id', $request->blog_id)->where('reaction', 0)->count(),
                'status'=>200,
                'message'=>'reacted'
            ]);
        } else {
            $react = new ReactionBlogAdress();
            $react->blog_id = $request->blog_id;
            $react->id_user = $request->id_user;
            $react->reaction = $request->reaction;
            $react->save();
            return response()->json([
                'data'=> ReactionBlogAdress::where('blog_id', $request->blog_id)->get(),
                'likeCount'=>ReactionBlogAdress::where('blog_id', $request->blog_id)->where('reaction', 1)->count(),
                'dislikeCount'=>ReactionBlogAdress::where('blog_id', $request->blog_id)->where('reaction', 0)->count(),
                'status'=>200,
                'message'=>'reacted'
            ]);
        }
    }
}
