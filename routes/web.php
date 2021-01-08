<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Front View Route */


Route::get('/index','indexController@index');

/* Get Listing Product By Category url in listing page */

Route::get('/products/{url}','ProductsController@products');

/* Get Product By Id */
Route::get('/product/{url}','ProductsController@product');

/*Products Filter Page*/
Route::match(['get','post'],'products/filter','ProductsController@filter');

/* Products Sleeve Filter Page */

/* Get Product Price and and Size */
Route::get('/get-product-price','ProductsController@getProductPrice');

/* Add to Cart Page */
Route::match(['get','post'],'/add-cart','ProductsController@addtoCart');

/*Cart page with product list*/
Route::match(['get','post'],'/cart','ProductsController@cart');

/*Delete Prooduct from cart list*/
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartItem');

/*Update quantity in route page*/
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

/* Apply Coupon Code */
Route::match(['get','post'],'cart/apply-coupon','ProductsController@applyCoupon');

/* Admin Coupon Route */
Route::match(['get','post'],'/admin/add-coupon','CouponController@addCoupon');

Route::get('/admin/view-coupons','CouponController@viewCoupons');

Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponController@editCoupon');

Route::get('/admin/delete-coupon/{id}','CouponController@deleteCoupon');

/* User Account */
Route::group(['middleware'=>['frontLogin']],function(){
	Route::match(['get','post'],'/account','UserController@account');
	/* Check user password */
	Route::post('/check-user-password','UserController@checkUserPassword');
	/* Update user password */
	Route::post('/update-user-password','UserController@updateUserPassword');
	/* Check out */
	Route::match(['get','post'],'/checkout','ProductsController@checkout');
	/*Order review page*/
	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	/* Place Order */
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	/* Thanks Page after complete the product */
	Route::get('/thanks','ProductsController@thanks');
	/* Paypal Page for checkout */
	Route::get('/paypal','ProductsController@paypal');
	/* User View order page */
	Route::get('/orders','ProductsController@orders');
	/*Get User order details*/
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	/*Paypal thanks*/
	Route::get('/paypal/thanks','ProductsController@thanksPaypal');
	/*Cancel Paypal*/
	Route::get('/paypal/cancel', 'ProductsController@cancelPaypal');

	/*PayUmoney Route*/
	Route::get('Payumoney','PayumoneyController@payumoneyPayment');
	Route::get('payumoney/response/success','PayumoneyController@payumoneyResponse');
	Route::get('payumoney/thanks','PayumoneyController@payumoneyThanks');
	Route::get('payumoney/fail','PayumoneyController@payumoneyFail');
	/*User Wishlist Product*/
	Route::get('/wishlist','ProductsController@userWishlist');
	/*Delete User product*/
	Route::get('/wishlist/delete-product/{id}','ProductsController@deleteWishProduct');
	/* Wish list to Cart */
	Route::get('/addtocart/{id}','ProductsController@wishlistToCart');
});
/*User Register/Login*/
Route::get('/login-register','UserController@userLoginRegister');
Route::match(['get','post'],'forgot-password', 'UserController@forgotPassword');
Route::post('/user-register','UserController@register');
Route::get('/confirm/{code}','UserController@confirmAccount');
Route::post('/user-login','UserController@login');
Route::get('/user-logout','UserController@logout');

/*Search Product for users*/
Route::match(['get','post'],'/search-products', 'ProductsController@searchProduct');

/* Check email */
Route::match(['get','post'],'/check-email','UserController@checkEmail');

/* Check Pincode Availity*/
Route::post('/check-pincode','ProductsController@checkPincode');

/* Subscription Email Check */
Route::post('/check-subscriber-email','NewsletterController@checkSubscriberEmail');
Route::post('/add-subscriber-email','NewsletterController@addSubscriber');

Route::get('blog', function(){
	return view('blog');
});

Route::get('shop', function(){
	return view('shop');
});


// Route::get('admin', function(){
// 	return view('auth.login');
// });

Route::redirect('product-details','product');

Route::redirect('/', 'index');

//login route
Auth::routes();
Route::match(['get','post'],'/admin', 'AdminController@login');



