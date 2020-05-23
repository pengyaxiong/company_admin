@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <span>生殖机构大全</span>
    </div>
    <!-- 列表 -->
    <div class="ohList">
        @foreach($organizations as $organization)
            <a class="ohListItem" href="{{route('home.organization',$organization->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->image)}}" class="fl ohListItemImg">
                <div class="fl ohListItemCont">
                    <div class="fl ohListItemBox">
                        <div class="ohListName">
                            {{$organization->name}}<span>{{$organization->leave}}</span>
                        </div>
                        <div class="ohListInfos">
                            <div class="ohListInfo">
                                地址：{{$organization->address}}
                            </div>
                            <div class="ohListInfo">
                                电话：{{$organization->tel}}
                            </div>
                        </div>
                        <div class="ohListDes">
                            @if(!empty($organization->type))
                                @foreach($organization->type as $type)
                                    <div>{{$type['name']}}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="fr ohListers">
                        <div class="ohListImgs">
                            @if(!empty($organization->doctor))
                                @foreach($organization->doctor as $doctor)
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                                @endforeach
                            @endif
                        </div>
                        <div class="ohListTips">累计{{count($organization->doctor)}}名专家</div>
                    </div>
                </div>
            </a>
        @endforeach
    <!-- 分页 -->
        {!! $organizations->appends(Request::all())->links('mobile.layouts._page') !!}
    </div>
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class="textOne" href="{{route('cms.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection