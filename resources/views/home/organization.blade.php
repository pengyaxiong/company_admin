@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <a href="{{route('home.organizations')}}">海外医院</a> >
        <span>{{$organization->name}} </span>
    </div>
    <div class="hospital clearfix">
        <img class="hospitalImg fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->image)}}">
        <div class="hospitalCont fl">
            <div class="hospitalName textOne">{{$organization->name}} </div>
            <div class="hospitalAddr">
                <img src="/home/img/addr.png">
                地址：{{$organization->address}}
            </div>
            <div class="hospitalTel">
                <img src="/home/img/tel.png">
                电话：{{$organization->tel}}
            </div>
            <div class="hospitalDes clearfix">
                @if(!empty($organization->type))
                    @foreach($organization->type as $type)
                        <div>{{$type['name']}}</div>
                    @endforeach
                @endif
            </div>
            <div class="hospitalInfo">
                {{$organization->info}}
            </div>
        </div>
    </div>
    <!-- 广告 -->
    <img class="hdad" src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->banner)}}">

    <!-- content -->
    <div class="hospitalDoc clearfix">
        <div class="hospitalDocBox  fl">
            <div class="hospitalDocBoxTitle">
                <span>推荐专家</span>
            </div>
            <div class="hospitalDocList clearfix">
                @if(!empty($organization->doctor))
                    @foreach($organization->doctor as $doctor)
                        <a class="hospitalDocLink" href="#">
                            <div class="docItemTop clearfix">
                                <img class="docItemImg fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                                <div class="docItemInfo fl">
                                    <div class="docItemName textOne">{{$doctor['name']}}</div>
                                    <div class="docItemFrom textOne"><span>{{$doctor['job']}}</span>{{$doctor['hospital']}}</div>
                                </div>
                            </div>
                            <div class="textLinesTwo docItemDes">
                                {{$doctor['info']}}
                            </div>
                            <div class="docItemTips clearfix">
                                @if(!empty($doctor['type']))
                                    <?php $types= explode('，',$doctor['type']) ?>
                                    @foreach( $types as $type)
                                        <div>{{$type}}</div>
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
                       href="{{route('cms.article',$article->id)}}">{{$article->title}}</a>
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