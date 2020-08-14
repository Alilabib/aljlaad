<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\MiniProviderOrderResource;
use App\Http\Resources\ProviderOrderDetailsResource;
use App\Http\Requests\Api\Order\OrderRequest;

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

    public function allorders()
    {
        try{
            $users = User::where('city_id',$user->city_id)->get()->pluck('id')->toArray();
             $pendingOrders = Order::whereIn('user_id',$users)->where('status','!=','received')->where('status','!=','cancelled')->get();
             $deleviredOrders = Order::where('user_id',auth()->user()->id)->where('status','delevired')->get();
             $cancelledOrders = Order::where('user_id',auth()->user()->id)->where('status','cancelled')->get();
             $this->data['pending'] = MiniOrderResource::collection($deleviredOrders);   
             $this->data['delevired'] = MiniOrderResource::collection($deleviredOrders);
             $this->data['cancelled'] = MiniOrderResource::collection($cancelledOrders);   
   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function pending()
    {
        try{
            $user = auth()->user();
            $users = User::where('city_id',$user->city_id)->get()->pluck('id')->toArray();
            $orders = Order::whereIn('user_id',$users)->where('status','!=','received')->where('status','!=','cancelled')->get();
             $this->data = MiniProviderOrderResource::collection($orders);   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

    public function details(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
             $this->data = new ProviderOrderDetailsResource($order);   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

    public function acceptOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'inprogress';
            $order->driver_id = auth()->user()->id;
            $order->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function inwayOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'inway';
            $order->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function DeliverOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'delevired';
            
            $order->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function compeleted()
    {
        try{
            $user = auth()->user();
            $orders = Order::where('driver_id',$user->id)->where('status','delevired')->get();
             $this->data = MiniProviderOrderResource::collection($orders);   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

}
