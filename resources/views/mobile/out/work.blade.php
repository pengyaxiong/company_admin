@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.out.works',-1)}}">成功案例</a> > <span>  {{$work->title}}</span>
    </div>

    <div class="testTpdTitle">
        {{$work->title}}
    </div>
    <div class="testTpdDes">
        来源：{{$work->from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：{{$work->author}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：{{$work->created_at}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读量：{{$work->see_num}}
    </div>
    <div class="richCont">
        {!! $work->description !!}
    </div>
    <div class="nestPrev clearfix">
        <a class="fl textOne"
           href="{{ $work['prev_data']? route('mobile.out.work',$work['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $work['prev_data']? $work['prev_data']['title']:'暂无'}}
        </a>
        <a class="fl textOne"
           href="{{ $work['next_data']? route('mobile.out.work',$work['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $work['next_data']? $work['next_data']['title']:'暂无'}}
        </a>
    </div>

    <div class="grayBlock"></div>

    <!-- 相关推荐 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_works as $article)
                <a class="textOne" href="{{route('mobile.out.work',$article->id)}}">
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