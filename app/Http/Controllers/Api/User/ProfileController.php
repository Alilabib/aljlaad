<?php

namespace App\Http\Controllers\Api\User;

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
use App\Models\Notification;


class ProfileController extends Controller
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


    public function Logout()
    {
        $user_token = auth()->user()->token;
        $user_token->is_logged_in = 'false';
        $user_token->fcm = '';
        $user_token->update();
        $this->data['data'] = null;
        $this->data['status'] = "ok";
        $this->data['message'] = "";
        return response()->json($this->data, 200);
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if($request->name){
            $user->name = $request->name;
        }

        if($request->email){
            $user->email = $request->email;
        }

        if($request->phone){
            $user->phone = $request->phone;
        }
        
        if($request->password){
            $user->password = $request->password;
        }

        if($request->city_id){
            $request->city_id = $request->city_id;
        }

        if($request->image){
            $image_name = time(). $request->image->getClientOriginalName();
            $request->image->move(storage_path('app/public/uploads/users/'),$image_name);
            $user->img = $image_name;
        }

        $user->save();
        $this->data = new UserResource($user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
    }

    public function updatePassword(UpdatePassowrd $request)
    {
        try{
            $old_password = $request->old_password;
            $authUser = auth()->user();
            if(\Hash::check($old_password, $authUser->password)){
                $authUser->password = $request->password;
                $authUser->save();
                $this->data = new UserResource($authUser);
                return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
            }
          
            $this->data['data'] = "";
            $this->data['status'] = "ok";
            $this->data['message'] = "تأكد من كلمة المرور القديمة";
            return response()->json($this->data, 401);
        
  
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }
}
