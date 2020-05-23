@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="companyProfileNav">
        <div class="companyProfileNavBox">
            <a class="companyProfileNavOn" href="{{route('about.company')}}">公司简介</a>
            <a href="{{route('about.articles')}}">新闻资讯</a>
            <a href="{{route('about.join')}}">加盟代理</a>
            <a href="{{route('about.job')}}">人才招聘</a>
            <a href="{{route('about.content')}}">联系我们</a>
        </div>
    </div>
    <div class="companyProfile">
        <div class="title">
            <div class="titleEn">COMPANY INTRO</div>
            <div class="titleZn">公司简介</div>
            <img src="/home/img/titleIcon.png" class="titleIcon">
        </div>
        <div class="richCont">
            {!! $company->description !!}
        </div>
    </div>

@endsection
@section('js')

@endsection