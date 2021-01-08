<?php $url = url()->current(); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if(preg_match("/dashboard/i",$url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    
    @if(Session::get('adminDetails')['categories_full_access']==1 || Session::get('adminDetails')['type']=="Admin")
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/category/i", $url)){ ?> style="display: block;" <?php } ?> >
        <li <?php if(preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-category')}}">Add Category</a></li>
        <li <?php if(preg_match("/view-categories/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-categories')}}">View Categories</a></li>
      </ul>
    </li>
    @else
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/category/i", $url)){ ?> style="display: block;" <?php } ?> >
        @if(Session::get('adminDetails')['categories_edit_access']==1 )
        <li <?php if(preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-category')}}">Add Category</a></li>
        @endif
        @if(Session::get('adminDetails')['categories_view_access']==1 || Session::get('adminDetails')['categories_edit_access']==1)
        <li <?php if(preg_match("/view-categories/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-categories')}}">View Categories</a></li>
        @endif
      </ul>
    </li>
    @endif

    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admins</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/admin/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-admin/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-admin')}}">Add Admin</a></li>
        <li <?php if(preg_match("/view-admins/i", $url)){ ?> class="active" <?php } ?>  ><a href="{{url('/admin/view-admins')}}">View Admins</a></li>
      </ul>
    </li>
    @endif
     @if(Session::get('adminDetails')['products_access']==1)
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/product/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-product')}}">Add Product</a></li>
        <li <?php if(preg_match("/view-products/i", $url)){ ?> class="active" <?php } ?>  ><a href="{{url('/admin/view-products')}}">View Products</a></li>
      </ul>
    </li>
    @endif
     @if(Session::get('adminDetails')['orders_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/orders/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/view-orders/i", $url)){ ?> class="active" <?php } ?>  ><a href="{{url('/admin/view-orders')}}">View Orders</a></li>
      </ul>
      <ul <?php if(preg_match("/orders/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/view-orders-charts/i", $url)){ ?> class="active" <?php } ?>  ><a href="{{url('/admin/view-orders-charts')}}">View Orders Charts</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/coupon/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-coupon/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-coupon')}}">Add Coupon</a></li>
        <li <?php if(preg_match("/view-coupons/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-coupons')}}">View Coupon</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/banner/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-banner/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-banner')}}">Add Banner</a></li>
        <li <?php if(preg_match("/view-banners/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-banners')}}">View Banners</a></li>
      </ul>
    </li>
    @endif
     @if(Session::get('adminDetails')['users_access']==1)
     <?php $baseurl = trim(basename($url)); ?>
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/view-users/i", $baseurl)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-users')}}">View Users</a></li>
        <li <?php if(preg_match("/view-users-charts/i", $baseurl)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-users-charts')}}">View Users Charts</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Page</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-cms-page/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-cms-page')}}">Add page</a></li>
        <li <?php if(preg_match("/view-cms-page/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-cms-page')}}">View Pages</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Currency</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-currency/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-currency')}}">Add Currency</a></li>
        <li <?php if(preg_match("/view-currency/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-currencies')}}">View Currencies</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Shipping Charge</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-shipping-charge/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/add-shipping-charge')}}">Add Shipping Charge</a></li>
        <li <?php if(preg_match("/view-shipping-charge/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-shipping-charge')}}">View Shipping Charge</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span></span>Enquiries<span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/view-enquiries/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-enquiries')}}">View Enquires</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['type']=='Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span></span>Newsletters Email<span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/user/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/view-subscribed-email/i", $url)){ ?> class="active" <?php } ?> ><a href="{{url('/admin/view-subscribed-email')}}">View Newsletters Email</a></li>
      </ul>
    </li>
    @endif
  </ul>
</div>
<!--sidebar-menu-->

