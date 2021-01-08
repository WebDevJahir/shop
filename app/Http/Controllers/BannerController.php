<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Image;

class BannerController extends Controller
{
    public function addBanner(Request $request){
    	$data = $request->all();
    	if($request->isMethod('post')){
    		if(empty($request->status)){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		$addBanner = new Banner;
    		$addBanner->title = $data['title'];
    		$addBanner->link = $data['link'];
    		$addBanner->status = $status;


    		if($request->hasFile('image')){
    		$image_tmp = $request->file('image');
    		if($image_tmp->isValid()){
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path = 'images/fronted_image/banners/'.$filename;
    				$small_image_path = 'images/backend_image/banners/'.$filename;
    				Image::make($image_tmp)->resize(1140,340)->save($large_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				$addBanner->image = $filename; 
    			}
    		}
    		$addBanner->save();
    		return redirect('admin/add-banner')->with('flash_message_success', 'Banner Added Success');
    		


    	}
    	return view('admin.banners.add-banner');
    }

    public function viewBanners(){
    	$allBanner = Banner::get();
    	return view('admin.banners.view-banners')->with(compact('allBanner'));
    }

    public function editBanner(Request $request,$id){
    	$editBanner = Banner::where(['id'=>$id])->first();
    	$data = $request->all();
    	if($request->isMethod('post')){
    		if($request->status==0){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    
    	$large_image_path = "images/foronted_image/banners/";	
    	$small_image_path ="images/backend_image/banners/";

        if(file_exists($large_image_path)){
            unlink($large_image_path.$editBanner->image);
        }
        if(file_exists($small_image_path)){
            unlink($small_image_path.$editBanner->image);
        }
        if($request->hasFile('image')){
    			$image_tmp = $request->file('image');
    			if($image_tmp->isValid()){
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path = 'images/fronted_image/banners/'.$filename;
    				$small_image_path = 'images/backend_image/banners/'.$filename;
    				Image::make($image_tmp)->resize(1140,340)->save($large_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path); 
    			}
    		}else{
    			$filename = $data['current_image'];
    		}
    		$updateBanner = Banner::where(['id'=>$id])->update(['title'=>$data['title'],'link'=>$data['link'],'status'=>$status,'image'=>$filename]);
    		return redirect('/admin/view-banners')->with('flash_message_error','Banner Updated Successfully');

    	}
    	return view('admin.banners.edit-banner')->with(compact('editBanner'));
    }

    public function deleteBanner($id=null){
    	Banner::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Banner deleted Succesfully');
    }


}
