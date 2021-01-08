<?php

namespace App;
use Auth;
use DB;
use Session;
use App\Currency;
use App\ShippingCharge;
use App\Cart;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function attributes(){
    	return $this->hasMany('App\ProductAttributes','product_id');
    }
    public function images(){
    	return $this->hasMany('App\ProductsImage','product_id');
    }

    public static function cartCount(){
    	if(Auth::check()){
    		$user_email = Auth::user()->email;
    		$cartCount = DB::table('carts')->where('user_email',$user_email)->sum('quantity');
    	}else{
    		$session_id = Session::get('session_id');
    		$cartCount = DB::table('carts')->where('session_id',$session_id)->sum('quantity');
    	}
    	return $cartCount;
    }

    public static function productCount($cat_id){
    	$catCount = Product::where(['category_id'=>$cat_id,'status'=>1])->count();
    	return $catCount;
    }

    public static function getCurrencyRates($price){
    	$getCurrencies = Currency::where('status',1)->get();
    	foreach($getCurrencies as $currency){
    		if($currency->currency_code == "USD"){
    			$USD_Rate = round($price/$currency->exchange_rate,2);
    		}else if($currency->currency_code == "EUR"){
    			$EUR_Rate = round($price/$currency->exchange_rate,2);
    		}else if($currency->currency_code == "GBP"){
    			$GBP_Rate = round($price/$currency->exchange_rate,2);
    		}
    	}
    	$currenciresArr = array('USD_Rate'=>$USD_Rate,'GBP_Rate'=>$GBP_Rate,'EUR_Rate'=>$EUR_Rate);
    	return $currenciresArr;
    }

    public static function getProductStock($product_id,$product_size){
        $getAttributeCount = ProductAttributes::where(['product_id'=>$product_id,'size'=>$product_size])->count();
        if($getAttributeCount>0){
            $getProductStock = ProductAttributes::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
        }else{
            $getProductStock->stock = 0;
        }
        
        return $getProductStock->stock;
    }

    public static function deleteCartProduct($product_id,$user_email){
        DB::table('carts')->where(['product_id'=>$product_id,'user_email'=>$user_email])->delete();
    }

    public static function getProductStatus($product_id){
        $getProductStatus = Product::select('status')->where('id',$product_id)->first();
        return $getProductStatus->status;
    }

    public static function getAttributeCount($product_id,$product_size){
        $getAttributeCount = ProductAttributes::where(['product_id'=>$product_id,'size'=>$product_size])->count();
        return $getAttributeCount;
    }

    public static function getProductPrice($product_id,$product_size){
        $getProdcutPrice = ProductAttributes::select('price')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
        return $getProdcutPrice->price;
    }

    public static function getShippingCharges($total_weight,$country){
        $shippingDetails = ShippingCharge::where('country',$country)->first();
        if($total_weight>0){
            if($total_weight>=0 && $total_weight<=500) {
                $shippingCharge = $shippingDetails->shipping_charge0_500;
            }elseif($total_weight>=500 && $total_weight<=1000){
                $shippingCharge = $shippingDetails->shipping_charge500_1000;
            }elseif($total_weight>=1000 && $total_weight<=2000){
                $shippingCharge = $shippingDetails->shipping_charge1000_2000;
            }elseif($total_weight>=2000 && $total_weight<=5000) {
                $shippingCharge = $shippingDetails->shipping_charge2000_5000;
            }else{
                $total_weight = 0;
            }
        }else{
            $total_weight=0;
        }
        return $shippingCharge;
    }

    public static function getGrandTotal(){
        $grant_total = "";
        $user_email = Auth::user()->email;
        $cardAmount = Cart::where('user_email',$user_email)->get();
        $userCart = json_decode(json_encode($cardAmount),true);

        foreach($userCart as $product){
            $productPrice = ProductAttributes::where(['product_id'=>$product['product_id'],'size'=>$product['size']])->first();
            $priceArray[] = $productPrice->price * $product['quantity'];
        }
        $grant_total = array_sum($priceArray) - Session::get('CouponAmount') + Session::get('ShippingCharge');
        return $grant_total;

    }
        
}
