<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Address;
class BookmarkController extends Controller
{
    /*
    public function getBookmark()
    {
        $bookmark = Bookmark::all();
        return response()->json([
            'data' =>  $bookmark,
            'status' => 200,
            'message' => 'Get address successfully'
        ]);
    }
    */

    public function getBookmarkById_User($id_user){
       //$bookmark = Bookmark::where('id_user',$id_user)->paginate(6);
        $bookmarks = Bookmark::where('id_user',$id_user)->orderBy('created_at')->get();
       
        if($bookmarks){
            // if have some saved address
            foreach($bookmarks as $bookmark){
                $address=Address::where('address_id',$bookmark->address_id)->get();
            }
            return response()->json([
              // 'data'=> Address::where('address_id',each($bookmark)->address_id)->get()->paginate(6),
              // 'type'=>$type,
                 'data'=>$address,
                 'status'=>200,
                 'message'=>'get bookmark by id_user oke'
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'get bookmark by id_user oke'
           ]);
        }
    }
    public function postBookmark(Request $req)
    {
        if($req){
            $book =  new Bookmark();
            $book->id_user = $req->input('id_user');
            $book->address_id = $req->input('address_id');
            if($book->save()){
                $bookmark = Bookmark::all();
                return response()->json([
                    'data' => $bookmark,
                    'status' => 200,
                    'message' => 'Post bookmark successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $book,
                    'status' => 400,
                    'message' => 'Post bookmark fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Post bookmark fail'
            ]);
        }
    }
    
    public function deleteBookmarkbyAddress_id($address_id)
    {
        $bookmark= Bookmark::where('address_id',$address_id)->get();
        if($bookmark){
            if($bookmark->delete()){        
                return response()->json([
                    //'data' => $bookmark,
                    'status' => 200,
                    'message' => 'Delete bookmark successfully'
                ]);
              
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete bookmark fail'
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Not found'
            ]);
        }
    }
}
