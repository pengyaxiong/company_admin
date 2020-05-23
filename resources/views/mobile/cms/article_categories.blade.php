@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a> > <span>试管专题</span>
    </div>

    <div class="commonCont doctorCommonCont clearfix">

        <div class="commonLeft fl">
            <div class="doctorInfoCont">
                <div class="hospitalDocBoxTitle">
                    <span>今日资讯</span>
                    <a href="{{route('cms.today_articles')}}">更多</a>
                </div>
                <div class="clearfix smallCont">

                    <a class="fl advisoryImg" href="{{route('cms.article',$today->first()->id)}}">
                        <img class="advisoryImg"
                             src="{{\Storage::disk(config('admin.upload.disk'))->url($today->first()->image)}}">
                    </a>

                    <div class="fr advisoryR">
                        <a class="advisoryRA" href="{{route('cms.article',$today->first()->id)}}">
                            <div class="advisoryRATitle">
                                {{$today->first()->title}}
                            </div>
                            <div class="advisoryRADes">
                                {{$today->first()->info}}
                            </div>
                        </a>
                        <div class="clearfix advisoryRUlBox">

                            <div class="fl advisoryRUl">
                                @foreach($today as $article)
                                    @if($loop->index>0 && $loop->index<4)
                                        <a href="{{route('cms.article',$article->id)}}">
                                            {{$article->title}}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <div class="fr advisoryRUl">
                                @foreach($today as $article)
                                    @if($loop->index>4 && $loop->index<8)
                                        <a href="{{route('cms.article',$article->id)}}">
                                            {{$article->title}}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="commonLeftList commonWhiteBg clearfix">
                @foreach($categories as $category)
                    <div class="smallBox fl">
                        <div class="hospitalDocBoxTitle">
                            <span>{{$category->name}}</span>
                            <a href="{{route('cms.articles',['id'=>$category->id,'parent'=>true])}}">更多</a>
                        </div>
                        @if(!empty($category->articles)).
                        @foreach($category->articles as $article)
                            @if($loop->first)
                                <a class="smallImgA" href="{{route('cms.article',$article->id)}}">
                                    <img class="fl"
                                         src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                                    <div class="smallImgACont fr">
                                        <div class="smallImgATitle textOne">{{$article->title}}</div>
                                        <div class="smallImgAdes textLinesTwo">
                                            {{$article->info}}
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="smallBoxA textOne"
                                   href="{{route('cms.article',$article->id)}}">{{$article->title}}</a>
                            @endif
                        @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="fr">
            @foreach($know_means as $category)
                <div class="hotArticler smallArticler">
                    @if($loop->first)
                        <div class="hotArticleTitle">
                            知识百科
                        </div>
                    @endif
                    <div class="smallTitle">
                        {{$category->name}}
                    </div>
                    @if(!empty($category->children))
                        <div class="smallTitleBox">
                            @foreach($category->children as $children)
                                <a href="{{route('cms.knows',['id'=>$children->id])}}">{{$children->name}}</a>
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
        </div>

    </div>

@endsection
@section('js')

@endsection