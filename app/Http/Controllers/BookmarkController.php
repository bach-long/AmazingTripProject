<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function getBookmark()
    {
        $bookmark = Bookmark::all();
        return response()->json([
            'data' =>  $bookmark,
            'status' => 200,
            'message' => 'Get address successfully'
        ]);
    }
    public function postBookmark(Request $req)
    {
        if($req){
            $book =  new Bookmark();
            $book->bookmark_id = $req->input('bookmark_id');
            $book->address_id = $req->input('address_id');
            $book->id_user = $req->input('id_user');
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
                'status' => 400,
                'message' => 'Post bookmark fail'
            ]);
        }
        
        
    }
    
    public function deleteBookmark($id)
    {
        if(Bookmark::find($id)){
            if(Bookmark::find($id)->delete()){
                $bookmark = Bookmark::all();
                return response()->json([
                    'data' => $bookmark,
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
    }
}
