<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\CreateAddressRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
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
            $address->desc       = $request->details;
            $address->near_place = $request->near_place;
            $address->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }

    public function continueShopping()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();
            $this->data['sub_total'] = $cart->total;
            $this->data['delivery']  = 10;
            $this->data['tax']       = 75;
            $this->data['total']     = $cart->total + $this->data['delivery'] + $this->data['tax'];
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function newOrder(Type $var = null)
    {

    }

    public function allOrders()
    {

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
