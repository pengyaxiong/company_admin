@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 广告 -->
    <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}">
    <!-- 列表 -->
    <div class="successNav ">
        @foreach($categories as $category)
            <div @if($category->id== $category_id) class="successNavOn"
                 @endif onclick="javascript:location.href='{{route('mobile.out.works',$category->id)}}'">{{$category->name}}</div>
        @endforeach
    </div>
    <div class="tubeBabyHospital">
        @foreach($works as $work)
            <a href="{{route('mobile.out.work',$work->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                <div class="tbgTitle textOne">
                    {{$work->title}}
                </div>
                <div class="tbgTip textLinesTwo">
                    {{$work->info}}
                </div>
            </a>
        @endforeach
    </div>
    <!-- 分页 -->
    {!! $works->appends(Request::all())->links('mobile.layouts._page') !!}
    <!-- 相关推荐 -->
    <div class="relatedSuggestion ">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_works as $article)
                <a class="textOne" href="{{route('mobile.out.work',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection