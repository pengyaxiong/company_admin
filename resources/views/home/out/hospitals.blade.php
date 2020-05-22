@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <!-- 面包屑导航 -->
    <div class="breadcrumbs">
        <img src="/home/img/bicon.png">
        <a href="{{route('home.index')}}">网站首页 </a>> <span>海外医院</span>
    </div>
    <!-- 列表 -->
    <div class="ohList">
        @foreach($hospitals as $hospital)
            <a class="ohListItem" href="{{route('out.hospital',$hospital->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}" class="fl ohListItemImg">
                <div class="fl ohListItemCont">
                    <div class="fl ohListItemBox">
                        <div class="ohListName">
                            {{$hospital->name}}<span>{{$hospital->leave}}</span>
                        </div>
                        <div class="ohListInfos">
                            <div class="ohListInfo">
                                地址：{{$hospital->address}}
                            </div>
                            <div class="ohListInfo">
                                电话：{{$hospital->tel}}
                            </div>
                        </div>
                        <div class="ohListDes">
                            @if(!empty($hospital->type))
                                @foreach($hospital->type as $type)
                                    <div>{{$type['name']}}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="fr ohListers">
                        <div class="ohListImgs">
                            @if(!empty($hospital->doctor))
                                @foreach($hospital->doctor as $doctor)
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor['image'])}}">
                                @endforeach
                            @endif
                        </div>
                        <div class="ohListTips">累计{{count($hospital->doctors)}}名专家</div>
                    </div>
                </div>
            </a>
        @endforeach
    <!-- 分页 -->
        {!! $hospitals->appends(Request::all())->links('home.layouts._page') !!}
    </div>
    <!-- 相关推荐 -->
    <div class="relatedSuggestion">
        <div class="relatedSuggestionTitle">相关推荐</div>
        <div class="relatedSuggestionCont">
            @foreach($articles as $article)
                <a class="textOne" href="{{route('out.article',$article->id)}}">
                    {{$article->title}}
                </a>
            @endforeach
        </div>
    </div>

@endsection
@section('js')
  
@endsection