<?php 
use App\Http\Controllers\Controller;
use App\Product;
$mainCategories = Controller::mainCategories(); 

$cartCount = Product::cartCount();
?>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{asset('images/fronted_image/home/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canada</a></li>
                                    <li><a href="">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canadian Dollar</a></li>
                                    <li><a href="">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/wishlist')}}"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{url('checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i> Cart <span style="color:green"> {{$cartCount}} </span></a></li>
                                @if(empty(Auth::check()))
                                <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @else
                                <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.html" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @foreach($mainCategories as $cat)
                                    @if($cat->status=='1')
                                        <li><a href="{{url('products/'.$cat->url)}}">{{$cat->category_name}}</a></li>
                                    @endif
                                    @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="{{url('blog')}}">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('blog')}}">Blog List</a></li>
                                        <li><a href="{{url('blog-single')}}">Blog Single</a></li>
                                    </ul>
                                </li> 
                                <li><a href="{{url('404')}}">404</a></li>
                                <li><a href="{{url('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{url('/search-products')}}" method="post">
                                @csrf
                                <input type="text" name="product" placeholder="Search Product">
                                <button class="btn-small" type="submit" style="background:#FE980F; color:white; padding: 6px; border: none; margin-left: -5px;" >Go</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header>
