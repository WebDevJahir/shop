<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function addCoupon(Request $request){
    	$data = $request->all();
    	if(empty($request->status)){
    		$status = 0;
    	}else{
    		$status = 1;
    	}

    	if($request->isMethod('post')){
    		$addCoupon = new Coupon;
    		$addCoupon->coupon_code = $data['coupon_code'];
    		$addCoupon->amount = $data['amount'];
    		$addCoupon->amount_type = $data['amount_type'];
    		$addCoupon->expiry_date = $data['expiry_date'];
    		$addCoupon->status = $status;
    		$addCoupon->save();
    		return redirect('/admin/view-coupons')->with('flash_message_success','Coupon Added Succesfully');
    	}
    	return view('admin.coupon.add_coupon');
    }

    public function viewCoupons(){
    	$coupons = Coupon::get();
    	return view('admin.coupon.view-coupons')->with(compact('coupons'));
    }

    public function editCoupon(Request $request,$id=null){
    	$coupon = Coupon::where(['id'=>$id])->first();
        $data = $request->all();
    	if($request->isMethod('post')){
    		$updateCoupon = Coupon::where(['id'=>$id])->update(['coupon_code'=>$data['coupon_code'],'amount'=>$data['amount'],'amount_type'=>$data['amount_type'],'expiry_date'=>$data['expiry_date'],'status'=>$data['status']]);
            return redirect('/admin/view-coupons')->with('flash_message_success','Coupon Updated Successfully');
    	}
    	return view('admin/coupon/edit-coupon')->with(compact('coupon'));
    }

    public function deleteCoupon($id){
        Coupon::findorfail($id)->delete();
        return redirect()->back()->with('flash_message_success','Coupon Deleted Successfully');
    }
}
