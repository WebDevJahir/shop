<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingCharge;

class ShippingController extends Controller
{
        public function shippingCharge(){
        $allShipping = ShippingCharge::get();
      //  $allShipping = json_decode(json_encode($allShipping));
        //echo "<pre>"; print_r($allShipping); die;
        return view('admin.shipping.view-shipping-charge')->with(compact('allShipping'));
    }

    public function addShippingCharge(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $addShipping = new ShippingCharge;
            $addShipping->country = $data['country'];
            $addShipping->shipping_charge = $data['shipping_charge0_500'];
            $addShipping->shipping_charge = $data['shipping_charge500_1000'];
            $addShipping->shipping_charge = $data['shipping_charge1000_2000'];
            $addShipping->shipping_charge = $data['shipping_charge2000_5000'];
            $addShipping->save();
            return redirect('admin/view-shipping-charge')->with('flash_message_success','Shipping Charge Added Successfully');
        }
        return view('admin.shipping.add-shipping-charge');
    }

    public function editShippingCharge(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            ShippingCharge::where('id',$id)->update(['country'=>$data['country'],'shipping_charge0_500'=>$data['shipping_charge0_500'],'shipping_charge500_1000'=>$data['shipping_charge500_1000'],'shipping_charge1000_2000'=>$data['shipping_charge1000_2000'],'shipping_charge2000_5000'=>$data['shipping_charge2000_5000']]);
            return redirect('admin/view-shipping-charge');
        }
        $singleShipping = ShippingCharge::where('id',$id)->first();
        return view('admin.shipping.edit-shipping-charge')->with(compact('singleShipping'));
    }

    public function deleteShippingCharge($id){
        ShippingCharge::findorfail($id)->delete();
        return redirect()->back()->with('flash_message_success','Shipping Charge Deleted Successfully');
    }
}
