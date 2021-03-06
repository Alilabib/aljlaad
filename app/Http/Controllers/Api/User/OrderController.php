<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\CreateAddressRequest;
use App\Http\Requests\Api\Order\CreateOrderRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Requests\Api\Order\CancelOrderRequest;
use App\Http\Requests\Api\Order\AddressRequest;
use App\Models\User;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Coupon;
use App\Http\Resources\MiniOrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\AddressResource;
use Carbon\Carbon;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
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
        $this->successMessage = trans('api.api-success-message');
        $this->failMessage    = trans('api.api-error-message');
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
            $deliveryCost = '10';
            if($cart->deleviery == 1){
                if(SETTING_VALUE('fast_deleviery') !='' && SETTING_VALUE('fast_deleviery') !=null ){
                    $deliveryCost = SETTING_VALUE('fast_deleviery');
                }
            }elseif($cart->deleviery == 0){
                if(SETTING_VALUE('deleviery') !='' && SETTING_VALUE('deleviery') !=null ){
                    $deliveryCost = SETTING_VALUE('deleviery');
                }
            }
    
            $this->data['delivery']  = $deliveryCost;
            $tax = '75';
            if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
                $tax = SETTING_VALUE('tax');
            }
            $this->data['tax']    = $tax;
            $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();
            if(count($cartproudcts) == 0 ){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage.trans('api.no-products-in-cart'),'status'=>$this->serverErrorCode]);
            }

            
            $this->data['sub_total'] = $cart->total;

                 
            $this->data['total']     = $cart->total + $this->data['delivery'] + $this->data['tax'];
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function allorders()
    {
        try{
 
             $pendingOrders           = Order::where(['user_id'=>auth()->user()->id,'type'=>null])->where('status','!=','received')->where('status','!=','cancelled')->orderBy('id', 'DESC')->get();
             $deleviredOrders         = Order::where(['user_id'=>auth()->user()->id,'type'=>null])->where('status','delevired')->orderBy('id', 'DESC')->get();
             $cancelledOrders         = Order::where(['user_id'=>auth()->user()->id,'type'=>null])->where('status','cancelled')->orWhere('status','problem')->orderBy('id', 'DESC')->get();
             $this->data['pending']   = MiniOrderResource::collection($pendingOrders);   
             $this->data['delevired'] = MiniOrderResource::collection($deleviredOrders);
             $this->data['cancelled'] = MiniOrderResource::collection($cancelledOrders);   
   
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
        $delivery_price = '10';
        
        if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
            $tax = SETTING_VALUE('tax');
        }

        if($cart->deleviery == 1){
            if(SETTING_VALUE('fast_deleviery') !='' && SETTING_VALUE('fast_deleviery') !=null ){
                $delivery_price = SETTING_VALUE('fast_deleviery');
            }
        }elseif($cart->deleviery == 0){
            if(SETTING_VALUE('deleviery') !='' && SETTING_VALUE('deleviery') !=null ){
                $delivery_price = SETTING_VALUE('deleviery');
            }
        }


        if($cart){
            $order = new Order ();
            $order->user_id        = auth()->user()->id;
            $order->address_id     = $request->address_id;
            $order->date           = Carbon::parse($request->date);
            $order->time           = Carbon::parse($request->time);
            $order->sub_total      = $cart->total;
            $order->delivery_price = $delivery_price;
            $order->enable_tax     = '1';
            $order->tax            = $tax;
            $order->payment_type   = $request->pay_type;
            if($cart->total !='' && $cart->total != null){
                $order->total          = $cart->total + $delivery_price  + $tax;
            }else{
                $order->total          =  $delivery_price  + $tax;
            }

            if($request->coupoun){
             $coupoun = Coupon::where('name',$request->coupoun)->whereDate('date' , '>=', \Carbon\Carbon::now())->first();
               if($coupoun){
                    if($coupoun->value != null && $coupoun->value != '' && $coupoun->used != '1'){
                        $order->total  -=  $coupoun->value;
                        $coupoun->value = '';
                        $coupoun->used = '1';
                        $coupoun->save();
                    }else{
                        return response()->json(['data'=>$this->data, 'message'=>trans('api.this-coupon-used') ,'status'=>$this->successCode]);
                    }
               }else{
                return response()->json(['data'=>$this->data, 'message'=>trans('api.this-coupon-not-available'),'status'=>$this->successCode]);
               }  
             
            }

            $order->status         = 'pending'; // pending - received - inprogress - delivered - cancelled
            $order->save();
            if(count($cart->products) > 0){
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

                $notifiacation = new Notification();
                $notifiacation->title_ar = 'قام العميل ' . $order->user->name . ' بطلب جديد';
                $notifiacation->value_ar = ' قام العميل ' . $order->user->name . 'بإنشاء طلب جديد رقم '. $order->id;
                $notifiacation->order_id = $order->id;
                $notifiacation->type = 'provider';
                $notifiacation->save();
                $notifiy = [
                    'title'=>$notifiacation->title_ar,
                    'body'=>$notifiacation->value_ar,
                    'type'=>'provider',
                    'order_id'=>$order->id,
                    'click_action' => "FLUTTER_NOTIFICATION_CLICK"
                ];

                $user = auth()->user();
                $users = User::where('area_id',$user->area_id)->where('type','provider')->get()->pluck('id')->toArray();
                pushFcmNotes($notifiy,$users);
        


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

    public function applyCoupon( Request $request)
    {
        if($request->coupoun){
            $coupoun = Coupon::where('name',$request->coupoun)->whereDate('date' , '>=', \Carbon\Carbon::now())->first();
            
              if($coupoun){
                   if($coupoun->value != null && $coupoun->value != '' && $coupoun->used != '1'){
                       $this->data = $coupoun->value;
                       return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
                   }else{
                       return response()->json(['data'=>$this->data, 'message'=>trans('api.this-coupon-used'),'status'=>$this->successCode]);
                   }
              }else{
               return response()->json(['data'=>$this->data, 'message'=>trans('api.this-coupon-not-available'),'status'=>$this->successCode]);
              }  
        }
    }
    

    public function pendingOrders()
    {
        try{
        $orders = Order::where('user_id',auth()->user()->id)->where('status','!=','received')->where('status','!=','cancelled')->get();
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

    public function cacncelOrder(CancelOrderRequest $request)
    {

        try{
            $order = Order::find($request->order_id);
            $order->status = 'cancelled';
            $order->cancel_status = $request->reason;
            $order->cancel_type = 'user';
            $order->save();

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->user->name . ' بإلغاء الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->user->name . '  بإلغاء الطلب  ' . $order->id ;
            $notifiacation->order_id = $order->id;
            $notifiacation->type = 'user';
            $notifiacation->save();

            $notifiy = [
                'title'=>$notifiacation->title_ar,
                'body'=>$notifiacation->value_ar,
                'type'=>'user',
                'order_id'=>$order->id,
                'click_action' => "FLUTTER_NOTIFICATION_CLICK"
            ];

            $user_id = [$order->user_id];
            if($user_id != null){
                pushFcmNotes($notifiy,$user_id);
            }

            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }
}
