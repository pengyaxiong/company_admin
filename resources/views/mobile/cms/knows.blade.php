@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">

    @foreach($knows as $know)
        <a href="{{route('mobile.cms.know',$know->id)}}" class="doctorLink ">
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($know->image)}}"
                 class="doctorLinkImg ">
            <div class="doctorLinkCont ">
                <div class="doctorLinkTitle textOne">{{$know->title}}</div>
                <div class="textLinesThree doctorLinkDes">
                    {{$know->info}}
                </div>
                <div class="doctorLinkData"> {{date("Y-m-d",strtotime($know->created_at))}}</div>
            </div>
        </a>
    @endforeach
    <!-- 分页 -->
    {!! $knows->appends(Request::all())->links('mobile.layouts._page') !!}

    <div class="grayBlock"></div>

    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">热门文章</div>
        <div class="relatedSuggestionCont">
            @foreach($all_hot as $article)
                <a class="textOne" href="{{route('mobile.article',['id'=>$article->id])}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">最新文章</div>
        <div class="relatedSuggestionCont">
            @foreach($all_new as $article)
                <a class="textOne" href="{{route('mobile.article',['id'=>$article->id])}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

    @if($ads->first())
        <a href="{{$ads->first()->url}}">
            <img class="hotAd" src="{{\Storage::disk(config('admin.upload.disk'))->url($ads->first()->image)}}">
        </a>
    @endif
@endsection
@section('js')

@endsection