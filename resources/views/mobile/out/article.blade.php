@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.out.articles')}}">试管套餐</a> >
        <span>  {{$article->title}}</span>
    </div>

    <div class="testTpdTitle">
        {{$article->title}}
    </div>
    <div class="testTpdDes">
        来源：{{$article->from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：{{$article->author}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：{{$article->created_at}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读量：{{$article->see_num}}
    </div>
    <div class="richCont">
        {!! $article->description !!}
    </div>
    <div class="nestPrev ">
        <a class=" textOne"
           href="{{ $article['prev_data']? route('mobile.out.article',$article['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $article['prev_data']? $article['prev_data']['title']:'暂无'}}
        </a>
        <a class=" textOne"
           href="{{ $article['next_data']? route('mobile.out.article',$article['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $article['next_data']? $article['next_data']['title']:'暂无'}}
        </a>
    </div>
    <div class="grayBlock"></div>


    <!-- 相关推荐 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($hot_articles as $article)
                <a class="textOne" href="{{route('mobile.out.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

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

    @if($ads->first())
        <a href="{{$ads->first()->url}}">
            <img class="hotAd" src="{{\Storage::disk(config('admin.upload.disk'))->url($ads->first()->image)}}">
        </a>
    @endif

@endsection
@section('js')

@endsection