@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="companyProfileNav">
        <div class="companyProfileNavBox">
            <a href="{{route('about.company')}}">公司简介</a>
            <a class="companyProfileNavOn" href="{{route('about.articles')}}">新闻资讯</a>
            <a href="{{route('about.join')}}">加盟代理</a>
            <a href="{{route('about.job')}}">人才招聘</a>
            <a href="{{route('about.content')}}">联系我们</a>
        </div>
    </div>

    <div class="newsDetail">
        <div class="testTpdTitle">
            {{$article->title}}
        </div>
        <div class="testTpdDes">
            来源：{{$article->from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：{{$article->author}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：{{$article->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;阅读量：{{$article->see_num}}
        </div>
        <div class="richCont">
            {!! $article->description !!}
        </div>
        <div class="nestPrev clearfix">
            <a class="fl textOne"
               href="{{ $article['prev_data']? route('about.article',$article['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $article['prev_data']? $article['prev_data']['title']:'暂无'}}
            </a>
            <a class="fl textOne"
               href="{{ $article['next_data']? route('about.article',$article['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $article['next_data']? $article['prev_data']['title']:'暂无'}}
            </a>
        </div>
    </div>

@endsection
@section('js')

@endsection