<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if(Session::get('adminDetails')['categories_full_access']==0){

        }elseif(Session::get('adminDetails')['categories_edit_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }else{
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($request['status'])){
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

    		$category = new Category;
    		$category->category_name = $data['category_name'];
    		$category->parent_id = $data['parent_id'];
    		$category->description = $data['description'];
    		$category->url = $data['url'];
            $addcms->meta_title = $meta_title;
            $addcms->meta_description = $meta_description;
            $addcms->meta_keywords = $meta_keywords;
            $category->status = $status;
    		$category->save();
    		return redirect('admin/view-categories')->with('flash_message_success','Category Added Successfully');
    	}
    }
    	$parent = Category::where(['parent_id'=>'0'])->get();
    	return view('admin.categories.add_category')->with(compact('parent'));
    }

    public function viewCategory(){
    	$categories = Category::get();
    	return view('admin.categories.view-categories', compact('categories'));

    }

    public function editCategory(Request $request, $id=null){
        if(Session::get('adminDetails')['categories_full_access']==0 || Session::get('adminDetails')['categories_edit_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
    	if($request->isMethod('post')){
    		$data = $request->all();
            if(empty($request['status'])){
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
    		Category::where(['id'=>$id])->update(['category_name'=>$data['category_name'],'parent_id'=>$data['parent_id'],'meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keywords'=>$meta_keywords,'description'=>$data['description'],'url'=>$data['url'],'status'=>$status]);
    		return redirect('admin/view-categories')->with('flash_message_success','Category Updated Successfully');

    		// $category = Category::findorfail($id);
    		// $category->category_name = $request->category_name;
    		// $category->description = $request->description;
    		// $category->url = $request->url;
    		// $category->save();
    		// return redirect('admin/view-categories')->with('flash_message_success','Category Updated Successfully');

    	}
    	$category = Category::where('id',$id)->first();
    	$parents = Category::where(['parent_id'=>'0'])->get();
    	return view('admin.categories.edit_category')->with(compact('category','parents'));
    }

    public function deleteCategory($id=null){
    	if(!empty($id)){
    		// Category::findorfail($id)->delete();
    		Category::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Category Deleted Successfully');

    	}
    }
}
