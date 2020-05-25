<div class="footInfo clearfix">
    <div class="footList">
        <a class="footListTitle" href="{{route('out.hospitals')}}">海外试管</a>
        <a class="footListLink" href="{{route('out.hospitals')}}">海外医院</a>
        <a class="footListLink" href="{{route('out.doctors')}}">名医荟萃</a>
        <a class="footListLink" href="{{route('out.articles')}}">试管套餐</a>
        <a class="footListLink" href="{{route('out.works',-1)}}">成功案例</a>
    </div>
    <div class="footList">
        <a class="footListTitle" href="{{route('cms.article_categories')}}">助孕小课堂</a>
        @foreach($zy_means as $mean)
            <a class="footListLink" href="{{route('cms.articles',['id'=>$mean->id,'parent'=>true])}}">{{$mean->name}}</a>
        @endforeach

        <a class="footListLink" href="{{route('cms.knows')}}">试管百科</a>
    </div>
    <div class="footList">
        <a class="footListTitle" href="{{route('about.company')}}">关于我们</a>
        <a class="footListLink" href="{{route('about.company')}}">公司简介 </a>
        <a class="footListLink" href="{{route('about.articles')}}">新闻资讯</a>
        <a class="footListLink" href="{{route('about.join')}}">加盟代理</a>
        <a class="footListLink" href="{{route('about.job')}}">人才招聘</a>
        <a class="footListLink" href="{{route('about.content')}}">联系我们</a>
    </div>
    <div class="footList footListLast">
        <div class="footListTitle">联系方式</div>
        <div class="footListLink">电话：{{$contacts->tel}} </div>
        <div class="footListLink">公式地址：{{$contacts->address}}</div>
    </div>
    <div class="FootErweima fr">
        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($contacts->bweixin)}}">
        <div>华孕宝微信公众号</div>
    </div>
    <div class="FootErweima fr">
        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($contacts->tweixin)}}">
        <div>华孕堂微信公众号</div>
    </div>
</div>
<div class="copyright">
    {{$contacts->copyright}}
</div>
