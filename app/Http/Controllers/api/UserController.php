<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:150',
            'last_name' => 'nullable|string|max:150',

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {



            $user = Auth::user();

            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;

                $user->save();

                $res['status'] = true;
                $res['data'] =  $user;
                $res['message'] = 'Profile Update Completed';
            } else {
                $res['message'] = 'User not found';
            }
        }
        return response()->json($res);
    }


    public function updatePassword(Request $request)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8|string|max:16|confirmed',
            'old_password' => 'required',

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $user = Auth::user();

            if ($user) {
                $match = Hash::check($request->old_password, $user->password);
                if ($match) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();

                    $res['status'] = true;
                    $res['data'] =  $user;
                    $res['message'] = 'Profile Update Completed';
                } else {
                    $res['message'] = 'credentials Dont Match';
                }
            } else {
                $res['message'] = 'User not found';
            }
        }
        return response()->json($res);
    }


    public function updateEmail(Request $request)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $user = Auth::user();

            if ($user) {
                $match = Hash::check($request->password, $user->password);
                if ($match) {
                    $user->password = $request->new_email;
                    $user->save();

                    $res['status'] = true;
                    $res['data'] =  $user;
                    $res['message'] = 'Profile Update Completed';
                } else {
                    $res['message'] = 'credentials Dont Match';
                }
            } else {
                $res['message'] = 'User not found';
            }
        }
        return response()->json($res);
    }

    public function showAll(){
        $res = [
            'status' => false,
            'data'  => null,
            'message' => ''
        ];

        $user = User::all();
        if($user->count()>0){
            $res['status'] = true;
            $res['data'] = $user;
            $res['message'] = "This are users!";
        } else{
            $res['message'] = "There is no user!";
        }
        return response()->json($res);
    }

    public function showSingle($id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
         $user = User::find($id);
         if($user){
             $res['status'] = true;
             $res['data'] =$user;
             $res['message'] = "This is user one!";
         }else{
             $res["message"] = 'There is no user!';
         }

         return response()->json($res);
    }
}
