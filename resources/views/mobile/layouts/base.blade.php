<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="stylesheet" type="text/css" href="/home/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/home/css/swiper.min.css"/>
    <script src="/home/js/flexible.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/jquery.mobile-events.min.js" type="text/javascript" charset="utf-8"></script>
    <title>{{ config('app.name') }}</title>
    @yield('css')
</head>
<body>
<!-- header -->
@include("home.layouts._head")
<div style="height: 50px;"></div>


<!-- content start -->
@yield('content')
<!-- content end -->


<!-- footer -->
@include("home.layouts._footer")

<script type="text/javascript">
    $('.menu').on('tap',function(){
        if($('.menuCont').hasClass('menuContIn')){
            $('.menuCont').removeClass('menuContIn')
        }else{
            $('.menuCont').addClass('menuContIn')
        }
    })
    $('.menuClose').on('tap',function(){
        $('.menuCont').removeClass('menuContIn')
    })
    $('.menuBox').on('click','.menuBoxLinksSpan',function(e){
        // e.preventDefault()
        if($(this).hasClass('menuBoxLinksOn')){
            $('.menuBoxLinksOn').removeClass('menuBoxLinksOn')
        }else{
            $('.menuBoxLinksOn').removeClass('menuBoxLinksOn')
            $(this).parent().addClass('menuBoxLinksOn')
        }
    })

    var idexSwiper = new Swiper('.idexSwiper', {
        autoplay: true,
        autoHeight: true, //高度随内容变化
    })
    var midSwiper = new Swiper('.midSwiper', {
        slidesPerView : 2,
        navigation: {
            nextEl: '.arrow-left',
            prevEl: '.arrow-right',
        },
    })
    $('.advantageNav').on('tap','div',function(){
        if(!$(this).hasClass('advantageNavOn')){
            $('.advantageNavOn').removeClass('advantageNavOn')
            $(this).addClass('advantageNavOn')
        }
    })
</script>
@yield('js')
</body>
</html>







