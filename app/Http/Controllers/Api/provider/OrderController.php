<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\MiniProviderOrderResource;
use App\Http\Resources\ProviderOrderDetailsResource;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Models\Problem;
use App\Http\Requests\Api\Order\ProblemRequest;
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
             $user = auth()->user();
             $pendingOrders = Order::where(['driver_id'=>auth()->user()->id,'type'=>null])->where('status','inprogress')->OrWhere('status','inway')->get();
             $deleviredOrders = Order::where(['driver_id'=>auth()->user()->id,'type'=>null])->where('status','delevired')->get();
             $cancelledOrders = Order::where(['driver_id'=>auth()->user()->id,'type'=>null])->where('status','problem')->get();
             $this->data['pending'] = MiniProviderOrderResource::collection($pendingOrders);   
             $this->data['delevired'] = MiniProviderOrderResource::collection($deleviredOrders);
             $this->data['cancelled'] = MiniProviderOrderResource::collection($cancelledOrders);   
   
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function pending()
    {
        try{
            $user = auth()->user();
            $areasId = $user->areas->pluck('id')->toArray();
            $users = User::whereIn('area_id',$areasId)->get()->pluck('id')->toArray();
            $orders = Order::whereIn('user_id',$users)->where(['type'=>null,'status'=>'pending'])->get();
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

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' بقبول الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . ' بقبول الطلب رقم  ' . $order->id ;
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

    public function inwayOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'inway';
            $order->save();


            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' بتحديث حالة الطلب في الطريق ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . '  بتحديث حالة الطلب في الطريق  ' . $order->id ;
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

    public function DeliverOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'delevired';
            
            $order->save();

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' بتحديث حالة الطلب تم التوصيل ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . '  بتحديث حالة الطلب تم التوصيل  ' . $order->id ;
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

    public function problem(ProblemRequest $request)
    {
        try{
            $oldProblem = Problem::where('user_id',auth()->user()->id)->where('order_id',$request->order_id)->first();
            if($oldProblem){
                $oldProblem->delete();
            }
            $problem = new Problem();
            $problem->order_id = $request->order_id;
            $problem->user_id = auth()->user()->id;
            $problem->problem = $request->problem;
            $problem->save();
            $order = Order::find($request->order_id);
            $order->cancel_status = $request->problem;
            $order->status = 'problem';
            $order->save();
            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' بتقديم مشكلة علي  الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . ' بتقديم مشكلة علي  الطلب  ' . $order->id ;
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
