<div class="headerCont">
    <img class="hybLogo fl" src="/home/img/hyb.png">
    <div class="fr headSearch">
        <img class="headSearchImg" src="/home/img/search.png">
        <img class="indexclose" src="/home/img/indexclose.png" >
    </div>
    <div class="fr nav">
        <a class="navItem navItem1" href="{{route('home.index')}}">
            <span>首页</span>
        </a>
        <a class="navItem navItem2" href="{{route('out.hospitals')}}">
            <span>海外试管</span>
            <div class="navBox">
                <object>
                    <a href="{{route('out.hospitals')}}" class="navLink">海外医院</a>
                </object>
                <object>
                    <a href="{{route('out.doctors')}}" class="navLink">名医荟萃</a>
                </object>
                <object>
                    <a href="{{route('out.articles')}}" class="navLink">试管套餐</a>
                </object>
                <object>
                    <a href="{{route('out.works',-1)}}" class="navLink">成功案例</a>
                </object>
            </div>
        </a>
        <a class="navItem navItem3" href="#">
            <span>助孕小课堂</span>
            <div class="navBox">
                <object>
                    <a href="{{route('cms.article_categories')}}" class="navLink">试管专题</a>
                </object>
                <object>
                    <a href="{{route('cms.knows')}}" class="navLink">试管百科</a>
                </object>
            </div>
        </a>
        <a class="navItem navItem4" href="{{route('home.organizations')}}">
            <span>生殖机构大全</span>

        </a>
        <a class="navItem navItem5" href="{{$contacts->url}}">
            <span>自营门诊</span>

        </a>
        <a class="navItem navItem6" href="{{route('about.company')}}">
            <span>关于我们</span>
        </a>
    </div>
</div>
<div class="searchBox">
    <div style="height: 18px;"></div>
    <div class='searchCont'>
        <div class="search">
            <img class="fl" src="/home/img/searchicon.png">
            <form action="{{route('home.search')}}" method="get">
                <input class="fl" type="search" name="keyword" placeholder="请输入医院名、疾病名"/>
            </form>
        </div>
        <div class="searchTitle">热门搜索</div>
        <div class="searchList">
            @foreach($search_keywords as $search)
                <a href="{{route('home.search',['keyword'=>$search])}}">{{$search}}</a>
            @endforeach
        </div>
    </div>
</div>
