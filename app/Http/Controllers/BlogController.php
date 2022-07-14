<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogAddress;
class BlogController extends Controller
{
    public function getBlog()
    {
        $blog = Blog::all();
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
            $blo->group_id = $req->input('group_id');
            $blo->blog_title = $req->input('blog_title');
            $blo->blog_image = $req->input('blog_image');
            $blo->blog_content = $req->input('blog_content');

            if($blo->save()){
                $blog = Blog::all();
            
                return response()->json([
                    'data' => $blog,
                    'status' => 200,
                    'message' => 'Post blog successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $blo,
                    'status' => 400,
                    'message' => 'Post blog fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post blog false'
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
