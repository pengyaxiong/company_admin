<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <script src="/mobile/js/flexible.js" type="text/javascript" charset="utf-8"></script>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/mobile/css/swiper.min.css"/>
    <script src="/mobile/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/mobile/js/jquery.mobile-events.min.js" type="text/javascript" charset="utf-8"></script>
    <title>{{ config('app.name') }}</title>
    @yield('css')
</head>
<body>
<!-- header -->
<header id="header">
    @include("mobile.layouts._head")
</header>
<div style="height: 50px;"></div>


<!-- content start -->
@yield('content')
<!-- content end -->


<!-- footer -->
<footer id="footer">
    @include("mobile.layouts._footer")
</footer>
<script type="text/javascript">
    $('.menu').on('tap', function () {
        if ($('.menuCont').hasClass('menuContIn')) {
            $('.menuCont').removeClass('menuContIn')
        } else {
            $('.menuCont').addClass('menuContIn')
        }
    })
    $('.menuClose').on('tap', function () {
        $('.menuCont').removeClass('menuContIn')
    })
    $('.menuBox').on('click', '.menuBoxLinksSpan', function (e) {
        // e.preventDefault()
        if ($(this).hasClass('menuBoxLinksOn')) {
            $('.menuBoxLinksOn').removeClass('menuBoxLinksOn')
        } else {
            $('.menuBoxLinksOn').removeClass('menuBoxLinksOn')
            $(this).parent().addClass('menuBoxLinksOn')
        }
    })

    var idexSwiper = new Swiper('.idexSwiper', {
        autoplay: true,
        autoHeight: true, //高度随内容变化
    })
    var midSwiper = new Swiper('.midSwiper', {
        slidesPerView: 2,
        navigation: {
            nextEl: '.arrow-left',
            prevEl: '.arrow-right',
        },
    })
    $('.advantageNav').on('tap', 'div', function () {
        if (!$(this).hasClass('advantageNavOn')) {
            $('.advantageNavOn').removeClass('advantageNavOn')
            $(this).addClass('advantageNavOn')
        }

        $('.advantageContOn').removeClass('advantageContOn')
        $($('.advantageCont')[Number($(this).attr('data-i'))]).addClass('advantageContOn')
    })

    $('.indexNewsNav').on('tap','div',function(){
        if(!$(this).hasClass('indexNewsNavOn')){
            $('.indexNewsNavOn').removeClass('indexNewsNavOn')
            $(this).addClass('indexNewsNavOn')

            $('.indexNewsBoxOn').removeClass('indexNewsBoxOn')
            $($('.indexNewsBox')[Number($(this).attr('data-i'))]).addClass('indexNewsBoxOn')
        }
    })
</script>
@yield('js')
</body>
</html>







