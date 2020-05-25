@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="successNav">
        <div><a href="{{route('mobile.about.company')}}">公司简介</a></div>
        <div class="successNavOn"><a href="{{route('mobile.about.articles')}}">新闻资讯</a></div>
        <div><a href="{{route('mobile.about.join')}}">加盟代理</a></div>
        <div><a href="{{route('mobile.about.job')}}">人才招聘</a></div>
        <div><a href="{{route('mobile.about.content')}}">联系我们</a></div>
    </div>

    @foreach($articles as $article)
        <a href="{{route('mobile.about.article',$article->id)}}" class="doctorLink ">
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}" class="doctorLinkImg ">
            <div class="doctorLinkCont ">
                <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                <div class="textLinesTwo doctorLinkDes">{{$article->info}}</div>
                <div class="doctorLinkData">{{date('Y-m-d',strtotime($article->created_at))}}</div>
            </div>
        </a>
    @endforeach
    <!-- 分页 -->
    {!! $articles->appends(Request::all())->links('mobile.layouts._page') !!}
@endsection
@section('js')

@endsection