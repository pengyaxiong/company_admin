@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <span>海外医生</span>
    </div>
    <!-- 列表 -->
    <div class='famousDoctors'>
        @foreach($doctors as $doctor)
            <a href="{{route('mobile.out.doctor',$doctor->id)}}" class='famousDoctorsLink'>
                <img class="" src='{{\Storage::disk(config('admin.upload.disk'))->url($doctor->image)}}'>
                <div class='famousDocName'>{{$doctor->name}}</div>
                <div class='famousDocPos'>{{$doctor->job}}</div>
                <div class='famousDocFrom'>{{$doctor->hospital->name}}</div>
                <div class='famousDocDes textLinesTwo'>
                    擅长：{{implode(',',array_column($doctor->type,'name'))}}
                </div>
            </a>
        @endforeach
    <!-- 分页 -->
        {!! $doctors->appends(Request::all())->links('mobile.layouts._page') !!}
    </div>
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_articles as $article)
                <a class="textOne" href="{{route('mobile.out.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')
  
@endsection