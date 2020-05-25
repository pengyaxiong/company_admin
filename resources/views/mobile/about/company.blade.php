@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="successNav">
        <div class="successNavOn"><a href="{{route('mobile.about.company')}}">公司简介</a></div>
        <div><a href="{{route('mobile.about.articles')}}">新闻资讯</a></div>
        <div><a href="{{route('mobile.about.join')}}">加盟代理</a></div>
        <div><a href="{{route('mobile.about.job')}}">人才招聘</a></div>
        <div><a href="{{route('mobile.about.content')}}">联系我们</a></div>
    </div>

    <div class="title aboutTitle">
        <div class="titleEn">COMPANY INTRO</div>
        <div class="titleZn">公司简介</div>
        <img src="/mobile/img/titleIcon.png" class="titleIcon">
    </div>
    <div class="richCont">
        {!! $company->description !!}
    </div>

@endsection
@section('js')

@endsection