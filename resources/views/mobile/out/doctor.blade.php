@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('out.doctors')}}">海外医生</a> >
        <span>{{$doctor->name}}</span>
    </div>
    <div class="doctor clearfix">
        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->image)}}" class="doctorImg fl">
        <div class="doctorCont fl">
            <div class="clearfix">
                <div class="doctorName fl">{{$doctor->name}}</div>
                <div class="doctorZw fl">{{$doctor->job}}</div>
                <div class="doctorFrom fl">{{$doctor->hospital->name}}</div>
            </div>
            <div class="doctorDes">
                {{$doctor->info}}
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
    <!-- 广告 -->
    <img class="hdad" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->banner)}}">
    <div class="commonCont doctorCommonCont clearfix">
        <div class="commonLeft fl">
            <div class="doctorInfoCont">
                <div class="hospitalDocBoxTitle">
                    <span>专家介绍</span>
                </div>
                <div class="goodAt">
                    <span>擅长：</span>{{implode(',',array_column($doctor->type,'name'))}}

                </div>
                <div class="goodAt">
                    {!! $doctor->description !!}
                </div>
            </div>
            <div class="commonLeftList commonWhiteBg">
                <div class="hospitalDocBoxTitle">
                    <span>成功案例</span>
                </div>
                @foreach($articles as $article)
                    <a href="{{route('out.work',$article->id)}}" class="doctorLink clearfix">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                             class="doctorLinkImg fl">
                        <div class="doctorLinkCont fr">
                            <div class="doctorLinkTitle textOne">{{$article->title}}</div>
                            <div class="textLinesThree doctorLinkDes">
                                {{$article->info}}
                            </div>
                            <div class="doctorLinkData">{{date('Y-m-d',strtotime($article->created_at))}}</div>
                        </div>
                    </a>
                @endforeach
            <!-- 分页 -->
                {!! $articles->appends(Request::all())->links('mobile.layouts._page') !!}
            </div>
        </div>

        <div class="fr">
            <div class="hotArticler">
                <div class="hotArticleTitle">
                    热门文章
                </div>
                @foreach($all_hot as $article)
                    @if($loop->first)
                        <img class="hotArticleImg"
                             src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                    @endif
                    <a class="hotArticleLink textOne"
                       href="{{route('out.article',$article->id)}}">{{$article->title}}</a>
                @endforeach
            </div>

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