@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <span>海外医院</span>
    </div>
    <!-- 列表 -->
    <div class="ohList">
        @foreach($hospitals as $hospital)
            <a class="ohListItem" href="{{route('mobile.out.hospital',$hospital->id)}}">
                <div class=" ohListItemCont">
                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}" class="ohListItemImg">
                    <div class=" ohListItemBox">
                        <div class="ohListName">
                            {{$hospital->name}}<span>{{$hospital->leave}}</span>
                        </div>
                        <div class="ohListInfo textLinesTwo">
                            地址：{{$hospital->address}}
                        </div>
                        <div class="ohListInfo textLinesTwo">
                            电话：{{$hospital->tel}}
                        </div>
                    </div>
                </div>
                <div class="ohListDes">
                    @if(!empty($hospital->type))
                        @foreach($hospital->type as $type)
                            <div>{{$type['name']}}</div>
                        @endforeach
                    @endif
                </div>
                {{--<div class="fr ohListers">--}}
                {{--<div class="ohListImgs">--}}
                {{--@if(!empty($hospital->doctor))--}}
                {{--@foreach($hospital->doctor as $doctor)--}}
                {{--<img src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">--}}
                {{--@endforeach--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--<div class="ohListTips">累计{{count($hospital->doctors)}}名专家</div>--}}
                {{--</div>--}}
            </a>
        @endforeach
    <!-- 分页 -->
        {!! $hospitals->appends(Request::all())->links('mobile.layouts._page') !!}
    </div>
    <div class="grayBlock"></div>
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class="textOne" href="{{route('mobile.out.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection