<div class="footerCont">
    <div class="erweima">
        <div>
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($contacts->bweixin)}}">
            <div>华孕宝微信公众号</div>
        </div>
        <div>
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($contacts->tweixin)}}">
            <div>华孕堂微信公众号</div>
        </div>
    </div>
    <div class="footTel">电话：{{$contacts->tel}}</div>
    <div class="footTel">
        公司地址：{{$contacts->address}}
    </div>
    <div class="footerLinks">
        <a href="{{route('mobile.index')}}">首页 |</a>
        <a href="{{route('mobile.out.hospitals')}}">海外试管 |</a>
        <a href="{{route('mobile.cms.article_categories')}}">助孕小课堂 |</a>
        <a href="{{route('mobile.organizations')}}">生殖机构大全 |</a>
        <a href="{{$contacts->url}}">自营门诊 |</a>
        <a href="{{route('mobile.about.company')}}">关于我们</a>
    </div>
</div>
<div class="coptright">
    {{$contacts->copyright}}
</div>
