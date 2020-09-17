<?php
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\CompanyWish;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\Notification as Notification;
use LaravelFCM\Facades\FCM as FCM;
use App\Models\Order;
use App\Models\OrderProducts;

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

function checkFavourite($user_id,$company_id)
{
    $wish = CompanyWish::where(['user_id'=>$user_id,'category_id'=>$company_id])->first();
    if($wish){
        return true;
    }else{
        return false;
    }
}

/**
 * Push Notifications to phone FCM
 *
 * @param  array $fcmData
 * @param  array $userIds
 */
function pushFcmNotes($fcmData, $userIds)
{
  $send_process = [];
  $fail_process = [];
  if (is_array($userIds) && !empty($userIds)) {
    $devices = Token::whereIn('user_id',$userIds)->pluck('fcm')->toArray();
    if (count($devices)) {
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder($fcmData['title']);
    $notificationBuilder->setBody($fcmData['body'])
                        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData($fcmData);

    $option       = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data         = $dataBuilder->build();

    // You must change it to get your tokens
    $downstreamResponse = FCM::sendTo($devices, $option, $notification, $data);
    // return $downstreamResponse;
    return $downstreamResponse->numberSuccess();
  }
  return 0;
  }
  return "No Users";
}


 function getProductCountByUserId($user_id , $product_id)
{
    //dd($user_id);
    $orders = Order::where('user_id',$user_id)->get()->pluck('id')->toArray();
    // dd($orders);
    $count  = OrderProducts::whereIn('order_id',$orders)->where('product_id',$product_id)->sum('quantity');
    return $count;
}