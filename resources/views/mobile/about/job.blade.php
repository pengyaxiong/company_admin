@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="successNav">
        <div><a href="{{route('mobile.about.company')}}">公司简介</a></div>
        <div><a href="{{route('mobile.about.articles')}}">新闻资讯</a></div>
        <div><a href="{{route('mobile.about.join')}}">加盟代理</a></div>
        <div class="successNavOn"><a href="{{route('mobile.about.job')}}">人才招聘</a></div>
        <div><a href="{{route('mobile.about.content')}}">联系我们</a></div>
    </div>

    <div class="title aboutTitle">
        <div class="titleEn">JOIN US</div>
        <div class="titleZn">人才招聘</div>
        <img src="/mobile/img/yellowArror.png" class="yellowArror">
    </div>

    @foreach($jobs as $job)
        <div class="recTitle">
            {{$job->name}}
        </div>
        <div class="responsibilities">
            岗位职责：
        </div>
        <div class="jobItem">
            {!! $job->responsibility !!}
        </div>
        <div class="responsibilities">
            任职要求：
        </div>
        <div class="jobItem">
            {!! $job->requirement !!}
        </div>
    @endforeach
    <div class="email">
        如果您想加入我们，请将您的简历发送至：<div>{{$contacts->email}}</div>
    </div>

@endsection
@section('js')

@endsection