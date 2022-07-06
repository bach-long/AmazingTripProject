<?php

namespace App\Http\Controllers;

use App\Models\ReactionBlog;
use Illuminate\Http\Request;

class BlogReactionController extends Controller
{
    //
    public function reactionUpdate(Request $request){
        $react = ReactionBlog::where('blog_id', $request->blog_id)->where('id_user', $request->id_user)->first();
        if($react) {
            $react->reaction = $request->reaction;
            $react->save();
            return response()->json([
                'data'=> ReactionBlog::all(),
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
                'data'=> ReactionBlog::all(),
                'status'=>200,
                'message'=>'reacted'
            ]);
        }
    }
}
