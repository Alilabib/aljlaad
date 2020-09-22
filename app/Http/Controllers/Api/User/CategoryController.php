<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoriesResource;
use  App\Http\Requests\Api\Category\QuestionsRequest;
class CategoryController extends Controller
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
        $this->successMessage = trans('api.api-success-message');
        $this->failMessage    = trans('api.api-error-message');
    }
    public function getAll()
    {
        try{
            $categories       = Category::where('category_id',null)->orderBy('id', 'DESC')->get();
            $this->data['categories']         =  CategoriesResource::collection($categories);

         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
     }catch (Exception $e){
         return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
     }
    }

    public function questions(QuestionsRequest $request)
    {
        try{
            $categories       = Category::where('category_id',$request->category_id)->orderBy('id', 'DESC')->get();
            $this->data['questions']         =  CategoriesResource::collection($categories);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
     }catch (Exception $e){
         return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
     }
    }
}
