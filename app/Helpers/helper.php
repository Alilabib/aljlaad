<?php
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;

function checkExistsInCart($product_id)
{
    $cart = Cart::where('user_id',auth()->user()->id)->first();
    if($cart){
        $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product_id])->first();
        if($cartProduct){
            return true;
        }
    }
    return false;
}


function checkExistsCartProductCount($cart_id,$product_id)
{
    
    $cart = Cart::where('user_id',auth()->user()->id)->first();
    if($cart){
        $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product_id])->first();
        if($cartProduct){
            return $cartProduct->quantity;
        }
    }
    return 0;
}


