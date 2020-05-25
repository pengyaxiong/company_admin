@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('out.hospitals')}}">海外医院</a> >
        <span>{{$hospital->name}} </span>
    </div>
    <div class="hospital clearfix">
        <img class="hospitalImg fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}">
        <div class="hospitalCont fl">
            <div class="hospitalName textOne">{{$hospital->name}} </div>
            <div class="hospitalAddr">
                <img src="/home/img/addr.png">
                地址：{{$hospital->address}}
            </div>
            <div class="hospitalTel">
                <img src="/home/img/tel.png">
                电话：{{$hospital->tel}}
            </div>
            <div class="hospitalDes clearfix">
                @if(!empty($hospital->type))
                    @foreach($hospital->type as $type)
                        <div>{{$type['name']}}</div>
                    @endforeach
                @endif
            </div>
            <div class="hospitalInfo">
                {{$hospital->info}}
            </div>
        </div>
    </div>
    <!-- 广告 -->
    <img class="hdad" src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->banner)}}">

    <!-- content -->
    <div class="hospitalDoc clearfix">
        <div class="hospitalDocBox  fl">
            <div class="hospitalDocBoxTitle">
                <span>推荐专家</span>
            </div>
            <div class="hospitalDocList clearfix">
                @if(!empty($hospital->doctors))
                    @foreach($hospital->doctors as $doctor)
                        <a class="hospitalDocLink" href="{{route('out.doctor',$doctor->id)}}">
                            <div class="docItemTop clearfix">
                                <img class="docItemImg fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                                <div class="docItemInfo fl">
                                    <div class="docItemName textOne">{{$doctor['name']}}</div>
                                    <div class="docItemFrom textOne"><span>{{$doctor['job']}}</span>{{$hospital->name}}</div>
                                </div>
                            </div>
                            <div class="textLinesTwo docItemDes">
                                {{$doctor['info']}}
                            </div>
                            <div class="docItemTips clearfix">
                                @if(!empty($doctor->type))
                                    @foreach( $doctor->type as $type)
                                        <div>{{$type['name']}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="fr">
            <div class="hotArticler">
                <div class="hotArticleTitle">
                    热门文章
                </div>
                @foreach($articles as $article)
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