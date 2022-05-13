<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $res = [
            'status' => false,
            'data' => null,
            'message' =>''
        ];

        $validator= Validator::make($request->all(),[
           'first_name' => 'required|string|max:150',
           'last_name' => 'nullable|string|max:150',
           'email' => 'required|email|unique:users',
           'password' => 'required|confirmed'

        ]);
        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        }else{
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id =3;
            $user->save();
            $token= $user->createToken('Access_token');

            $res['status'] = true;
            $res['data'] = [
                'user' => $user,
                'token' => $token
            ];

            $res['message'] = "Registartion Completed!";
        }
        return response()->json($res);
    }

    public function login(Request $request){
        $res = [
            'status' => false,
            'data' => null,
            'message' =>''
        ];

        $validator= Validator::make($request->all(),[

           'email' => 'required|email',
           'password' => 'required'

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        }else{
            $user = User::where('email', $request->email)->first();
            if ($user){
                $match = Hash::check($request->password, $user->password);

                if($match){
                   $user->tokens()->delete();
                   $token= $user->createToken('Customer_token');

                   $res['status'] = true;
                   $res['data'] = [
                       'user' => $user,
                       'token' => $token
                   ];

                   $res['message'] = "Login Completed!";
                }else{
                    $res['message'] = "Credentials Don\'t Match";
                }
            }else{
                $res['message'] = "User doesn\'t Exists, Please Register!";
            }
        }
        return response()->json($res);
    }

    public function profile(){
        $res = [
            'status' => false,
            'data' => null,
            'message' =>''
        ];


        $user = Auth::user();
        if(!$user){
            $res['message'] ='UnAuthorized!';
        }else{
            $res['status'] = true;
            $res['data'] = $user;
        }

        return response()->json($res);
    }


    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'data' => null,
            'message' => 'Logout success!'
        ]);

    }
}
