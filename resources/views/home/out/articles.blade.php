@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <span>试管套餐</span>
    </div>

    <div class="commonCont doctorCommonCont clearfix">
        <div class="commonLeft fl">
            <div class="commonLeftList commonWhiteBg">
                @foreach($articles as $article)
                    <a href="{{route('out.article',$article->id)}}" class="doctorLink clearfix">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                             class="doctorLinkImg fl">
                        <div class="doctorLinkCont fr">
                            <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                            <div class="textLinesThree doctorLinkDes">
                                {{$article->info}}
                            </div>
                            <div class="doctorLinkData"> {{date("Y-m-d",strtotime($article->created_at))}}</div>
                        </div>
                    </a>
                @endforeach
            <!-- 分页 -->
                {!! $articles->appends(Request::all())->links('home.layouts._page') !!}
            </div>
        </div>

        <div class="fr">
            <div class="hotArticler testTp">
                <div class="hotArticleTitle">
                    推荐医院
                </div>
                @foreach($hospitals as $hospital)
                    <a class="hotArticleLink textOne" href="{{route('out.hospital',$hospital->id)}}">{{$hospital->name}}</a>
                @endforeach
            </div>
            <div class="hotArticler testTp">
                <div class="hotArticleTitle">
                    推荐文章
                </div>
                @foreach($recommend_articles as $article)
                    <a class="hotArticleLink textOne" href="{{route('out.article',$article->id)}}">{{$article->title}}</a>
                @endforeach
            </div>

            @if(!empty($ads))
                @foreach($ads as $ad)
                    <a href="{{$ad->url}}">
                        <img class="hotAd"
                             src="{{\Storage::disk(config('admin.upload.disk'))->url($ad->image)}}">
                    </a>
                @endforeach
            @endif
        </div>
    </div>

@endsection
@section('js')

@endsection