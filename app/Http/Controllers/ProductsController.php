<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Exports\productExport;
use View;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductAttributes;
use App\ProductsImage;
use App\Coupon;
use DB;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Banner;
use Dompdf\Dompdf;
use Carbon\Carbon;
use App\Cart;
class ProductsController extends Controller
{
    public function addproduct(Request $request){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
    	if($request->isMethod('post')){
            if(empty($request->status)){
                $status = 0;
            }else{
                $status = 1;
            }
            if(empty($request->feature_item)){
                $feature_item = 0;
            }else{
                $feature_item = 1;
            }
    		$product = $request->all();
    		$add_product = new Product;
    		$add_product->category_id = $product['category_id'];
    		$add_product->product_name = $product['product_name'];
    		$add_product->product_code = $product['product_code'];
    		$add_product->product_color = $product['product_color'];
    		$add_product->description = $product['description'];
            $add_product->care = $product['care'];
            $add_product->price = $product['price'];
            $add_product->sleeve = $product['sleeve'];
            $add_product->pattern = $product['pattern'];
            $add_product->weight = $product['weight'];
            $add_product->status = $status;
    		$add_product->feature_item = $feature_item;
    		
    		//Upload Image
    		if($request->hasFile('image')){
    			$image_tmp = $request->file('image');
    			if($image_tmp->isValid()){
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path = 'images/backend_image/products/large/'.$filename;
    				$medium_image_path = 'images/backend_image/products/medium/'.$filename;
    				$small_image_path = 'images/backend_image/products/small/'.$filename;
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				$add_product->image = $filename; 
    			}
    		}         
            if($request->hasFile('video')){
                $video_tmp = $request->file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'video/';
                $video_tmp->move($video_path,$video_name);
                $add_product->video = $video_name;           
            }

    		$add_product->save();
    		return redirect('admin/view-products')->with('flash_message_success', 'Product Added Success');
    	}

    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $category){
    		$categories_dropdown .= "<option value='".$category->id."'>".$category->category_name."</option>";
    		$sub_cat = Category::where(['parent_id'=>$category->id])->get();
    		foreach($sub_cat as $sub_categories){
    			$categories_dropdown .= "<option value='".$sub_categories->id."'>&nbsp;--&nbsp;".$sub_categories->category_name."</option>";
    		}
    	}
        $sleeveArray = array('full-sleeve','half-sleeve','short-sleeve','sleeveless');
        $patternArray = array('Checked','Plain','Printed','Self','Solid');
    	return view('admin.products.add_product')->with(compact('categories_dropdown','sleeveArray','patternArray'));
    }



    public function viewProducts(){
    	$products = Product::get();
    	foreach($products as $key => $val){
    		$category_name = Category::where(['id'=>$val->category_id])->first();
    		$products[$key]->category_name = $category_name->category_name;
    	}
    	return view('admin.products.view_product')->with(compact('products'));
    }


    public function editProduct(Request $request, $id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
    	$data = $request->all();
    	if($request->isMethod('post')){
            if(empty($request->status)){
                $status = 0;
            }else{
                $status = 1;
            }

            if(empty($request->feature_item)){
                $feature_item = 0;
            }else{
                $feature_item = 1;
            }

    		if($request->hasFile('image')){
    			$image_tmp = $request->file('image');
    			if($image_tmp->isValid()){
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path = 'images/backend_image/products/large/'.$filename;
    				$medium_image_path = 'images/backend_image/products/medium/'.$filename;
    				$small_image_path = 'images/backend_image/products/small/'.$filename;
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path); 
    			}
    		}else{
    			$filename = $data['current_image'];
    		}

            if($request->hasFile('video')){
                $video_tmp = $request->file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'video/';
                $video_tmp->move($video_path,$video_name);
                $videoName = $video_name;           
            }elseif(!empty($data['current_video'])){
                $videoName = $data['current_video'];
            }else{
                $videoName = "";
            }

    		$editProduct = Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'sleeve'=>$data['sleeve'],'pattern'=>$data['pattern'],'weight'=>$data['weight'],'status'=>$status,'feature_item'=>$feature_item,'image'=>$filename,'video'=>$videoName]);
    		return redirect('admin/view-products')->with('flash_message_success','Product has been updated');

    	}

    	$product = Product::where('id',$id)->first();
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $category){
    		if($category->id == $product->category_id){
    			$selected = "selected";
    		}else{
    			$selected = "";
    		}
    		$categories_dropdown .= "<option value='".$category->id."' ".$selected.">".$category->category_name."</option>";
    		$sub_cat = Category::where(['parent_id'=>$category->id])->get();
    		foreach($sub_cat as $sub_categories){
    			if($sub_categories->id == $product->category_id){
    			$selected =  "selected";
    		}else{
    			$selected = "";
    		}
    			$categories_dropdown .= "<option value='".$sub_categories->id."' ".$selected.">&nbsp;--&nbsp;".$sub_categories->category_name."</option>";
    		}
    	}
        $sleeveArray = array('full-sleeve','half-sleeve','short-sleeve','sleeveless');
        $patternArray = array('Checked','Plain','Printed','Self','Solid');
    	return view('admin.products.edit_product')->with(compact('product','categories_dropdown','sleeveArray','patternArray'));
    }


    public function deleteProductImage($id){
    	$productImage = Product::where(['id'=>$id])->first();

        $large_image_path ="images/backend_image/products/large/";
        $medium_image_path ="images/backend_image/products/medium/";
        $small_image_path ="images/backend_image/products/small/";

        if(file_exists($large_image_path)){
            unlink($large_image_path.$productImage->image);
        }
        if(file_exists($medium_image_path)){
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists($small_image_path)){
            unlink($small_image_path.$productImage->image);
        }

    	return redirect()->back()->with('flash_message_success','Product Image has been deleted');
    }

        public function deleteProductVideo($id){
            $productVideo = Product::where(['id'=>$id])->first();
            $video_path = "video/";

            if(file_exists($video_path.$productVideo->video)){
                unlink($video_path.$productVideo->video);
            }
            Product::where('id',$id)->update(['video'=>'']);
            return redirect()->back()->with('flash_message_success','Video Deleted Successfully');
    }


    public function deleteProduct($id){
    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Product Deleted Successfully');
    }

    public function addAtrributes(Request $request,$id=null){
        $product = Product::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['sku'] as $key => $value) {
                /*Check for Duplicate Size*/
                if(!empty($value)){
                    $attrCheck = ProductAttributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCheck>0){
                       return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','This Size Already Exist!');
                    }
                     /*Check for Duplicate SKU*/
                     
                    $attrCheck = ProductAttributes::where('sku',$value)->count();
                    if($attrCheck>0){
                       return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','This SKU Already Exist!');
                    }
                    $attributes = new ProductAttributes;
                    $attributes->product_id = $id;
                    $attributes->sku = $value;
                    $attributes->size = $data['size'][$key];
                    $attributes->price = $data['price'][$key];
                    $attributes->stock = $data['stock'][$key];
                    $attributes->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success','Product attributes has been added successfully');
        }
        return view('admin.products.add-attributes')->with(compact('product'));
    }

    public function editAtrributes(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();

            foreach($data['idAttr'] as $key => $attr){
                ProductAttributes::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_message_success','Product Attribues has been updated');
        }
    }

    public function addProductImages(Request $request,$id){
        $product = Product::with('images')->where(['id'=>$id])->first();

        if($request->isMethod('post')){
            $data = $request->all();
        if($request->hasfile('image')){
            $files = $request->file('image');
            foreach($files as $file){
            $saveimage = new ProductsImage;
            $extention = $file->getClientOriginalExtension();
            $filename = rand(111,99999).'.'.$extention;
            $large_image_path = 'images/backend_image/products/large/'.$filename;
            $medium_image_path = 'images/backend_image/products/medium/'.$filename;
            $small_image_path = 'images/backend_image/products/small/'.$filename;
            Image::make($file)->save($large_image_path);
            Image::make($file)->resize(600,600)->save($medium_image_path);
            Image::make($file)->resize(300,300)->save($small_image_path);
            $saveimage->image = $filename;
            $saveimage->product_id = $data['product_id'];
            $saveimage->save();
        }
            return redirect('admin/view-products')->with('flash_message_success','Product Images has been added successfully');
        }
        }


        return view('admin.products.add_images')->with(compact('product'));
    }

    public function deleteImages($id){
        $productImage = ProductsImage::where(['id'=>$id])->first();

        $large_image_path ="images/backend_image/products/large/";
        $medium_image_path ="images/backend_image/products/medium/";
        $small_image_path ="images/backend_image/products/small/";

        if(file_exists($large_image_path)){
            unlink($large_image_path.$productImage->image);
        }
        if(file_exists($medium_image_path)){
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists($small_image_path)){
            unlink($small_image_path.$productImage->image);
        }
        $productImage = ProductsImage::findorfail($id)->delete();

        return redirect()->back()->with('flash_message_success','Product Image has been deleted');
    }


    public function deleteAttributes($id){
        ProductAttributes::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Attributes deleted successfully');
    }

    public function products($url=null){

        $category_count = Category::where(['url'=>$url,'status'=>1])->count();
        if($category_count == 0){
            return redirect('404');
        }

        /* This query to show the category and the sub category for the sidebar */
        $category_all = Category::with('categories')->where(['parent_id'=>0])->get();

        /* for the url category to show listing product*/
        $category = Category::where(['url'=>$url])->first();
        $meta_title = $category->meta_title;
        $meta_description = $category->meta_description;
        $meta_keywords = $category->meta_keywords;

        if($category->parent_id==0){
            $subCategories = Category::where(['parent_id'=>$category->id])->get();

            foreach($subCategories as $subCat){
                $cat_id[] = $subCat->id;
            }
            $product_all = Product::whereIn('products.category_id',$cat_id)->where(['products.status'=>1])->orderBy('products.id','desc');
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$category->url."'>".$category->category_name."</a>";
            
        }else{

        /* This query for get the product as url which come from category variable */
        $product_all = Product::where(['products.category_id'=>$category->id])->where(['products.status'=>1])->orderBy('products.id','desc');
        $mainCategory = Category::where('id',$category->parent_id)->first();
          $breadcrumb = "<a href='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->category_name."</a> / <a href='".$category->url."'>".$category->category_name."</a>";
    }

        if(!empty($_GET['color'])){
            $colorArray = explode('-', $_GET['color']);
            $product_all = $product_all->whereIn('product_color',$colorArray);
        }
        if(!empty($_GET['sleeve'])){
            $sleeveArray = explode('_', $_GET['sleeve']);
            $product_all = $product_all->whereIn('sleeve',$sleeveArray);
        }
        if(!empty($_GET['pattern'])){
            $patternArray = explode('-', $_GET['pattern']);
            $product_all = $product_all->whereIn('pattern',$patternArray);
        }
        if(!empty($_GET['size'])){
            $sizeArray = explode('-', $_GET['size']);
            $product_all = $product_all->join('product_attributes','product_attributes.product_id','=','products.id')
            ->select('products.*','product_attributes.product_id','product_attributes.size')
            ->whereIn('product_attributes.size',$sizeArray);
        }
        $product_all = $product_all->paginate(6);
        $colorArr = Product::select('product_color')->groupBy('product_color')->get();
        $colorArr = Array_flatten(json_decode(json_encode($colorArr),true));
        $sleeveArray = Product::select('sleeve')->groupBy('sleeve')->get();
        $sleeveArray = Array_flatten(json_decode(json_encode($sleeveArray),true));
        $patternArray = Product::select('pattern')->groupBy('pattern')->get();
        $patternArray = Array_flatten(json_decode(json_encode($patternArray),true));
        $sizeArray = ProductAttributes::select('size')->groupBy('size')->get();
        $sizeArray = Array_flatten(json_decode(json_encode($sizeArray),true));
        $banners = Banner::where(['status'=>1])->get();
        return view('products.listing')->with(compact('category','product_all','category_all','banners','meta_title','meta_keywords','meta_description','url','colorArr','sleeveArray','patternArray','sizeArray','breadcrumb'));
    }

    public function searchProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $category_all = Category::with('categories')->where('parent_id',0)->get();
            $meta_title = "Search Product";
            $meta_description = "Related Product by search Category";
            $meta_keywords = $data['product'];
            $search_product = $data['product'];
            // $product_all = Product::where('product_name','like','%'.$search_product.'%')->orWhere('product_code',$search_product)->where('status',1)->paginate();
            $product_all = Product::where(function($query) use($search_product){
                $query->where('product_name','like','%'.$search_product.'%')
                ->orWhere('product_code','like','%'.$search_product.'%')
                ->orWhere('description','like','%'.$search_product.'%')
                ->orWhere('product_color','like','%'.$search_product.'%');
            })->where('status',1)->paginate();
            $colorArr = Product::select('product_color')->groupBy('product_color')->get();
        $colorArr = Array_flatten(json_decode(json_encode($colorArr),true));
        $sleeveArray = Product::select('sleeve')->groupBy('sleeve')->get();
        $sleeveArray = Array_flatten(json_decode(json_encode($sleeveArray),true));
        $patternArray = Product::select('pattern')->groupBy('pattern')->get();
        $patternArray = Array_flatten(json_decode(json_encode($patternArray),true));
        $sizeArray = ProductAttributes::select('size')->groupBy('size')->get();
        $sizeArray = Array_flatten(json_decode(json_encode($sizeArray),true));
        $breadcrumb = "<a href='/'>Home</a> / ".$search_product;
            $banners = Banner::where(['status'=>1])->get();
            return view('products.listing')->with(compact('category_all','product_all','search_product','banners','meta_title','meta_keywords','meta_description','colorArr','sleeveArray','patternArray','sizeArray','breadcrumb'));
        }
    }

    public function product($id=null){
        $product = Product::with('attributes')->where(['id'=>$id])->first();
        $meta_title = $product->product_name;
        $meta_description = $product->description;
        $meta_keywords = $product->product_name;
        $relatedProduct = Product::where('id','!=',$id)->where(['category_id'=>$product->category_id])->where(['status'=>1])->get();
        // echo "<pre>"; print_r($relatedProduct); die;
        $category = Category::with('categories')->where(['parent_id'=>0])->get();


        /* for the url category to show listing product*/
        $categoryDetails = Category::where('id',$product->category_id)->first();
        if($categoryDetails->parent_id==0){
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->category_name."</a> /".$product->product_name;
        }else{
            //echo "<pre>"; print_r($categoryDetails); die;
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->category_name."</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->category_name."</a> / ".$product->product_name;
        }
        $productImage = ProductsImage::where('product_id',$id)->get();
        $totalStock = ProductAttributes::where(['product_id'=>$id])->sum('stock');
        return view('products.product-details')->with(compact('product','category','productImage','totalStock','relatedProduct','meta_title','meta_keywords','meta_description','breadcrumb'));

    }

    public function filter(Request $request){
        $data = $request->all();
       // echo "<pre>"; print_r($data); 

        $colorUrl="";
        if(!empty($data['colorFilter'])){
            foreach($data['colorFilter'] as $color){
                if(empty($colorUrl)){
                    $colorUrl = "&color=".$color;
                }else{
                    $colorUrl .= "-".$color;
                }
            }
        }

        $sleeveUrl ="";
        if(!empty($data['sleeveFilter'])){
            foreach($data['sleeveFilter'] as $sleeve){
                if(empty($sleeveUrl)){
                    $sleeveUrl = "&sleeve=".$sleeve;
                }else{
                    $sleeveUrl .="_".$sleeve;
                }
            }
        }
        $patternUrl ="";
        if(!empty($data['patternFilter'])){
            foreach($data['patternFilter'] as $pattern){
                if(empty($patternUrl)){
                    $patternUrl = "&pattern=".$pattern;
                }else{
                    $patternUrl .="-".$pattern;
                }
            }
        }
        $sizeUrl ="";
        if(!empty($data['sizeFilter'])){
            foreach($data['sizeFilter'] as $size){
                if(empty($patternUrl)){
                    $sizeUrl = "&size=".$size;
                }else{
                    $sizeUrl .="-".$size;
                }
            }
        }

        $finalUrl = "products/".$data['url']."?".$colorUrl.$sleeveUrl.$patternUrl.$sizeUrl;
        return redirect::to($finalUrl);
    }


    public function getProductPrice(Request $request){
        $data = $request->all();

        $product_attributes = explode("-",$data['idSize']);

        $product_attributes = ProductAttributes::where(['product_id'=>$product_attributes[0],'size'=>$product_attributes[1]])->first();
        $getCurrencyRates = Product::getCurrencyRates($product_attributes->price);
        echo $product_attributes->price."-".$getCurrencyRates['USD_Rate']."-".$getCurrencyRates['EUR_Rate']."-".$getCurrencyRates['GBP_Rate'];
        echo "#";
        echo $product_attributes->stock;
    }

    public function addtoCart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        //echo $data['wishButton']; die;

        if(!empty($data['wishButton']) && $data['wishButton']=="wish list"){

            if(!Auth::check()) {
                return redirect()->back()->with('flash_message_error','Please login to add product in your wish list');
            }

            if(empty($data['size'])){
                return redirect()->back()->with('flash_message_error','Please select size to add product in you wish list');
            }
            /*Get User Email/Username*/
            $user_email = Auth::user()->email;

            $sizeIDArr = explode('-', $data['size']);
            $product_size = $sizeIDArr[1];

            $addedproduct = DB::table('wish_lists')->where(['user_email'=>$user_email,'product_id'=>$data['product_id'],'size'=>$product_size])->count();

            if ($addedproduct>0) {
                return redirect()->back()->with('flash_message_error','Product already added to your wishlists');
            }

            

            $proPrice = ProductAttributes::where(['product_id'=>$data['product_id'], 'size'=>$product_size])->first();
            $product_price = $proPrice->price;


            /*Get Current Date*/
            $quantity = 1;
            /*Get Current Date*/
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('wish_lists')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'price'=>$product_price,'size'=>$product_size,'quantity'=>$quantity,'user_email'=>$user_email,'created_at'=>$created_at]);
            return redirect()->back()->with('flash_message_success','Product has been added in Wish List');
            

        }else{

        $product_size = explode('-',$data['size']);
      //  echo "<pre>"; print_r($product_size); die;
        $getProductStock = ProductAttributes::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();

        /*Delete Wishlist Product*/

        if($getProductStock->stock<$data['quantity']){
            return redirect()->back()->with('flash_message_error','Required Quantity is not Available');
        }

        if(empty($data['user_email'])){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }
        $session_id = Session::get('session_id');
        if(empty($session_id)) {
            $session_id = Str::random(40);
            Session::put('session_id',$session_id);
        }

        /* From Javascript $size variable get the array. by explode we get the size */
        $size = explode('-', $data['size']);
        $product_size = $size[1];
        if(empty(Auth::check())){
        $ExitcartItem = DB::table('carts')->where(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_color'=>$data['product_color'],'size'=>$product_size,'session_id'=>$session_id])->count();
        if($ExitcartItem>0){
            return redirect('cart')->with('flash_message_error','Product Already has been added in cart');
            }
        }else{
            $ExitcartItem = DB::table('carts')->where(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_color'=>$data['product_color'],'size'=>$product_size,'user_email'=>Auth::user()->email])->count();
        if($ExitcartItem>0){
            return redirect('cart')->with('flash_message_error','Product Already has been added in cart');
            }
        }

        $getSKU = ProductAttributes::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$size[1]])->first();
        DB::table('carts')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$size[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        return redirect('cart')->with('flash_message_success','Product has been added in cart successfully');
            }
        }   
    

    public function cart(){
         $session_id = Session::get('session_id');
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('carts')->where('user_email',$user_email)->orWhere('session_id',$session_id)->get();
        }else{
            $userCart = DB::table('carts')->where('session_id',$session_id)->get();
        }
        //echo "<pre>"; var_dump($userCart); die;      
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        $meta_title = "Shopping_cart - Onling Shopping";
        $meta_description = "View Shopping Cart - Online Shopping";
        $meta_keywords = "Shopping Cart - Online Shopping";

        return view('products.cart')->with(compact('userCart','meta_title','meta_description','meta_keywords'));
    }

    public function deleteCartItem($id=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('carts')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Cart Item Deleted Succesfully');
    }

    public function updateCartQuantity($id=null, $quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('carts')->where('id',$id)->first();
        $getAttributeStock = ProductAttributes::where(['size'=>$getCartDetails->size,'product_id'=>$getCartDetails->product_id])->first();
        $updated_quantity = $getCartDetails->quantity+$quantity;

        if($getAttributeStock->stock > $updated_quantity){
        DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
        return redirect('cart')->with('flash_message_success','Quantity updated successfully');
    }else{
        return redirect('cart')->with('flash_message_error','Stock does not enough');
    }
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error','Coupon is not Valid');
        }else{
            /*Get Coupon code Details*/
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();

            /*If Coupon is Inactive*/
            if($couponDetails->status == 0){
                return redirect()->back()->with('flash_message_error', "This coupon is not active");
            }

            // If coupon is Expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                 return redirect()->back()->with('flash_message_error', "This coupon is Expired");
            }

            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
            $total_amount = 0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            if($couponDetails->amount_type=='Fixed'){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success','Coupon code successfully aplied. you are availing discount!');
        }
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $country = Country::get();
        $countries = Country::get();
        $session_id = Session::get('session_id');
        DB::table('carts')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
        if($request->isMethod('post')){
            $data = $request->all();
            $pincodeCount = DB::table('pincodes')->where('pincode',$data['billing_pincode'])->count();
            if($pincodeCount > 0){
                $pincode = $data['billing_pincode'];
            }else{
                return redirect()->back()->with('flash_message_error','Your location is not available for delivery. Please Choose another location.');
            }
            if(empty($data['billing_name'])||empty($data['billing_address'])||empty($data['billing_city'])||empty($data['billing_state'])||empty($data['billing_country'])||empty($pincode)||empty($data['billing_mobile'])||empty($data['shipping_name'])||empty($data['shipping_address'])||empty($data['shipping_city'])||empty($data['shipping_state'])||empty($data['shipping_country'])||empty($data['shipping_pincode'])||empty($data['shipping_mobile'])){
                return redirect()->back()->with('flash_message_error','Fill up all the input');
            }
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);
            if($shippingCount>0){
                DeliveryAddress::where('user_id',$user_id)->update(['user_id'=>$user_id,'user_email'=>$user_email,'name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
            }else{
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->name = $data['shipping_name'];
                $shipping->save();
            }
            return redirect('/order-review');
        }
        $meta_title = "Check Out Page";
        $meta_keywords = "check out";
        $meta_description = "Check Out page description";
        return view('products.checkout',compact('userDetails','country','countries','meta_keywords','meta_title','meta_description'));
    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where(['user_id'=>$user_id])->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        //echo "<pre>"; print_r($shippingCharge); die;
        $session_id = Session::get('session_id');
        if(!empty(Auth::user()->id)){
            $user_email = Auth::user()->email;
            $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }else{
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        }
        $total_weight = 0;
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
            $total_weight = $total_weight + $productDetails->weight;
        }
        $shippingCharge = Product::getShippingCharges($total_weight,$shippingDetails->country);
        Session::put('shippingCharge',$shippingCharge);
        $meta_title = "Order Review";
        $meta_description = "Order Description";
        $meta_keywords = "order Keywords";
 
        return view('products.order-review')->with(compact('userDetails','shippingDetails','userCart','meta_title','meta_keywords','meta_description','shippingCharge'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            $userCart = DB::table('carts')->where('user_email',$user_email)->get();
            foreach($userCart as $cart){

                $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->size);
                if($getAttributeCount==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','One of the product is not available. Try again');
                }

                $productStock = Product::getProductStock($cart->product_id,$cart->size);
                if($productStock==0 || $productStock<$cart->quantity){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Cart updated due to Sold out product! Please try again later');
                }

                $product_status = Product::getProductStatus($cart->product_id);
                if($product_status==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Disabled Product removed from the cart! Please try again later');
                }
            }

            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
            $pincodeCount = DB::table('pincodes')->where('pincode',$shippingDetails['pincode'])->count();
            if($pincodeCount > 0){
                $pincode = $shippingDetails->pincode;
            }else{
                return redirect()->back()->with('Enter Valid Pincode');
            }

            if(empty(Session::get('CouponCode'))){
                $coupon_code = "";
            }else{
                $coupon_code = Session::get('CouponCode');
            }
            if(empty(Session::get('CouponAmount'))){
                $coupon_amount = "0.0";
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }

            $grand_total = Product::getGrandTotal();

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->shipping_charges = Session::get('shippingCharge');
            $order->grand_total = $grand_total;
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('carts')->where('user_email',$user_email)->get();
            foreach ($cartProducts as $order) {
                $addOrderProduct = new OrdersProduct;
                $addOrderProduct->order_id = $order_id;
                $addOrderProduct->user_id = $user_id;
                $addOrderProduct->product_id = $order->product_id;
                $addOrderProduct->product_code = $order->product_code;
                $addOrderProduct->product_name = $order->product_name;
                $addOrderProduct->product_color = $order->product_color;
                $addOrderProduct->product_size = $order->size;
                $price = Product::getProductPrice($order->product_id,$order->size);
                $addOrderProduct->product_price = $price;
                $addOrderProduct->product_quantity = $order->quantity;
                $addOrderProduct->save();

                $getProductStock = ProductAttributes::where('sku',$order->product_code)->first();
                $newStock = $getProductStock['stock'] - $order->quantity;
                ProductAttributes::where('sku',$order->product_code)->update(['stock'=>$newStock]);
            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$grand_total);

            if($data['payment_method']=="COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                $userDetails = User::where('id',$user_id)->first();
                $pincodeCount = DB::table('cod_pincodes')->where('pincode',$userDetails['pincode'])->count();
            if($pincodeCount == 0){
               return redirect()->back()->with('flash_message_error','Your location is not available for COD Payment. Please Choose another location.');
            }
                $userDetails = json_decode(json_encode($userDetails),true);
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('email.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - Online Shopping');
                });
                return redirect('/thanks');
            }elseif($data['payment_method']=="PayUmoney"){
                return redirect('/Payumoney');
            }
            else{
                return redirect('/paypal');
            }
            
        }
    }

    public function thanks(){
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        $meta_title = "Thanks";
        $meta_description = "Thanks";
        $meta_keywords = "Thanks";
        return view('products.thanks')->with(compact('meta_title','meta_keywords','meta_description'));
    }

    public function thanksPaypal(Request $request){
        return view('products.thanks_paypal');
    }
    public function paypal(){
        $meta_title = "Order Review";
        $meta_description = "Order Description";
        $meta_keywords = "order Keywords";
        return view('products.paypal')->with(compact('meta_title','meta_description','meta_keywords'));
    }

    public function cancelPaypal(){
        return view('products.cancel_paypal');
    }

    public function orders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->get();
        return view('products.order')->with(compact('orders'));
    }

    public function userOrderDetails($id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        return  view('products.user-order-details')->with(compact('orderDetails'));
    }

    public function viewOrders(){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        $orders = json_decode(json_encode($orders));
        return view('admin.orders.view-orders')->with(compact('orders'));
    }


    public function viewOrdersCharts(){
            $current_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
            $last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
            $last_to_last_month_order = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
            return view('admin.orders.view-orders-charts')->with(compact('current_month_orders','last_month_orders','last_to_last_month_order'));
    }

    public function viewOrderDetails($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

        public function viewOrderInvoice($order_id){
            if(Session::get('adminDetails')['orders_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.invoice')->with(compact('orderDetails','userDetails'));
    }

    public function viewPdfInvoice($order_id){
            if(Session::get('adminDetails')['orders_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();

        $viewhtml = View::make('admin.orders.pdf-invoice',compact('orderDetails','userDetails'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($viewhtml);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        // return view('')->with(compact('orderDetails','userDetails'));
    }

    public function updateOrderStatus(Request $request){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('admin/dashboard')->with('flash_message_error',"You have no access this module");
        }
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','Order Status has been updated successfully');
        }
    }

    public function checkPincode(Request $request){
      
          $data = $request->all();

        $pincodeCount = DB::table('pincodes')->where('pincode',$data['pincode'])->count();
        if($pincodeCount > 0){
            echo $pincodeCount;
        }else{
            echo $pincodeCount;
        }
    }

    public function productExport(){
        return Excel::download(new ProductExport,'Products.xlsx');
    }

    public function userWishlist(){
        $user_email = Auth::user()->email;

        $wishpro = DB::table('wish_lists')->where('user_email',$user_email)->get();

        foreach($wishpro as $key => $wishproducts){
            $productDetails = Product::where('id',$wishproducts->product_id)->first();
            $wishpro[$key]->image = $productDetails->image;
        }
        $meta_title = "Shopping_cart - Onling Shopping";
        $meta_description = "View Shopping Cart - Online Shopping";
        $meta_keywords = "Shopping Cart - Online Shopping";
        return view('products.wishlist')->with(compact('wishpro','meta_title','meta_description','meta_keywords'));
    }

    public function deleteWishProduct($id){
        $user_email = Auth::user()->email;
        $deleteWishProduct = DB::table('wish_lists')->where(['user_email'=>$user_email,'id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Wishlist Product deleted successfully');    
    }

    public function wishlistToCart($id){
        $wishproduct = DB::table('wish_lists')->where('id',$id)->first();
        $wishproduct = json_decode(json_encode($wishproduct));    

        $addToCart = new Cart;
        $addToCart->product_id = $wishproduct->product_id;
        $addToCart->product_name = $wishproduct->product_name;
        $addToCart->product_code = $wishproduct->product_code;
        $addToCart->product_color = $wishproduct->product_color;
        $addToCart->size = $wishproduct->size;
        $addToCart->price = $wishproduct->price;
        $addToCart->quantity = $wishproduct->quantity;
        $addToCart->user_email = $wishproduct->user_email;
        $addToCart->save();
        $wishproduct = DB::table('wish_lists')->where('id',$id)->delete();
        return redirect('/cart')->with('flash_message_success','Product successfully added to your cart from wishlist');
    }

}

