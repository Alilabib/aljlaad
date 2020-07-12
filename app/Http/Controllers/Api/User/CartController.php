<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Http\Requests\Api\Cart\AddRequest;

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
        $this->successMessage = 'Request Done successfully';
        $this->failMessage    = 'server Error With Details => ';
    }

    public function add(AddRequest $request)
    {
        try{
        $user = auth()->user();
        $cart = Cart::where('user_id',auth()->user()->id)->first();
        $product = Product::find($request->product_id);
        if($cart){
            $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
            if($cartProduct){
                return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
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

    public function increaseQuantity(IncreaseCartRequest $request)
    {
                try{
        $user = auth()->user();
        $cart = Cart::where('user_id',auth()->user()->id)->first();
        $product = Product::find($request->product_id);
        if($cart){
            $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
            if($cartProduct){
                return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
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

    public function decreaseQuantity(DecreaseCartRequest $request)
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
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

    public function update()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
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

    public function delete()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
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
    //create order on continue shopping
    public function continueShopping()
    {
        
    }
}
