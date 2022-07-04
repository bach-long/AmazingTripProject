<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogAddress;

class BlogAddressController extends Controller
{
    public function getBlog()
    {
        $blog = BlogAddress::all();
        return response()->json([
            'data' => $blog,
            'status' => 200,
            'message' => 'Get blog successfully'
        ]);
    }

    public function showBlogAddress($id){
        $blog= BlogAddress::find($id);
        if($blog){
            return response()->json([
                'data'=>$blog,
                'status'=>200,
                'message'=>'get blog success'
            ]);
        }else{
            return response()->json([
                 'status'=>400,
                 'message'=>'get blog fail'
            ]);
        }
    }
    public function postBlog(Request $req)
    {
        if($req){
            $blo =  new BlogAddress();
            $blo->id_user = $req->input('id_user');
            $blo->address_id = $req->input('address_id');
            $blo->blog_address_vote = $req->input('blog_address_vote');
            $blo->blog_address_image = $req->input('blog_address_image');
            $blo->blog_content = $req->input('blog_content');

            // $image = $req->blog_address_image;
            // if(!empty($image))
            // {
            //     $req->blog_address_image = $image->getClientOriginalName();
            //     $image->move('upload/blog_address',$image->getClientOriginalName());
            // }else{

            // }


            if($blo->save()){
                $blog = BlogAddress::all();
            
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
                'status' => 400,
                'message' => 'Post data fail'
            ]);
        }
        
        
    }
    public function editBlog(Request $req , $id)
    {
        $item = BlogAddress::find($id);
        if($req){
            $item->id_user = $req->input('id_user');
            $item->address_id = $req->input('address_id');
            $item->blog_address_title = $req->input('blog_address_title');
            $item->blog_address_image = $req->input('blog_address_image');
            $item->blog_address_content = $req->input('blog_address_content');
            if($item->save()){
                
                return response()->json([
                    'data' => $item,
                    'status' => 200,
                    'message' => 'Edit blog address successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Edit blog address fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post data fail'
            ]);
        }

    }
    public function deleteBlog($id)
    {
        if(BlogAddress::find($id)){
            if(BlogAddress::find($id)->delete()){
                $blog = BlogAddress::all();
                return response()->json([
                    'data' => $blog,
                    'status' => 200,
                    'message' => 'Delete blog address successfully'
                ]); 
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete blog address fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Delete blog address fail'
            ]);
        }
    }
}
