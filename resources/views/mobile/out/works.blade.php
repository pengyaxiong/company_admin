@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 广告 -->
    <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}">
    <!-- 列表 -->
    <div class="successNav clearfix">
        @foreach($categories as $category)
            <div @if($category->id== $category_id) class="successNavOn" @endif onclick="javascript:location.href='{{route('out.works',$category->id)}}'">{{$category->name}}</div>
        @endforeach
    </div>
    <div class="success clearfix">
        @foreach($works as $work)
            <a class="successLink" href="{{route('out.work',$work->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                <div class="successCont">
                    <div class="sussessTitle">{{$work->title}}</div>
                    <div class="sussessDes textLinesThree">
                        {{$work->info}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <!-- 分页 -->
    {!! $works->appends(Request::all())->links('mobile.layouts._page') !!}
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($recommend_works as $work)
                <a class="textOne" href="{{route('out.work',$work->id)}}">{{$work->title}}</a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection