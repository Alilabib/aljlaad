<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\City;
use App\Models\Area;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SlidersResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Http\Requests\Api\Product\ProductsRequest;
use App\Http\Requests\Api\HomeRequest;
use App\Http\Requests\Api\Auth\GetAreaRequest;
use App\Http\Requests\Api\Auth\ContactRequest;
use App\Models\Contact;
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
        $this->successMessage = trans('api.api-success-message');
        $this->failMessage    = trans('api.api-error-message');
    }

    public function index(HomeRequest $request)
    {
        try{
               $categories       = Category::where('category_id',null)->orderBy('id', 'DESC')->get();
               $local            = Category::where('category_id',1)->orderBy('id', 'DESC')->get();
               $international    = Category::where('category_id',2)->orderBy('id', 'DESC')->get();
               $express_delivery = Category::where('category_id','!=',null)->where('express_delivery','1')->orderBy('id', 'DESC')->get();
               $sliders    = Slider::all();
               $this->data['categories']         =  CategoriesResource::collection($categories);
               $this->data['sliders']            =  SlidersResource::collection($sliders);
               $this->data['local']              =  CompanyResource::collection($local);
               $this->data['international']      =  CompanyResource::collection($international);
               $this->data['express_delivery']   =  CompanyResource::collection($express_delivery);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function companies(Request $request)
    {
        try{
            $products =  Category::where('category_id',$request->category_id)->orderBy('id', 'DESC')->get();
            $this->data =  CompanyResource::collection($products);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function products(ProductsRequest $request)
    {
        try{
            $products =  Product::where('category_id',$request->company_id)->orderBy('id', 'DESC')->get();
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
            $cities =  City::orderBy('id', 'DESC')->get();
            $this->data = CityResource::collection($cities);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function areas(GetAreaRequest $request)
    {
        try{
            
            
            $areas =  Area::where('city_id',$request->city_id)->orderBy('id', 'DESC')->get();
            $this->data = AreaResource::collection($areas);
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

    public function contactus(ContactRequest $request)
    {
        try{
            $contact = new Contact();
            $contact->name    = $request->name;
            $contact->phone   = $request->phone;
            $contact->email   = $request->email;
            $contact->message = $request->message;
            $contact->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }   
    }
}
