<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" type="text/css" href="/home/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/home/css/idangerous.swiper.css"/>
    <script src="/home/js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/idangerous.swiper.min.js" type="text/javascript" charset="utf-8"></script>
    <title>{{ config('app.name') }}</title>
    @yield('css')
    <style>
        .FootErweima{
            margin-right: 0;
            margin-left: 30px;
        }
        .footList{
            padding: 0 50px;
            width: 180px;
            box-sizing: border-box;
            overflow: hidden;
        }
        .footListLast{
            width: 300px;
        }
    </style>
</head>
<body>
<!-- header -->
<div id="header" class="{{$nav}}">
    @include("home.layouts._head")
</div>
<div style="height: 70px;"></div>


<!-- content start -->
@yield('content')
<!-- content end -->


<!-- footer -->
<div id="footer">
    @include("home.layouts._footer")
</div>
<script type="text/javascript">
    var mySwiper = new Swiper('.indexSwiper', {
        autoplay: 5000, //可选选项，自动滑动
        loop: true, //可选选项，开启循环
        autoplayDisableOnInteraction: false,
        calculateHeight: true,
        resizeReInit: true,
        pagination: '.paginations',
        paginationClickable: true,
    })
    var midSwiper = new Swiper('.indexMid', {
        autoplay: 5000, //可选选项，自动滑动
        // loop: true, //可选选项，开启循环
        autoplayDisableOnInteraction: false,
        paginationClickable: true,
        slidesPerView: 4
    })
    $('.arrow-left').on('click', function () {
        midSwiper.swipePrev()
    })
    $('.arrow-right').on('click', function () {
        midSwiper.swipeNext()
    })

    $('.headSearch').on('click', function () {
        if ($('.searchBox').hasClass('searchBoxOn')) {
            $('.searchBox').removeClass('searchBoxOn')
            $('.headSearch').removeClass('headSearchOn')
        } else {
            $('.searchBox').addClass('searchBoxOn')
            $('.headSearch').addClass('headSearchOn')
        }
    })

    // 华孕宝服务优势
    $('.saNav').on('mouseenter', 'div', function () {
        if (!$(this).hasClass('saNavOn')) {
            $('.saNavOn').removeClass('saNavOn')
            $(this).addClass('saNavOn')
            // 移入未选中的nav项触发，在这里做切换
            //包括左边的背景图
            $('.saContOn').removeClass('saContOn')
            $($('.saCont')[Number($(this).attr('data-i'))]).addClass('saContOn')
        }
    })
    // 底部选项卡 新闻切换
    $('.indexNewsNav').on('click', 'div', function () {
        if (!$(this).hasClass('indexNewsNavOn')) {
            $('.indexNewsNavOn').removeClass('indexNewsNavOn')
            $(this).addClass('indexNewsNavOn')
            // 移入未选中的nav项触发，在这里做切换
            //包括左边的背景图
            $('.indexNewsContOn').removeClass('indexNewsContOn')
            $($('.indexNewsCont')[Number($(this).attr('data-i'))]).addClass('indexNewsContOn')
        }
    })

</script>
@yield('js')
</body>
</html>







