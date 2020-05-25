@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a> > <span>试管专题</span>
    </div>

    <div class="smallTitle">
        <div class="smallTitleDiv">今日资讯</div>
        <a href="{{route('mobile.cms.today_articles')}}">更多</a>
    </div>
    <div class="smallTop">
        <a class="advisoryImg" href="{{route('mobile.cms.article',$today->first()->id)}}">
            <img class="advisoryImg"
                 src="{{\Storage::disk(config('admin.upload.disk'))->url($today->first()->image)}}">


        </a>
        <a class="advisoryRA" href="{{route('mobile.cms.article',$today->first()->id)}}">
            <div class="advisoryRATitle textLinesTwo">
                {{$today->first()->title}}
            </div>
            <div class="advisoryRADes textLinesThree">
                {{$today->first()->info}}
            </div>
        </a>
    </div>

    <div class="advisoryRUlBox">
        <div class="advisoryRUl">
            @foreach($today as $article)
                @if($loop->index>0 && $loop->index<3)
                    <a href="{{route('mobile.cms.article',$article->id)}}">
                        {{$article->title}}
                    </a>
                @endif
            @endforeach
        </div>
        <div class="advisoryRUl">
            @foreach($today as $article)
                @if($loop->index>2 && $loop->index<5)
                    <a href="{{route('mobile.cms.article',$article->id)}}">
                        {{$article->title}}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="grayBlock"></div>

    @foreach($categories as $category)
        <div class="smallTitle">
            <div class="smallTitleDiv">{{$category->name}}</div>
            <a href="{{route('mobile.cms.articles',['id'=>$category->id,'parent'=>true])}}">更多</a>
        </div>
        @if(!empty($category->articles)).
        @foreach($category->articles as $article)
            @if($loop->first)
                <div class="smallTop">
                    <a class="advisoryImg" href="{{route('mobile.cms.article',$article->id)}}">
                        <img class="advisoryImg"
                             src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                    </a>
                    <a class="advisoryRA" href="{{route('mobile.cms.article',$article->id)}}">
                        <div class="advisoryRATitle textLinesTwo">
                            {{$article->title}}
                        </div>
                        <div class="advisoryRADes textLinesThree">
                            {{$article->info}}
                        </div>
                    </a>
                </div>
            @else
                <div class="advisoryRUlBox">
                    <div class="advisoryRUl">
                        @if($loop->index>0 && $loop->index<3)
                            <a href="{{route('mobile.cms.article',$article->id)}}">
                                {{$article->title}}
                            </a>
                        @endif
                    </div>
                    <div class="advisoryRUl">
                        @if($loop->index>2 && $loop->index<5)
                            <a href="{{route('mobile.cms.article',$article->id)}}">
                                {{$article->title}}
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
        @endif
        <div class="grayBlock"></div>
    @endforeach
@endsection
@section('js')

@endsection