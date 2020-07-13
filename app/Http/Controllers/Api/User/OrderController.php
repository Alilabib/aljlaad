<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\CreateAddressRequest;
use App\Http\Requests\Api\Order\CreateOrderRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Requests\Api\Order\AddressRequest;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Http\Resources\MiniOrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\AddressResource;
use Carbon\Carbon;
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

    public function getAddresses()
    {
        try{
            $user = auth()->user();
            $addresses =  Address::where('user_id',$user->id)->get();
            $this->data = AddressResource::collection($addresses);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

    public function updateAddress(AddressRequest $request)
    {
        
        try{
            $user = auth()->user();
            $address = Address::find($request->address_id);
            if($request->lat){
                $address->lat        = $request->lat;
            }
            if($request->long){
                $address->long       = $request->long;
            }
            if($request->type){
                $address->type       = $request->type;
            }

            if($request->number){
                $address->number     = $request->number;
            }
            
            if($request->details){
                $address->desc       = $request->details;
            }
            if($request->near_place){
                $address->near_place = $request->near_place;
            }
            $address->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    

    }

    public function deleteAddress(AddressRequest $request)
    {
        try{
            $user = auth()->user();
            $address = Address::find($request->address_id);
            $address->delete();
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
            $tax = 75;
            if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
                $tax = SETTING_VALUE('tax');
            }
            $this->data['tax']    = $tax;
                
                 
            $this->data['total']     = $cart->total + $this->data['delivery'] + $this->data['tax'];
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function newOrder(CreateOrderRequest $request)
    {
        try{
        $user = auth()->user();
        $cart = Cart::where('user_id',auth()->user()->id)->first();
        $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();
        $tax = 75;
        if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
            $tax = SETTING_VALUE('tax');
        }
            

        if($cart){
            $order = new Order ();
            $order->user_id        = auth()->user()->id;
            $order->address_id     = $request->address_id;
            $order->date           = Carbon::parse($request->date);
            $order->time           = Carbon::parse($request->time);
            $order->sub_total      = $cart->total;
            $order->delivery_price = '10';
            $order->enable_tax     = '1';
            $order->tax            = $tax;
            if($cart->total !='' && $cart->total != null){
                $order->total          = $cart->total + 10 + $tax;
            }else{
                $order->total          =  10 + $tax;
            }

            $order->status         = 'pending'; // pending - received - inprogress - delivered - cancelled
            $order->save();
            if($cart->products){
                foreach($cart->products as $cartProduct){
                    $orderPrdouct = new OrderProducts();
                    $orderPrdouct->order_id   =  $order->id; 
                    $orderPrdouct->product_id = $cartProduct->id;
                    $orderPrdouct->quantity   = $cartProduct->pivot->quantity;
                    $orderPrdouct->save();
                }
                $cart->total = '';
                $cart->save();
                foreach($cart->products as $cartProduct){
                    $oldCartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$cartProduct->id])->first();
                    $oldCartProduct->delete();
                }
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
            }else{
                return response()->json(['data'=>$this->data, 'message'=>'No Products In Cart','status'=>$this->successCode]);
            }              
        }else{
            return response()->json(['data'=>$this->data, 'message'=>'No Cart To This User','status'=>$this->successCode]);
        }
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    

    public function pendingOrders()
    {
        try{
        $orders = Order::where('user_id',auth()->user()->id)->where('status','pending')->orWhere('status','received')->orWhere('status','inprogress')->get();
         $this->data = MiniOrderResource::collection($orders);   
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function order(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
             $this->data = new OrderDetailsResource($order);   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

    public function deliveredOrders()
    {
        try{
        $orders = Order::where('user_id',auth()->user()->id)->where('status','delevired')->get();
         $this->data = MiniOrderResource::collection($orders);   
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function cacncelOrder(OrderRequest $request)
    {

        try{
            $order = Order::find($request->order_id);
            $order->status = 'cancelled';
            $order->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }
}
