<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\BlogAddress;

class BlogAddressController extends Controller
{
    public function getBlogForAddress($address_id) {
        $blogs = BlogAddress::where('address_id', $address_id)->get();
        if($blogs){
            return response()->json([
                'data'=>$blogs,
                'status'=>200,
                'message'=>'blog for this address'
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'doesnt exist'
            ]);
        }
    }

    public function getBlog()
    {
        $blog = BlogAddress::all();
        return response()->json([
            'data' => $blog,
            'status' => 200,
            'message' => 'Get blog successfully'
        ]);
    }
    public function postBlog(Request $req)
    {
        if($req){
            $blo =  new BlogAddress();
            $blo->id_user = $req->input('id_user');
            $blo->address_id = $req->input('address_id');
            $blo->blog_address_title = $req->input('blog_address_title');
            $blo->blog_address_image = $req->input('blog_address_image');
            $blo->blog_content = $req->input('blog_content');


            $image = $req->blog_address_image;
            if(!empty($image))
            {
                $req->blog_address_image = $image->getClientOriginalName();
                $image->move('upload/blog_address',$image->getClientOriginalName());
            }else{
                $blo->blog_address_image = 'default.jpg';
            }


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
