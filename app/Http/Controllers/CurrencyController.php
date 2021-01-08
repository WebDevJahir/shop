<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function addCurrency(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if($data['status']==1){
    			$status = 1;
    		}else{
    			$status = 0;
    		}
    		$currency = new Currency();
    		$currency->currency_code = $data['currency_code'];
    		$currency->exchange_rate = $data['exchange_rate'];
    		$currency->status = $status;
    		$currency->save();
    		return redirect()->back()->with('flash_message_success','Currency Added Successfully');
    	}
    	return view('admin.currency.add-currency');
    }

    public function viewCurrencies(){
    	$currencies = Currency::get();
    	return view('admin.currency.view-currency')->with(compact('currencies'));
    }

    public function editCurrency(Request $request,$id){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if(!empty($data['status'])){
    			$status = 1;
    		}else{
    			$status = 0;
    		}
    		Currency::where('id',$id)->update(['currency_code'=>$data['currency_code'],'exchange_rate'=>$data['exchange_rate'],'status'=>$status]);
    		return redirect('/admin/view-currencies')->with('flash_message_success','Currency Updated Succecssfully');
    	}
    	$currency = Currency::where('id',$id)->first();
    	return view('admin.currency.edit-currency')->with(compact('currency'));
    }

    public function deleteCurrency($id){
    	Currency::findorfail($id)->delete();
    	return redirect()->back()->with('flash_message_success','Currency Deleted Successfully');
    }
}