Route::group(['middleware'=>['Adminlogin']],function(){

	/*Admin Route*/
	Route::match(['post','get'],'admin/add-admin','AdminController@addAdmin');
	Route::get('admin/view-admins','AdminController@viewAdmins');
	Route::match(['post','get'],'admin/edit-admin/{id}','AdminController@editAdmin');
	Route::get('admin/delete-admin/{id}','AdminController@deleteAdmin');


	/*Activity Route*/
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-password','AdminController@checkpassword');
	Route::match(['get','post'],'/admin/update-password', 'AdminController@updatepassword');

	//category route
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategory');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::get('/admin/delete-category/{id}','CategoryController@deleteCategory');

	//Product Route
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/view-products','ProductsController@viewProducts');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
	Route::get('/admin/delete-product-video/{id}', 'ProductsController@deleteProductVideo');
	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');

	/*Product Export*/
	Route::get('admin/export-products','ProductsController@productExport');
	//Product Attributes
	Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAtrributes');
	Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAtrributes');
	Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addProductImages');
	Route::get('/admin/delete-attributes/{id}','ProductsController@deleteAttributes');
	Route::get('/admin/delete-images/{id}','ProductsController@deleteImages');

	//Banner Route
	Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannerController@editBanner');
	Route::get('/admin/view-banners','BannerController@viewBanners');
	Route::get('/admin/delete-banner/{id}','BannerController@deleteBanner');

	/*Order Route*/
	Route::get('/admin/view-orders','ProductsController@viewOrders');

	/*Order Details Charts*/
	Route::get('admin/view-orders-charts','ProductsController@viewOrdersCharts');

	/*View Product Details*/
	Route::get('/admin/view-orders/{id}','ProductsController@viewOrderDetails');

	/*View Order Invoice*/
	Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');
	/*View Pdf Invoice*/
	Route::get('/admin/view-pdf-invoice/{id}','ProductsController@viewPdfInvoice');

	/* Update Order Status */
	Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');

	/*Admin User View*/
	Route::get('/admin/view-users','UserController@viewUsers');

	/*Admin User Charts View*/
	Route::get('/admin/view-users-charts','UserController@viewUsersCharts');

	/*User Country Charts*/
	Route::get('/admin/view-users-countries-charts','UserController@viewUsersCountriesCharts');

	/*User Export*/
	Route::get('/admin/export-users','UserController@userExport');

	/*Admin CMS page Create*/
	Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

	/*View CMS pages*/
	Route::get('/admin/view-cms-page','CmsController@viewCmsPages');

	/*Edit CMS pages*/
	Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

	/*Delete CMS Pages*/
	Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage');

	/*Currency Page*/
	Route::match(['get','post'],'/admin/add-currency','CurrencyController@addCurrency');
	Route::get('/admin/view-currencies','CurrencyController@viewCurrencies');
	Route::match(['get','post'],'/admin/edit-currency/{id}','CurrencyController@editCurrency');
	Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');

	/*Shipping Charge*/
	Route::match(['get','post'],'admin/add-shipping-charge','ShippingController@addShippingCharge');
	Route::get('/admin/view-shipping-charge','ShippingController@shippingCharge');
	Route::match(['get','post'],'admin/edit-shipping-charge/{id}','ShippingController@editShippingCharge');
	Route::get('/admin/delete-shipping-charge/{id}','ShippingController@deleteShippingCharge');

	/*Enquiry Route*/

	Route::get('admin/view-enquiries','UserController@allEnquiries');
	Route::match(['get','post'],'admin/reply-enquiry/{id}','UserController@replyEnquiries');
	Route::get('admin/delete-enquiry/{id}','UserController@deleteEnquiry');

	/*Newsletter Subscriber Route*/
	Route::get('admin/view-subscribed-email','NewsletterController@viewSubscribedEmail');
	Route::get('admin/delete-subscribed-email/{id}','NewsletterController@deleteSubscribedEmail');
	Route::get('admin/update-subscribed-email/{id}/{status}','NewsletterController@updateSubscribedEmail');
	Route::get('admin/export-newsletters-email','NewsletterController@exportNewsletters');

});

Route::get('/logout','AdminController@logout');

/* Display CMS Page */
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');
/* Display Contact Page */
//Route::match(['get','post'],'/contact','UserController@contact');

Route::match(['get','post'],'/contact','CmsController@contact');


