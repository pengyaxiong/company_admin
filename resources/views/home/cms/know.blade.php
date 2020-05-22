@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('cms.knows')}}">科室介绍</a>> <a
                href="{{route('cms.knows',['id'=>$article->category->id])}}">{{$article->category->name}}</a>
        > <span>{{$article->title}}</span>
    </div>
    <div class="commonCont doctorCommonCont clearfix">
        <div class="commonLeft testTpdCont fl">
            <div class="testTpdTitle">
                {{$article->title}}
            </div>
            <div class="testTpdDes">
                来源：{{$article->from}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：{{$article->author}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：{{$article->created_at}}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读量：{{$article->see_num}}
            </div>
            <div class="richCont">
                {!! $article->description !!}
            </div>
            <div class="nestPrev clearfix">
                <a class="fl textOne"
                   href="{{ $article['prev_data']? route('cms.know',$article['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $article['prev_data']? $article['prev_data']['title']:'暂无'}}
                </a>
                <a class="fl textOne"
                   href="{{ $article['next_data']? route('cms.know',$article['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $article['next_data']? $article['next_data']['title']:'暂无'}}
                </a>
            </div>
            <div class="grayDiv"></div>

            <!-- 相关推荐 -->
            <div class="relatedSuggestion testTpdl">
                <div class="relatedSuggestionTitle">相关推荐</div>
                <div class="relatedSuggestionCont">
                    @foreach($recommend_articles as $article)
                        <a class="textOne" href="{{route('cms.know',['id'=>$article->id])}}">
                            {{$article->title}}
                        </a>
                    @endforeach
                </div>
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