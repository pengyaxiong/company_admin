@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')
    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.organizations')}}">海外医院</a> >
        <span>{{$organization->name}} </span>
    </div>
    <div class="hospital ">
        <div class="hospitalCont">
            <img class="hospitalImg " src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->image)}}">
            <div class="hospitalBox">
                <div class="hospitalName textLinesTwo">{{$organization->name}} </div>
                <div class="hospitalDes">
                    @if(!empty($organization->type))
                        @foreach($organization->type as $type)
                            <div>{{$type['name']}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="hospitalAddr">
            <img src="/mobile/img/addr.png">
            <div>
                地址：{{$organization->address}}
            </div>
        </div>
        <div class="hospitalTel">
            <img src="/mobile/img/tel.png">
            <div>
                电话：{{$organization->tel}}
            </div>
        </div>
        <div class="hospitalInfo">
            简介：{{$organization->info}}
        </div>
    </div>
    <!-- 广告 -->
    <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->banner)}}">

    <!-- content -->
    <div class="hospitalDocBoxTitle">
        <span>推荐专家</span>
    </div>

    @if(!empty($organization->doctor))
        @foreach($organization->doctor as $doctor)
            <a class="hospitalDocLink" href="#">
                <div class="docItemTop ">
                    <img class="docItemImg "
                         src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                    <div class="docItemInfo ">
                        <div class="docItemName textOne">{{$doctor['name']}}</div>
                        <div class="docItemFrom textOne">
                            <span>{{$doctor['job']}}</span>{{$doctor['hospital']}}</div>
                    </div>
                </div>
                <div class="textLinesTwo docItemDes">
                    {{$doctor['info']}}
                </div>
                <div class="docItemTips clearfix">
                    @if(!empty($doctor['type']))
                        <?php $types = explode('，', $doctor['type']) ?>
                        @foreach( $types as $type)
                            <div>{{$type}}</div>
                        @endforeach
                    @endif
                </div>
            </a>
        @endforeach
    @endif

    <div class="grayBlock"></div>

    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">
            热门文章
        </div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class=" textOne"
                   href="{{route('mobile.cms.article',$article->id)}}">{{$article->title}}</a>
            @endforeach
        </div>
    </div>

    @if($ads->first())
        <a href="{{$ads->first()->url}}">
            <img class="hotAd" src="{{\Storage::disk(config('admin.upload.disk'))->url($ads->first()->image)}}">
        </a>
    @endif
@endsection
@section('js')

@endsection