@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('out.works',-1)}}">成功案例</a> > <span>  {{$work->title}}</span>
    </div>
    <div class="commonCont doctorCommonCont clearfix">
        <div class="commonLeft testTpdCont fl">
            <div class="testTpdTitle">
                {{$work->title}}
            </div>
            <div class="testTpdDes">
                来源：{{$work->from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：{{$work->author}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：{{$work->created_at}}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读量：{{$work->see_num}}
            </div>
            <div class="richCont">
                {!! $work->description !!}
            </div>
            <div class="nestPrev clearfix">
                <a class="fl textOne"
                   href="{{ $work['prev_data']? route('out.work',$work['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $work['prev_data']? $work['prev_data']['title']:'暂无'}}
                </a>
                <a class="fl textOne"
                   href="{{ $work['next_data']? route('out.work',$work['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $work['next_data']? $work['next_data']['title']:'暂无'}}
                </a>
            </div>
            <div class="grayDiv"></div>

            <!-- 相关推荐 -->
            <div class="relatedSuggestion testTpdl">
                <div class="relatedSuggestionTitle">相关推荐</div>
                <div class="relatedSuggestionCont">
                    @foreach($recommend_works as $work)
                        <a class="textOne" href="{{route('out.work',$work->id)}}">{{$work->title}}</a>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="fr">
            <div class="hotArticler testTp">
                <div class="hotArticleTitle">
                    推荐医院
                </div>
                @foreach($hospitals as $hospital)
                    <a class="hotArticleLink textOne"
                       href="{{route('out.hospital',$hospital->id)}}">{{$hospital->name}}</a>
                @endforeach
            </div>
            <div class="hotArticler testTp">
                <div class="hotArticleTitle">
                    推荐文章
                </div>
                @foreach($recommend_articles as $work)
                    <a class="hotArticleLink textOne"
                       href="{{route('out.article',$work->id)}}">{{$work->title}}</a>
                @endforeach
            </div>

            @if(!empty($ads))
                @foreach($ads as $ad)
                    <a href="{{$ad->url}}">
                        <img class="hotAd"
                             src="{{\Storage::disk(config('admin.upload.disk'))->url($ad->image)}}">
                    </a>
                @endforeach
            @endif
        </div>
    </div>

@endsection
@section('js')

@endsection