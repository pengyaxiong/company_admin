<nav>
    <img src="/mobile/img/logo.png" class="logo">
    <img src="/mobile/img/menu.png" class="menu">
</nav>
<div class="menuCont">
    <img src="/mobile/img/menuclose.png" class="menuClose">
    <div class="menuBox">
        <div style="height: 50px;"></div>
        <a href="{{route('mobile.index')}}">首页</a>
        <a class="menuBoxLinks">
            <span class="menuBoxLinksSpan">海外试管</span>
            <div class="menuBoxLinkBox">
                <object>
                    <a href="{{route('mobile.out.hospitals')}}">海外医院</a>
                </object>
                <object>
                    <a href="{{route('mobile.out.doctors')}}">名医荟萃</a>
                </object>
                <object>
                    <a href="{{route('mobile.out.articles')}}">试管套餐</a>
                </object>
                <object>
                    <a href="{{route('mobile.out.works',-1)}}">成功案例</a>
                </object>
            </div>
        </a>
        <a class="menuBoxLinks">
            <span class="menuBoxLinksSpan">助孕小课堂</span>
            <div class="menuBoxLinkBox">
                <object>
                    <a href="{{route('mobile.cms.article_categories')}}">试管专题</a>
                </object>
                <object>
                    <a href="{{route('mobile.cms.knows')}}">试管百科</a>
                </object>
            </div>
        </a>
        <a href="{{route('mobile.organizations')}}">生殖机构大全</a>
        <a href="{{$contacts->url}}">自营门诊</a>
        <a href="{{route('mobile.about.company')}}">关于我们</a>
    </div>
    <div class="menuAd">
        <img src="/mobile/img/kefu.png" class="kfer">
        <div class="menuAdLeft">
            <div class="menuAdLeftTop">试管和备孕难题</div>
            <div class="menuAdLeftAfter">免费咨询三甲医院专家</div>
        </div>
        <a class="menuAdBtn" href="">
            <img src="/mobile/img/menuwx.png">
            在线咨询
        </a>
    </div>
</div>
