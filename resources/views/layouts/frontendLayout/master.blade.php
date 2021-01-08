<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>@if($meta_title) {{$meta_title}} @else Home | E-Shopper @endif</title>
    @if(!empty($meta_description))<meta name="description" content="{{$meta_description}}"/> @endif
    @if(!empty($meta_keywords)) <meta name="keywords" content="{{$meta_keywords}}"/> @endif
    <link href="{{asset('css/fronted_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/easyzoom.css')}}" rel="stylesheet">
    <link href="{{asset('css/fronted_css/passtrength.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('images/ico/favicon.ico')}}">
    <link rel="{{asset('apple-touch-icon-precomposed')}}" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="{{asset('apple-touch-icon-precomposed')}}" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="{{asset('apple-touch-icon-precomposed')}}" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="{{asset('apple-touch-icon-precomposed')}}" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
@include('layouts.frontendLayout.frontend_header')


@yield('content')


@include('layouts.frontendLayout.frontend_footer')


  
    <script src="{{asset('js/fronted_js/jquery.js')}}"></script>
    <script src="{{asset('js/fronted_js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/fronted_js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/fronted_js/price-range.js')}}"></script>
    <script src="{{asset('js/fronted_js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/fronted_js/main.js')}}"></script>
    <script src="{{asset('js/fronted_js/easyzoom.js')}}"></script>
    <script src="{{asset('js/fronted_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/fronted_js/passtrength.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f1733aa88f556af"></script>
      <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5f1737a86925780012922cd0&product=inline-share-buttons" async="async"></script>
  <script>
      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
        <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>
</body>
</html>