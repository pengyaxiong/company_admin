@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="companyProfileNav">
        <div class="companyProfileNavBox">
            <a href="{{route('about.company')}}">公司简介</a>
            <a href="{{route('about.articles')}}">新闻资讯</a>
            <a href="{{route('about.join')}}">加盟代理</a>
            <a class="companyProfileNavOn" href="{{route('about.job')}}">人才招聘</a>
            <a href="{{route('about.content')}}">联系我们</a>
        </div>
    </div>
    <div class="joinus">
        <div class="title">
            <div class="titleEn">JOIN US</div>
            <div class="titleZn">人才招聘</div>
            <img src="/home/img/titleIcon.png" class="titleIcon">
        </div>
        @foreach($jobs as $job)
            <div class="joinItem">
                <div class="joinItemTitle">
                    {{$job->name}}
                </div>
                <div class="clearfix joinItemCont">
                    <div class="joinItemLeft fl">
                        <div class="joinItemContTitle">
                            岗位职责：
                        </div>
                       {!! $job->responsibility !!}
                    </div>
                    <div class="joinItemRight fr">
                        <div class="joinItemContTitle">
                            任职要求：
                        </div>
                        {!! $job->requirement !!}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="emailTips">
            如果您想加入我们，请将您的简历发送至：<span>{{$contacts->email}}</span>
        </div>
    </div>

@endsection
@section('js')

@endsection