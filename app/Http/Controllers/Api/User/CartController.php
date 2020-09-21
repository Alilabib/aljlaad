<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;

use App\Models\CartProduct;
use App\Http\Requests\Api\Cart\AddRequest;
use App\Http\Requests\Api\Cart\DeleteProductRequest;
use App\Http\Resources\CartProductsResource;
class CartController extends Controller
{
    //
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

    public function add(AddRequest $request)
    {
        try{
        $user     = auth()->user();
        $cart     = Cart::where('user_id',auth()->user()->id)->first();
        $product  = Product::find($request->product_id);

        $category = Category::find($product->category_id);
        if($category->min > $request->quantity){
            return response()->json(['data'=>$this->data,'message'=>trans('api.must-mini-company'),'status'=>$this->successCode]);

        }

        if($cart){
            $anyCartproudct = CartProduct::where(['cart_id'=>$cart->id])->first();
            if($anyCartproudct){
                $oldCartProduct  = Product::find($anyCartproudct->product_id);
                $oldCartCategory = Category::find($oldCartProduct->category_id);
                if($category->express_delivery != $oldCartCategory->express_delivery){
                    return response()->json(['data'=>$this->data,'message'=>trans('api.can-not-add-product-to-diffrent-deliver'),'status'=>$this->successCode]);
                }
            }
            $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
            if($cartProduct){
                if($product->id === $cartProduct->product_id){
                    $cart->total -= $product->price * $cartProduct->quantity;
                    $cart->save();
                    $cartProduct->delete();    

                    $newCartProduct             = new CartProduct();
                    $newCartProduct->cart_id    = $cart->id;
                    $newCartProduct->product_id = $product->id;
                    $newCartProduct->quantity   = $request->quantity;
                    $newCartProduct->save();
                }else{
                    $newCartProduct             = new CartProduct();
                    $newCartProduct->cart_id    = $cart->id;
                    $newCartProduct->product_id = $product->id;
                    $newCartProduct->quantity   = $request->quantity;
                    $newCartProduct->save();
                }
                $cart->total  += $product->price * $request->quantity;
                $newCart->deleviery = $request->express;
                $cart->save();

                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }else{
                if($cart->total != '' && $cart->total != null){
                    $cart->total  += $product->price * $request->quantity;
                }else{
                    $cart->total  = $product->price * $request->quantity;
                }
                $cart->save();
                $newCartProduct          = new CartProduct();
                $newCartProduct->cart_id    = $cart->id;
                $newCartProduct->product_id = $product->id;
                $newCartProduct->quantity   = $request->quantity;
                $newCartProduct->save();
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
            }
        }else{
            $newCart = new Cart();
            $newCart->user_id = $user->id;
            $newCart->total   = $product->price * $request->quantity;
            $newCart->deleviery = $request->express;
            $newCart->save();
            
            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $newCart->id;
            $cartProduct->product_id = $product->id;
            $cartProduct->quantity = $request->quantity;
            $cartProduct->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function cartproudctsCount()
    {
        try{

            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $count =  $cart->products->count();
            return response()->json(['data'=>$count,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function viewCart()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            if($cart){
                $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();
                $this->data['total'] = $cart->total;
                $this->data['products'] = CartProductsResource::collection($cartproudcts);
            }else{
                $this->data['total'] = "0";
                $this->data['products'] = [];
            }
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);    
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function update()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    return response()->json(['data'=>$this->data,'message'=>trans('api.product-in-cart') ,'status'=>$this->successCode]);
                }else{
                    $cart->total  += $product->price;
                    $cart->save();
                    
                    $newCartProduct          = new CartProduct();
                    $newCartProduct->cart_id    = $cart->id;
                    $newCartProduct->product_id = $product->id;
                    $newCartProduct->quantity   = '1';
                    $newCartProduct->save();
                    return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
                }
            }else{
                $newCart = new Cart();
                $newCart->user_id = $user->id;
                $newCart->total   = $product->price;
                $newCart->save();
                
                $cartProduct = new CartProduct();
                $cartProduct->cart_id = $newCart->id;
                $cartProduct->product_id = $product->id;
                $cartProduct->quantity = '1';
                $cartProduct->save();
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }

    public function delete(DeleteProductRequest $request)
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                if(count($cart->products) > 0 ){
                    $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                    if($cartProduct){
                        $cart->total -= $product->price * $cartProduct->quantity;
                        $cart->save();
                        $cartProduct->delete();
                        return response()->json(['data'=>$this->data,'message'=>trans('api.product-deleted'),'status'=>$this->successCode]);
                    }else{
    
                        return response()->json(['data'=>$this->data,'message'=>trans('api.product-not-exists'),'status'=>$this->successCode]);
                    }
                }
            }

            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }
    //create order on continue shopping

}
