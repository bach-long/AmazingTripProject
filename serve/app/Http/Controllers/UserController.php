<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function getProfile($id){
        if($id != 0){
            $profile = User::find($id);
            if($profile){
                return response()->json(
                    [
                        'status' => 200,
                        'id' => $profile->id,
                        'username' => $profile->username,
                        'birthday' => $profile->birthday,
                        'email' => $profile->email,
                        'phone' => $profile->phone,
                        'address' => $profile->address,
                        'nickname' => $profile->nickname,
                        'role' => $profile->role
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Get profile fail'
                    ]
                );
            }
        
        }
        
    }
}
