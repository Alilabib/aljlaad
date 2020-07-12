<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\CreateAddressRequest;
use App\Models\Address;
class OrderController extends Controller
{
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

    public function addAddress(CreateAddressRequest $request)
    {
        try{
            $user = auth()->user();
            $address = new Address();
            $address->lat        = $request->lat;
            $address->long       = $request->long;
            $address->user_id    = $user->id;
            $address->type       = $request->type;
            $address->number     = $request->number;
            $address->details    = $request->details;
            $address->near_place = $request->near_place;
            $address->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }

    public function allOrders()
    {
        # code...

    }

    public function order()
    {
        # code...
    }

    public function cacncelOrder()
    {
        # code...
    }
}
