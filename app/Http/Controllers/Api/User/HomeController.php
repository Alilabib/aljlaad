<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SlidersResource;
use App\Http\Resources\ProductsResource;

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
}
