<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    //Home Page
    public function index(Request $request){
        return view('welcome');
    }
    //Get login User Data
    public function getAuthenticatedUser()
    {
            try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    }
    //Update User
    public function update(Request $request){
        try {

            DB::beginTransaction();
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            $validator = Validator::make($request->all(), User::updateRules($user->id));
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toJson(),'status' => 422], 422);
            }
            $postArray = $request->all();
            $profile_image_url = $user->profile_image;
            if ($files = $request->file('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $profile_image_url = time() . '.'.$extension;
                Storage::disk('public')->put($profile_image_url,File::get($image));
            }
            $postArray['profile_image'] = $profile_image_url;
            $user->update($postArray);
            DB::commit();
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                DB::rollback();
                return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                DB::rollback();
                return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                DB::rollback();
                return response()->json(['token_absent'], $e->getStatusCode());

        }
        return response()->json(compact('user'), 200);
    }
    //Update Profile View
    public function edit()
    {
        return view('edit_profile');
    }
    //Get Country
    public function getcountry(){
        try{
            $country=Country::all();
            return response()->json([
                'status' => true,
                'data' => $country,
            ]);
        }catch (\Exception $e) {
            return response()->json(['status' => false, 'form_error' => 'Something went wrong!!!']);
        }
        
    }
    //Get State
    public function getstate(Request $request){
        try{
            $id = $request->cid;
            $state=State::where('country_id',$id)->get();
            return response()->json([
                'status' => true,
                'data' => $state,
            ]);
        }catch (\Exception $e) {
            return response()->json(['status' => false, 'form_error' => 'Something went wrong!!!']);
        }
        
    }
    //Get City
    public function getcity(Request $request){
        try{
            $id = $request->sid;
            $city=City::where('state_id',$id)->get();
            return response()->json([
                'status' => true,
                'data' => $city,
            ]);
        }catch (\Exception $e) {
            return response()->json(['status' => false, 'form_error' => 'Something went wrong!!!']);
        }
        
    }
    //Logout
    public function logout( Request $request ) {

       $token = $request->header('Authorization');

        try {
            JWTAuth::parseToken()->invalidate( $token );

            return response()->json( [
                'status'   => 200,
                'message' => trans( 'auth.logged_out' )
            ] );
        } catch ( TokenExpiredException $exception ) {
            return response()->json( [
                'status'   => 401,
                'message' => trans( 'auth.token.expired' )

            ], 401 );
        } catch ( TokenInvalidException $exception ) {
            return response()->json( [
                'status'   => 401,
                'message' => trans( 'auth.token.invalid' )
            ], 401 );

        } catch ( JWTException $exception ) {
            return response()->json( [
                'status'   => 500,
                'message' => trans( 'auth.token.missing' )
            ], 500 );
        }
    }

}
