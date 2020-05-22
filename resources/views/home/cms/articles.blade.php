@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a> > <a href="{{route('cms.article_categories')}}">试管专题 </a> >
        <span>{{$category_name['name']}}</span>
    </div>

    <div class="commonCont doctorCommonCont clearfix">
        <div class="commonLeft fl">
            <div class="commonLeftList commonWhiteBg">
                @foreach($articles as $article)
                    <a href="{{route('cms.article',$article->id)}}" class="doctorLink clearfix">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                             class="doctorLinkImg fl">
                        <div class="doctorLinkCont fr">
                            <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                            <div class="textLinesThree doctorLinkDes">
                                {{$article->info}}
                            </div>
                            <div class="doctorLinkData"> {{date("Y-m-d",strtotime($article->created_at))}}</div>
                        </div>
                    </a>
                @endforeach

            <!-- 分页 -->
                {!! $articles->appends(Request::all())->links('home.layouts._page') !!}

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