@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="successNav">
        <div><a href="{{route('mobile.about.company')}}">公司简介</a></div>
        <div><a href="{{route('mobile.about.articles')}}">新闻资讯</a></div>
        <div><a href="{{route('mobile.about.join')}}">加盟代理</a></div>
        <div><a href="{{route('mobile.about.job')}}">人才招聘</a></div>
        <div class="successNavOn"><a href="{{route('mobile.about.content')}}">联系我们</a></div>
    </div>

    <div class="title aboutTitle">
        <div class="titleEn">CONTACT US</div>
        <div class="titleZn">联系我们</div>
        <img src="/mobile/img/yellowArror.png" class="yellowArror">
    </div>

    <div class="mapBox">
        <div id="allmap"></div>
    </div>

    <div class="cmpName">{{$contacts->name}}</div>
    <div class="cmpItem">
        <img src="/mobile/img/u1.png" >
        {{$contacts->phone}}
    </div>
    <div class="cmpItem">
        <img src="/mobile/img/u2.png" >
        {{$contacts->tel}}
    </div>
    <div class="cmpItem">
        <img src="/mobile/img/u3.png" >
        {{$contacts->email}}
    </div>
    <div class="cmpItem cmpItemLats">
        <img src="/mobile/img/u4.png" >
        {{$contacts->address}}
    </div>

@endsection
@section('js')
    <script type="text/javascript"
            src="https://map.qq.com/api/gljs?v=1.exp&key=VVYBZ-HRJCX-NOJ4Z-ZO3PU-ZZA2J-QPBBT"></script>
    <script>
        $(function () {
            var center = new TMap.LatLng('{{$contacts->lat}}', '{{$contacts->lng}}');
            //初始化地图
            var map = new TMap.Map("allmap", {
                center: center,
                zoom: 16
            });
            //初始化marker
            var marker = new TMap.MultiMarker({
                id: "marker-layer", //图层id
                map: map,
                styles: { //点标注的相关样式
                    "marker": new TMap.MarkerStyle({
                        "width": 25,
                        "height": 35,
                        "anchor": {x: 16, y: 32},
                    })
                },
                geometries: [{ //点标注数据数组
                    "id": "label",
                    "styleId": "label",
                    "position": new TMap.LatLng('{{$contacts->lat}}', '{{$contacts->lng}}'),
                    'content': '{{$contacts->name}}', //标注文本
                    "properties": {
                        "title": "label"
                    }
                }]
            });

        })
    </script>
@endsection