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


function getSetting($setting_name) { return \App\Models\Setting::whereStatus(1)->where('key', $setting_name)->first()->value ?? null; }

function SETTING_VALUE($key = false)
{
    return \App\Models\Setting::where('key', $key)->first()->value;
}