@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.out.doctors')}}">海外医生</a> >
        <span>{{$doctor->hospital->name}}&nbsp;{{$doctor->name}}</span>
    </div>
    <div class="doctor ">
        <div class="doctorBox">
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->image)}}" class="doctorImg fl">
            <div class="doctorCont ">
                <div class="doctorContInfo">
                    <div class="doctorName"><span>{{$doctor->name}}</span>{{$doctor->job}}</div>
                    <div class="doctorFrom">{{$doctor->hospital->name}}</div>
                </div>
                <div class="doctorPos">
                    @if(!empty($doctor->type))
                        @foreach($doctor->type as $type)
                            <div>{{$type['name']}}</div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
        <div class="doctorDes">
            {{$doctor->info}}
        </div>
    </div>
    <!-- 广告 -->
    <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->banner)}}">

    <div class="doctorInfoCont">
        <div class="hospitalDocBoxTitle">
            <span>专家介绍</span>
        </div>
        <div class="doctorLine">
            <div></div>
        </div>
        <div class="goodAt">
            <span>擅长：</span>{{implode(',',array_column($doctor->type,'name'))}}
        </div>
        <div class="goodAt">
            {!! $doctor->description !!}
        </div>
    </div>

    <div class="hospitalDocBoxTitle">
        <span>成功案例</span>
    </div>
    @foreach($articles as $article)
        <a href="{{route('mobile.out.work',$article->id)}}" class="doctorLink">
            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                 class="doctorLinkImg fl">
            <div class="doctorLinkCont fr">
                <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                <div class="textLinesTwo doctorLinkDes">{{$article->info}}</div>
                <div class="doctorLinkData">{{date('Y-m-d',strtotime($article->created_at))}}</div>
            </div>
        </a>
    @endforeach

    <!-- 分页 -->
    {!! $articles->appends(Request::all())->links('mobile.layouts._page') !!}
    <div class="grayBlock"></div>

    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">热门文章</div>
        <div class="relatedSuggestionCont">
            @foreach($all_hot as $article)
                <a class="textOne" href="{{route('mobile.out.article',$article->id)}}">{{$article->title}}</a>
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