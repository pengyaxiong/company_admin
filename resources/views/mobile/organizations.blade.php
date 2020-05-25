@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('mobile.index')}}">网站首页 </a>> <span>生殖机构大全</span>
    </div>
    <!-- 列表 -->
    <div class="ohList">
        @foreach($organizations as $organization)
            <a class="ohListItem" href="{{route('mobile.organization',$organization->id)}}">
                <div class="ohListItemCont">
                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($organization->image)}}"
                         class=" ohListItemImg">
                    <div class=" ohListItemBox">
                        <div class="ohListName">
                            {{$organization->name}}<span>{{$organization->leave}}</span>
                        </div>
                        <div class="ohListInfos">
                            <div class="ohListInfo textLinesTwo">
                                地址：{{$organization->address}}
                            </div>
                            <div class="ohListInfo textLinesTwo">
                                电话：{{$organization->tel}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ohListDes">
                    @if(!empty($organization->type))
                        @foreach($organization->type as $type)
                            <div>{{$type['name']}}</div>
                        @endforeach
                    @endif
                </div>
            </a>
        @endforeach
    <!-- 分页 -->
        {!! $organizations->appends(Request::all())->links('mobile.layouts._page') !!}
    </div>
    <div class="grayBlock"></div>
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class="textOne" href="{{route('mobile.cms.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')

@endsection