<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class RegisterController extends Controller
{
    //Register User
    public function register(Request $request)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), User::registerRules());
            if($validator->fails()){
                    return response()->json(['error' => $validator->errors()->toJson(),'status' => 422], 422);
            }
            $postArray = $request->all();
            $postArray['password'] = Hash::make($request->get('password'));
            $user = User::create($postArray);
            $token = JWTAuth::fromUser($user);
            DB::commit();
            return response()->json(compact('user','token'),201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Something went wrong!!!','status' => 400], 400);
        }
    }
    //Login User
     public function authenticate(Request $request)
     {

        try {
            $validator = Validator::make($request->all(), User::loginRules());
            if($validator->fails()){
                    return response()->json(['error' => $validator->errors()->toJson(),'status' => 422], 422);
            }
            $credentials = $request->only('email', 'password');
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials','status' => 400], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token','status' => 500], 500);
        }
        $where = array('email' => $request->email);
        $user = user::where($where)->get();
        $status = 200;
        return response()->json(compact('user','token','status'));
    }
}
