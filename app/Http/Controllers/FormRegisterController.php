<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormRegister;

class FormRegisterController extends Controller
{
    public function getFormRegister()
    {
        $form = FormRegister::all();
        return response()->json([
            'data' =>  $form,
            'status' => 200,
            'message' => 'Get follow successfully'
        ]);
    }
    public function postFormRegister(Request $req)
    {
        if($req){
            $form =  new FormRegister();
            $form->discount_id = $req->input('discount_id');
            $form->id_user = $req->input('id_user');
            $form->quantity_registed = $req->input('quantity_registed');
            if($form->save()){
                $data = FormRegister::all();
                return response()->json([
                    'data' => $data,
                    'status' => 200,
                    'message' => 'Post Form Register successfully'
                ]);
            }else{
                return response()->json([
                    'data' => $form,
                    'status' => 400,
                    'message' => 'Post Form Register fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Data false'
            ]);
        }
    }

    public function editFormRegister(Request $req , $id)
    {
        $item = FormRegister::find($id);
        if($req){
            $item->quantity_registed = $req->input('quantity_registed');
            if($item->save()){
                
                return response()->json([
                    'data' => $item,
                    'status' => 200,
                    'message' => 'Edit Form Register successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Edit Form Register fail'
                ]);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Data false'
            ]);
        }

    }
    
    public function deleteFormRegister($id)
    {
        if(FormRegister::find($id)){
            if(FormRegister::find($id)->delete()){
                $data = FormRegister::all();
                return response()->json([
                    'data' => $data,
                    'status' => 200,
                    'message' => 'Delete Discount successfully'
                ]); 
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Delete Discount false'
                ]);
            }
        }
    }
}
