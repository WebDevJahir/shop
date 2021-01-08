<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cmspage;
use App\Category;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class CmsController extends Controller
{
    public function addCmsPage(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if($data['status'] == 1){
    			$status = 1;
    		}else{
    			$status = 0;
    		}
    		if(empty($data['meta_title'])){
    			$meta_title = "";
    		}else{
    			$meta_title = $data['meta_title'];
    		}
    		if(empty($data['meta_description'])){
    			$meta_description = "";
    		}else{
    			$meta_description = $data['meta_description'];
    		}
    		if(empty($data['meta_keywords'])){
    			$meta_keywords = "";
    		}else{
    			$meta_keywords = $data['meta_keywords'];
    		}

    		$addcms = new Cmspage();
    		$addcms->title = $data['title'];
    		$addcms->url = $data['url'];
    		$addcms->description = $data['description'];
    		$addcms->meta_title = $meta_title;
    		$addcms->meta_description = $meta_description;
    		$addcms->meta_keywords = $meta_keywords;
    		$addcms->status = $status;
    		$addcms->save();
    		return redirect()->back()->with('flash_message_success','Pages added successfully');
    	}
    	return view('admin.pages.add-cms-page');
    }

    public function viewCmsPages(){
    	$pages = Cmspage::get();
    	return view('admin.pages.view-cms-pages')->with(compact('pages'));
    }

    public function editCmspage(Request $request,$id){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if(empty($data['status'])){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		if(empty($data['meta_title'])){
    			$meta_title = "";
    		}else{
    			$meta_title = $data['meta_title'];
    		}
    		if(empty($data['meta_description'])){
    			$meta_description = "";
    		}else{
    			$meta_description = $data['meta_description'];
    		}
    		if(empty($data['meta_keywords'])){
    			$meta_keywords = "";
    		}else{
    			$meta_keywords = $data['meta_keywords'];
    		}

    	$updatepage = Cmspage::where('id',$id)->update(['title'=>$data['title'],'url'=>$data['url'],'meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keywords'=>$meta_keywords,'description'=>$data['description'],'status'=>$status]);
    	return redirect('/admin/view-cms-page')->with('flash_message_success','Pages Updated Successfully');

    	}
    	$page = Cmspage::where('id',$id)->first();
    	return view('admin.pages.edit-cms-page')->with(compact('page'));
    }

    public function deleteCmsPage($id){
    	Cmspage::findorfail($id)->delete();
    	return redirect()->back()->with('flash_message_success', 'Page Delete Successfully');
    }

    public function cmsPage($url){
    	$cmsPageDetails = Cmspage::where('url',$url)->where('status',1)->count();
    	if($cmsPageDetails){
    		$cmsPageDetails = Cmspage::where('url',$url)->where('status',1)->first();
    		$meta_title = $cmsPageDetails->meta_title;
    		$meta_description = $cmsPageDetails->meta_description;
    		$meta_keywords = $cmsPageDetails->meta_keywords;
    	}else{
    		abort(404);
    	}
    	$category = Category::with('categories')->where(['parent_id'=>0])->get();
    	return view('admin.pages.cms-page')->with(compact('cmsPageDetails','category','meta_title','meta_description','meta_keywords'));
    }

    public function contact(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();

    		$validateData = Validator::make($request->all(),[
    			'name' => 'required|regex:/^[\pL\s\-]+$/u|max:225',
    			'email' => 'required|email',
    			'subject' => 'required',
    		]);
    		if($validate = $validateData->fails()){
    			return redirect()->back()->withErrors($validate)->withInput();
    		}
            $addEnquiry = new Contact;
            $addEnquiry->name = $data['name'];
            $addEnquiry->email = $data['email'];
            $addEnquiry->subject = $data['subject'];
            $addEnquiry->message = $data['message'];
            $addEnquiry->save();
            return redirect()->back()->with('flash_message_success','Message Sent Successfully');


    	}
    	$meta_title = "E-shop Sample Website";
		$meta_description  = "Online Shopping Site for Men, Women and Kids Clothing";
		$meta_keywords = "Eshop website, online-shopping, men-clothing";
    	$category = Category::with('categories')->where(['parent_id'=>0])->get();
    	return view('contact-us')->with(compact('category','meta_title','meta_description','meta_keywords'));
    }
}
