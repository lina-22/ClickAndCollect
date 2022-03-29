<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{   
    public function showAll(){
        $res = [
            'status' => false,
            'data'  => null,
            'message' => ''
        ];

        $role = Role::all();
        if($role->count()>0){
            $res['status'] = true;
            $res['data'] = $role;
            $res['message'] = "This are roles!";
        } else{
            $res['message'] = "There is no role!";
        }
        return response()->json($res);
    }

    public function showSingle($id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
         $role = Role::find($id);
         if($role){
             $res['status'] = true;
             $res['data'] =$role;
             $res['message'] = "This role one!";
         }else{
             $res["message"] = 'There is no role!';
         }

         return response()->json($res);
    }

    public function store(Request $request){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ""
        ];

        $validator = Validator::make($request->all(),[
            'name' => 'string|required'
        ]);

        if ($validator->fails()){
            $res['message'] = $validator->errors()->first();
        }else{
            $role = new Role();
            $role->name =$request->name;

            $role->save();

            $res['status'] = true;
            $res['data'] = $role;
            $res['message'] = 'role saved!!';
        }
        return response()->json($res);
    }

    public function update (Request $request, $id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'string|required',
        ]);
        
        if($validator->fails()){
            $res['message'] = $validator->errors()->first();
        }else{
            $role = Role::find($id);
            if(!$role){
                $res['message'] = "role not found";
            }else{
                $role->name = $request->name;

                $role ->save();
                $res['status'] = 'true';
                $res['data'] = $role;
                $res['message'] = 'Roles are found!';
            }
            return response()->json($res);
        }

       
    }
    public function destroy($id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $role = Role::find($id);

        if(!$role){
            $res['message'] = "role is not aviable";
        }
        $role ->delete();
        $role ->save();

        $res['status'] = 'true';
        $res['data'] = $role;
        $res['message'] = 'Role deleted!';
        return response()->json($res);
    }
}
