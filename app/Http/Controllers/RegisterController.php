<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function PostRegister(Request $request){
        $newUser = new User();
        $data = $request->all();
        
        $newUser->username = $request->username;
        $newUser->password = bcrypt($request->password);
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->address =  $request->address;
        $newUser->nickname = $request->nickname;
        $newUser->birthday = $request->birthday;
        $newUser->role = $request->role;
        $avatar = $request->avatar;
        // if(!empty($avatar))
        // {
        //     //$data['avatar'] = $avatar->getClientOriginalName();
        //     //$avatar->move('upload/user/avatar',$avatar->getClientOriginalName());
        //     $newUser->avatar = $data['avatar'];
        //     if($newUser->save())
        //     {
        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'Register succesfully'
        //         ]);
        //     }else
        //     {
        //         return response()->json([
        //             'status' => 400,
        //             'message' => 'Register fail'
        //         ]);
        //     }
            
        // }else
        // {
        //     $newUser->avatar = 'null';
        //     if($newUser->save())
        //     {
        //         return response()->json([
        //             'status' => 200,
        //             'message' => 'Register succesfully'
        //         ]);
        //     }else
        //     {
        //         return response()->json([
        //             'status' => 400,
        //             'message' => 'Register fail'
        //         ]);
        //     }
        // }
        if($newUser->save()){
            return response()->json([
                'status' => 200,
                'message' => 'Register succesfully'
            ]);
        }else 
        {
            return response()->json([
                            'status' => 400,
                            'message' => 'Register fail'
                        ]);
        }
        
    }
}
