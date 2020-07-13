<?php

namespace App\Http\Controllers\Api\Provider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

use App\Http\Resources\UserResource;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActiveRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgetRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Auth\ProviderRegisterRequest;
use App\Models\User;
use App\Models\Token;

class LoginController extends Controller
{
    //
    private $user;
    private $resource;
    private $data;
    private $successCode;
    private $successMessage;
    private $failMessage;
    public function __construct(){
        $this->data           = [];
        $this->successCode    = 200;
        $this->serverErrorCode    = 500;
        $this->successMessage = 'Request Done successfully';
        $this->failMessage    = 'server Error With Details => ';
    }

    public function register(ProviderRegisterRequest $request)
    {
        $request_data = $request->except(['image','residence_img' ,'license_img','password_confirmation','device_type','fcm_token','city']);
        $request_data['mobile_code'] = random_int(1111, 9999);
        $request_data['type'] = 'provider';
        $request_data['address'] = $request->city;
        if ($request->image) {
            $image_name = time(). $request['image']->getClientOriginalName();
            $request['image']->move(storage_path('app/public/uploads/users/'),$image_name);
            $request_data['img'] = $image_name;
        }
        
        if($request->residence_img){
            $image_name = time(). $request['residence_img']->getClientOriginalName();
            $request['residence_img']->move(storage_path('app/public/uploads/users/'),$image_name);
            $request_data['residence_img'] = $image_name;
        }

        if($request->license_img){
            $image_name = time(). $request['license_img']->getClientOriginalName();
            $request['license_img']->move(storage_path('app/public/uploads/users/'),$image_name);
            $request_data['license_img'] = $image_name;
        }

       if ($request->lat) {
           $request_data['lat'] = $request->lat;
       }
       if ($request->long) {
           $request_data['long']  = $request->long;
       }

        $user = User::create($request_data);

        if ($user) {
            $token = new Token();
            $token->user_id = $user->id;
            $token->fcm = $request->fcm_token;
            $token->device_type = $request->header('os');
            $token->jwt = JWTAuth::fromUser($user);
            $token->is_logged_in = 'false';
            $token->ip = $request->ip();
            $token->save();
        }
        $this->data = $user->mobile_code;
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    }


    public function login(LoginRequest $request)
    {
        $perms['phone'] = $request->mobile;
        $perms['password'] = $request->password;
        if (!$token = JWTAuth::attempt($perms)) {
            $this->data['data'] = "";
            $this->data['status'] = "fails";
            $this->data['message'] = trans('auth.failed');
            return response()->json($this->data, 401);
        }

        $logged_user = auth()->user();
        if ($request->long && $request->lat) {
            $logged_user->lat = $request->lat;
            $logged_user->long = $request->long;
        }
        $logged_user->update();
        $logged_user_token = $logged_user->token;
        $logged_user_token->jwt = $token;
        $logged_user_token->is_logged_in = "true";
        if($request->fcm_token){
            $logged_user_token->fcm = $request->fcm_token;
        }
        if($request->header('os')){
            $logged_user_token->device_type = $request->header('os');
        }
        if($request->ip()){
            $logged_user_token->ip =$request->ip() ;
        }
        $logged_user_token->update();
        $this->data['data'] = new UserResource($logged_user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);

    }

    public function active(ActiveRequest $request)
    {
        try{
            $code = $request->code;
            $user = User::where(['phone'=>$request->phone,'mobile_code'=>$code])->first();
            $user->mobile_code = '';
            $user->active = '1';
            $user->save();
            $this->data = new UserResource($user);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function forget(ForgetRequest $request)
    {
        try{
            $code = $request->mobile;
            $user = User::where('phone',$code)->first();
            $user->mobile_code = random_int(1111, 9999);
            $user->active = '0';
            $user->save();
            $this->data = $user->mobile_code;
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function sendCode(ForgetRequest $request)
    {
        try{
            $code = $request->mobile;
            $user = User::where('phone',$code)->first();
            $user->mobile_code = random_int(1111, 9999);
            $user->save();
            $this->data = $user->mobile_code;
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

    public function updatePassword(UpdatePasswordRequest $request){
        try{
            $code = $request->code;
            $user = User::where('mobile_code',$code)->first();
            $user->password = $request->password;
            $user->mobile_code = '';
            $user->active = '1';
            $user->save();
            $this->data = new UserResource($user);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

    public function Logout()
    {
        $user_token = $this->user->token;
        $user_token->is_logged_in = 'false';
        $user_token->fcm = '';
        $user_token->update();
        $this->data['data'] = null;
        $this->data['status'] = "ok";
        $this->data['message'] = "";
        return response()->json($this->data, 200);
    }





}
