@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.cms.article_categories')}}">试管专题</a>> <a
                href="{{route('mobile.cms.articles',['id'=>$article->category->id])}}">{{$article->category->name}}</a>
        > <span>{{$article->title}}</span>
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
           href="{{ $article['prev_data']? route('mobile.article',$article['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $article['prev_data']? $article['prev_data']['title']:'暂无'}}
        </a>
        <a class=" textOne"
           href="{{ $article['next_data']? route('mobile.article',$article['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $article['next_data']? $article['next_data']['title']:'暂无'}}
        </a>
    </div>
    <div class="grayBlock"></div>

    <!-- 相关推荐 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_articles as $article)
                <a class="textOne" href="{{route('mobile.article',['id'=>$article->id])}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>


    @foreach($know_means as $category)
        <div class="smallFootBox">
            @if($loop->first)
                <div class="smallFootBoxTitle">
                    <div class="smallFootBoxDiv">知识百科</div>
                </div>
            @endif
            <div class="smallFootBoxTip">
                {{$category->name}}
            </div>
            @if(!empty($category->children))
                <div class="smallFootBoxList">
                    @foreach($category->children as $children)
                        <a href="{{route('mobile.cms.knows',['id'=>$children->id])}}">{{$children->name}}</a>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach


    @if($ads->first())
        <a href="{{$ads->first()->url}}">
            <img class="hotAd" src="{{\Storage::disk(config('admin.upload.disk'))->url($ads->first()->image)}}">
        </a>
    @endif

@endsection
@section('js')

@endsection