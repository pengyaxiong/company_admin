@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/mobile/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <a href="{{route('mobile.out.hospitals')}}">海外医院</a> >
        <span>{{$hospital->name}} </span>
    </div>

    <div class="hospital">
        <div class="hospitalCont ">
            <img class="hospitalImg " src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}">
            <div class="hospitalBox">
                <div class="hospitalName textLinesTwo">{{$hospital->name}}</div>
                <div class="hospitalDes">
                    @if(!empty($hospital->type))
                        @foreach($hospital->type as $type)
                            <div>{{$type['name']}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="hospitalAddr">
            <img src="/mobile/img/addr.png">
            地址：{{$hospital->address}}
        </div>
        <div class="hospitalTel">
            <img src="/mobile/img/tel.png">
            电话：{{$hospital->tel}}
        </div>

        <div class="hospitalInfo">
            {{$hospital->info}}
        </div>
    </div>

    <!-- 广告 -->
    <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->banner)}}">

    <!-- content -->

    <div class="hospitalDocBoxTitle">
        <span>推荐专家</span>
    </div>

    @if(!empty($hospital->doctors))
        @foreach($hospital->doctors as $doctor)
            <a class="hospitalDocLink" href="{{route('mobile.out.doctor',$doctor->id)}}">
                <div class="docItemTop ">
                    <img class="docItemImg "
                         src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                    <div class="docItemInfo ">
                        <div class="docItemName textOne">{{$doctor['name']}}</div>
                        <div class="docItemFrom textOne"><span>{{$doctor['job']}}</span>{{$hospital->name}}
                        </div>
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

    <div class="grayBlock"></div>

    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">热门文章</div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class=" textOne"
                   href="{{route('mobile.out.article',$article->id)}}">{{$article->title}}</a>
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