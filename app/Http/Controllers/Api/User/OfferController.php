<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Resources\OfferResource;
use App\Http\Resources\GoalResource;
use App\Http\Requests\Api\Offer\OfferRequest;
use App\Models\Order;
use App\Models\CompanyWish;
use App\Models\Category;
use App\Http\Requests\Api\Offer\WishListRequest;
use App\Models\Goal;
use App\Models\OrderProducts;
use Carbon\Carbon;
use App\Http\Resources\CompanyResource;
class OfferController extends Controller
{
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
    //
    public function getAll()
    {
        try{
            $offers = Offer::all();
            $this->data = OfferResource::collection($offers);   
         
           return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
   
       }catch (Exception $e){
           return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
       }

    }

    public function getOffer(OfferRequest $request)
    {
       try{
            $offer = Offer::find($request->offer_id);
            $this->data = new OfferResource($offer);   
         
           return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
   
       }catch (Exception $e){
           return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
       }
    }

    public function createOffer(OfferRequest $request)
    {
       try{
            $tax = 75;
            if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
                $tax = SETTING_VALUE('tax');
            }
           $order = new Order();
           $order->offer_id = $request->offer_id;
           $order->user_id  = auth()->user()->id;
           $order->type = 'offer';
           $order->address_id     = $request->address_id;
           $order->date           = Carbon::parse($request->date);
           $order->time           = Carbon::parse($request->time);
           $order->enable_tax     = '1';
           $order->tax            = $tax;
           $order->payment_type   = $request->pay_type;
   
           $order->save();
           return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
   
       }catch (Exception $e){
           return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
       }
    }

    public function wishlistToggle(WishListRequest $request)
    {
      try{
        $user = auth()->user();
        $category = Category::find($request->company_id);
        $wishlistCount = CompanyWish::where('category_id',$category->id)->where('user_id',$user->id)->count();
        if($wishlistCount > 0){
            $wishlist = CompanyWish::where('category_id',$category->id)->where('user_id',$user->id)->first();
            $wishlist->delete();
        }else{
            $wishlist = new  CompanyWish();
            $wishlist->user_id   = $user->id;
            $wishlist->category_id = $category->id;
            $wishlist->save(); 
        }
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
   
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    
    }

    public function favCompanies()
    {
        try{
            $user = auth()->user();
            $companies = $user->favourites;
            $this->data =  CompanyResource::collection($companies);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function Goals()
    {
        try{
            
            $this->data = GoalResource::collection(Goal::all());
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
       
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
        
    }

    public function Goal()
    {
        try{
            $user = auth()->user();
            $orders = Order::where('user_id',$user->id)->get()->pluck('id')->toArray();
            $productsCount = OrderProducts::whereIn('order_id',$orders)->sum('quantity');
            $this->data = $productsCount;
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
       
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

}
