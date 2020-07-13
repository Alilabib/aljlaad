<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\City;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SlidersResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\CityResource;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Http\Requests\Api\Product\ProductsRequest;

class HomeController extends Controller
{
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

    public function index()
    {
        try{
               $categories =  Category::all();
               $sliders    = Slider::all();
               $this->data['categories'] =  CategoriesResource::collection($categories);
               $this->data['sliders']    =  SlidersResource::collection($sliders);

            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function products(ProductsRequest $request)
    {
        try{
            $products =  Product::where('category_id',$request->category_id)->get();
            $this->data =  ProductsResource::collection($products);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
     }catch (Exception $e){
         return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
     }
    }

    public function product(ProductRequest $request)
    {
        try{
            $products =  Product::find($request->product_id);
            $this->data = new ProductsResource($products);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function cities()
    {
        try{
            $cities =  City::all();
            $this->data = CityResource::collection($cities);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function contact()
    {
        try{
          $this->data['phone']    =  SETTING_VALUE('MOBILE');
          $this->data['whatsapp'] =  SETTING_VALUE('ABOUT_AR');
          $this->data['email']    =  SETTING_VALUE('FORMAL_EMAIL');
          $this->data['facebook'] =  SETTING_VALUE('FACEBOOK_URL');
          $this->data['twitter']  =  SETTING_VALUE('TWITTER_URL');
          $this->data['instgram'] =  SETTING_VALUE('INSTAGRAM_URL');
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

    public function about()
    {
        try{
          $this->data    =   SETTING_VALUE('ABOUT_AR');

         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }

    public function policy()
    {
        try{
          $this->data    =  SETTING_VALUE('PRIVACY_POLICY_AR');

         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }
}
