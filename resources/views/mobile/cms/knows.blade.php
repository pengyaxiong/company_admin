@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <span>试管百科</span>
    </div>
    @if($recommend->first())
        <div class="topLink clearfix">
            <a class="topLinkLeft fl" href="{{route('cms.know',$recommend->first()->id)}}" class="">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($recommend->first()->image)}}"/>
                <div class="textOne">{{$recommend->first()->title}}</div>
            </a>
            <div class="topLinkRight fr">
                <div class="topLinkRightTips">
                    #热门搜索#
                </div>
                <a class="topLinkRightTop" href="{{route('cms.know',$recommend->first()->id)}}">
                    <div class="topLinkRightTopTitle">
                        {{$recommend->first()->title}}
                    </div>
                    <div class="topLinkRightTopDes">
                        {{$recommend->first()->info}}
                    </div>
                </a>
                @foreach($recommend as $article)
                    @if($loop->index>0)
                        <a class="topLinkRightLink"
                           href="{{route('cms.know',$article->id)}}">{{$article->title}}</a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <div class="container topTE clearfix">
        <div class="testTETitle">
            {{$category->name}}百科
        </div>
        <div class="testTELeft fl">
            <a class="testTELeftTop" href="{{route('cms.know',$cyclopedia->first()->id)}}">
                <img class="fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($cyclopedia->first()->image)}}">
                <div class="fl testTELeftTopCont">
                    <div class="testTELeftTopTitle textLinesTwo">
                        {{$cyclopedia->first()->title}}
                    </div>
                    <div class="testTELeftTopDes">
                        {{$cyclopedia->first()->info}}
                    </div>
                </div>
            </a>
            <div class="testTELeftList clearfix">
                <div class="testTELeftUl fl">
                    @foreach($cyclopedia as $article)
                        @if($loop->index>0 && $loop->index<4)
                            <a href="{{route('cms.know',$article->id)}}">
                                <div class="textOne fl">{{$article->title}}</div>
                                <div class="testTELeftUlDate fl">{{date('m-d',strtotime($article->created_at))}}</div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="testTELeftUl fr">
                    @foreach($cyclopedia as $article)
                        @if($loop->index>4 && $loop->index<8)
                            <a href="{{route('cms.know',$article->id)}}">
                                <div class="textOne fl">{{$article->title}}</div>
                                <div class="testTELeftUlDate fl">{{date('m-d',strtotime($article->created_at))}}</div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="testTERight fr">
            <div class="testTERightTitle">
                热门文章
            </div>
            @foreach($all_hot as $article)
                @if($loop->first)
                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                @endif
                <a href="{{route('cms.know',$article->id)}}">{{$article->title}}</a>
            @endforeach
        </div>
    </div>
    <div class="container topTE clearfix">
        <div class="testTETitle">
            {{$category->name}}热门
        </div>
        <div class="testTELeft fl">
            <a class="testTELeftTop" href="{{route('cms.know',$hot->first()->id)}}">
                <img class="fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($hot->first()->image)}}">
                <div class="fl testTELeftTopCont">
                    <div class="testTELeftTopTitle textLinesTwo">
                        {{$hot->first()->title}}
                    </div>
                    <div class="testTELeftTopDes">
                        {{$hot->first()->info}}
                    </div>
                </div>
            </a>
            <div class="testTELeftList clearfix">
                <div class="testTELeftUl fl">
                    @foreach($hot as $article)
                        @if($loop->index>0 && $loop->index<4)
                            <a href="{{route('cms.know',$article->id)}}">
                                <div class="textOne fl">{{$article->title}}</div>
                                <div class="testTELeftUlDate fl">{{date('m-d',strtotime($article->created_at))}}</div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <div class="testTELeftUl fr">
                    @foreach($hot as $article)
                        @if($loop->index>4 && $loop->index<8)
                            <a href="{{route('cms.know',$article->id)}}">
                                <div class="textOne fl">{{$article->title}}</div>
                                <div class="testTELeftUlDate fl">{{date('m-d',strtotime($article->created_at))}}</div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="testTERight fr">
            <div class="testTERightTitle">
                最新文章
            </div>
            @foreach($all_new as $article)
                @if($loop->first)
                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                @endif
                <a href="{{route('cms.know',$article->id)}}">{{$article->title}}</a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection