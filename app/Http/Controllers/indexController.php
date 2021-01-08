<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class indexController extends Controller
{
    public function index(){
    	$allProduct = Product::get();
    	$allProduct = Product::orderBy('id','DESC')->get();
    	$allProduct = Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(6);

    	$category_all = "";
    	$category = Category::with('categories')->where(['parent_id'=>0])->get();
  

   /* 		Different Method for Category and Subcategory
   			foreach($category as $cat){
    			$category_all .= "<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='#accordion' href='#".$cat->id."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$cat->category_name."
										</a>
									</h4>
								</div>
								<div id='".$cat->id."' class='panel-collapse collapse'>
									<div class='panel-body'>
										<ul>";
										$sub_category = Category::where(['parent_id'=>$cat->id])->get();
											foreach($sub_category as $sub_cat){
											$category_all .= "<li><a href='".$sub_cat->id."'>".$sub_cat->category_name."</a></li>";
										}
										$category_all .= "</ul>

									</div>
								</div>" ;
							}   */
				$banners = Banner::where(['status'=>1])->get();
				$meta_title = "E-shop Sample Website";
				$meta_description  = "Online Shopping Site for Men, Women and Kids Clothing";
				$meta_keywords = "Eshop website, online-shopping, men-clothing";

    	return view('index')->with(compact('allProduct','category','banners','meta_title','meta_description','meta_keywords'));

    }
}
