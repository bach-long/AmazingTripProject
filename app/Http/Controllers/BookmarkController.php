<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function getBookmark($id_user)
    {
        $bookmark = Bookmark::where('id_user', $id_user)->get();
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
            $book->address_id = $req->input('address_id');
            $book->id_user = $req->input('id_user');
            if($book->save()){
                return response()->json([
                    'data' => 1, //1 for +, 0 for -
                    'status' => 200,
                    'message' => 'Bookmark successfully'
                ]);
            }else{
                return response()->json([
                    'data' => 0,
                    'status' => 400,
                    'message' => 'Bookmark failed'
                ]);
            }
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'doesnt exist'
            ]);
        }
    }
    
    public function deleteBookmark(Request $req)
    {
        $bookmark = Bookmark::where('id_user', $req->id_user)->where('address_id', $req->address_id)->first();
        if($bookmark){
            if($bookmark->delete()){
                $data = Bookmark::where('id_user', $req->id_user)->get();
                return response()->json([
                    'data' => $data,
                    'status' => 200,
                    'message' => 'Delete bookmark successfully'
                ]); 
            }else{
                return response()->json([
                    'data'=> Bookmark::where('id_user', $req->id_user)->get(),
                    'status' => 400,
                    'message' => 'Delete bookmark fail'
                ]);
            }
        } else {
            return response()->json([
                'data'=>Bookmark::where('id_user', $req->id_user)->get(),
                'status' => 404,
                'message' => 'doesnt exist'
            ]);
        }
    }
}
