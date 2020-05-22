@extends('home.layouts.base')

@section('title')

@endsection
@section('css')

@endsection
@section('content')

    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($company->image)}}" class="indexad">
    <div class="companyProfileNav">
        <div class="companyProfileNavBox">
            <a href="{{route('about.company')}}">公司简介</a>
            <a href="{{route('about.articles')}}">新闻资讯</a>
            <a href="{{route('about.join')}}">加盟代理</a>
            <a href="{{route('about.job')}}">人才招聘</a>
            <a class="companyProfileNavOn" href="{{route('about.content')}}">联系我们</a>
        </div>
    </div>
    <div class="title ustitle">
        <div class="titleEn">CONTACT US</div>
        <div class="titleZn">联系我们</div>
        <img src="/home/img/titleIcon.png" class="titleIcon" >
    </div>
    <div class="mapBox">
        <div id="allmap" style="height: 500px"></div>
        <div class="mapInfo">
            <div class="mapInfoTitle">{{$contacts->name}}</div>
            <div class="mapInfoItem">
                <img src="/home/img/m1.png" >
                <div class="fl">
                    {{$contacts->phone}}
                </div>
            </div>
            <div class="mapInfoItem">
                <img src="/home/img/m2.png" >
                <div class="fl">
                    {{$contacts->tel}}
                </div>
            </div>
            <div class="mapInfoItem">
                <img src="/home/img/m3.png" >
                <div class="fl">
                    {{$contacts->email}}
                </div>
            </div>
            <div class="mapInfoItem">
                <img src="/home/img/m4.png" >
                <div class="fl">
                    {{$contacts->address}}
                </div>
            </div>
        </div>
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
                zoom: 17
            });
            //初始化marker
            var marker = new TMap.MultiMarker({
                id: "marker-layer", //图层id
                map: map,
                styles: { //点标注的相关样式
                    "marker": new TMap.MarkerStyle({
                        "width": 25,
                        "height": 35,
                        "anchor": { x: 16, y: 32 },
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