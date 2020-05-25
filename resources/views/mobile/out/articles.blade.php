@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <span>试管套餐</span>
    </div>

    @foreach($articles as $article)
        <a href="{{route('mobile.cms.article',$article->id)}}" class="doctorLink clearfix">
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
    <div class="grayBlock"></div>

    <!-- 推荐文章 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">推荐文章</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_articles as $article)
                <a class="textOne" href="{{route('mobile.out.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

    <!-- 推荐医院 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">推荐医院</div>
        <div class="relatedSuggestionCont">
            @foreach($hospitals as $hospital)
                <a class="textOne" href="{{route('mobile.out.hospital',$hospital->id)}}">
                    {{$hospital->name}}
                </a>
            @endforeach
        </div>
    </div>

    @if(!empty($ads))
        @foreach($ads as $ad)
            <a href="{{$ad->url}}">
                <img class="hotAd"
                     src="{{\Storage::disk(config('admin.upload.disk'))->url($ad->image)}}">
            </a>
        @endforeach
    @endif

@endsection
@section('js')

@endsection