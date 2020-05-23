@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">

    @foreach($articles as $article)
        <a href="{{route('mobile.article',$article->id)}}" class="doctorLink ">
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                 class="doctorLinkImg ">
            <div class="doctorLinkCont ">
                <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                <div class="textLinesThree doctorLinkDes">
                    {{$article->info}}
                </div>
                <div class="doctorLinkData"> {{date("Y-m-d",strtotime($article->created_at))}}</div>
            </div>
        </a>
    @endforeach
    <!-- 分页 -->
    {!! $articles->appends(Request::all())->links('mobile.layouts._page') !!}

    <div class="grayBlock"></div>

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