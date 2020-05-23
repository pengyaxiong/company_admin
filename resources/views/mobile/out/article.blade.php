@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('out.articles')}}">试管套餐</a> > <span>  {{$article->title}}</span>
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
                   href="{{ $article['prev_data']? route('cms.article',$article['prev_data']['id']):'#'}}"><span>上一篇：</span>{{ $article['prev_data']? $article['prev_data']['title']:'暂无'}}
                </a>
                <a class="fl textOne"
                   href="{{ $article['next_data']? route('cms.article',$article['next_data']['id']):'#'}}"><span>下一篇：</span>{{ $article['next_data']? $article['next_data']['title']:'暂无'}}
                </a>
            </div>
            <div class="grayDiv"></div>

            <!-- 相关推荐 -->
            <div class="relatedSuggestion testTpdl">
                <div class="relatedSuggestionTitle">相关推荐</div>
                <div class="relatedSuggestionCont">
                    @foreach($hot_articles as $article)
                        <a class="textOne" href="{{route('out.article',$article->id)}}">{{$article->title}}</a>
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
                @foreach($recommend_articles as $article)
                    <a class="hotArticleLink textOne"
                       href="{{route('out.article',$article->id)}}">{{$article->title}}</a>
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