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

    <div class="newsList">
        @foreach($articles as $article)
            <a href="{{route('about.article',$article->id)}}" class="doctorLink clearfix">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}" class="doctorLinkImg fl">
                <div class="doctorLinkCont fr">
                    <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                    <div class="textLinesThree doctorLinkDes">{{$article->info}}</div>
                    <div class="doctorLinkData">{{date('Y-m-d',strtotime($article->created_at))}}</div>
                </div>
            </a>
        @endforeach
    </div>
    <!-- 分页 -->
    {!! $articles->appends(Request::all())->links('mobile.layouts._page') !!}
@endsection
@section('js')

@endsection