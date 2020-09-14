<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SlidersResource;

class HomeController extends Controller
{
    //
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

               $categories =  Category::orderBy('id', 'DESC')->get();
               $sliders    = Slider::orderBy('id', 'DESC')->get();
               $this->data['categories'] = new CategoriesResource($categories);
               $this->data['sliders']    = new SlidersResource($sliders);

            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }
}
