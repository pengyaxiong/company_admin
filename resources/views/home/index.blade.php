@extends('home.layouts.base')

@section('title')

@endsection
@section('css')
    <style>
        .saCont {
            width: 1200px;
            height: 630px;
            margin-top: 30px;
            display: none;
        }

        .saContOn {
            display: block;
        }

        .indexNewsCont {
            margin-top: 41px;
            display: none;
        }

        .indexNewsContOn {
            display: block;
        }
    </style>
@endsection
@section('content')

    <!-- 轮播 -->
    <div class="indexSwiper swiper-container">
        <div class="swiper-wrapper">
            @if(!empty($banners))
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($banner->image)}}">
                    </div>
                @endforeach
            @endif
        </div>
        <div class="paginations"></div>
    </div>
    <!-- 多slide-->
    <div class="midSwiper">
        <div class="indexMid swiper-container">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <div class="indexMidSlideOne">{{$banner->title}}</div>
                        <div class="indexMidSlideTwo">{{$banner->info}}</div>
                    </div>
                @endforeach
            </div>
            <img src="/home/img/midLeft.png" class="arrow arrow-left">
            <img src="/home/img/midRight.png" class="arrow arrow-right">
        </div>
    </div>
    <!-- 悬浮logo -->
    <a class="hybRight" href=""><img src="/home/img/fiexd.png"></a>

    <!-- 专业领域 -->
    <div class="title">
        <div class="titleEn">PROFESSIONAL FIELD</div>
        <div class="titleZn">专业领域</div>
        <img src="/home/img/titleIcon.png" class="titleIcon">
    </div>
    <!-- 固定五个 -->
    <div class="professionalField clearfix">
        @foreach($fields as $field)
            <div class="professionalFieldItem">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($field->image)}}">
                <div class="textOne">{{$field->title}}</div>
            </div>
        @endforeach
    </div>
    <!-- 华孕宝服务优势 -->
    <div class="serviceAdvantages">
        <div class="title">
            <div class="titleEn">SERVICE ADVANTAGES</div>
            <div class="titleZn">华孕宝服务优势</div>
            <img src="/home/img/titleIcon.png" class="titleIcon">
        </div>
        <div class="container">
            <div class="saNav">
                @foreach($services as $key=>$service)
                    <div data-i='{{$key}}' @if($loop->first)class="saNavOn" @endif>{{$service->title}}</div>
                @endforeach
            </div>
            @foreach($services as $key=>$service)
                <div class="saCont @if($loop->first) saContOn @endif clearfix">
                    <div class="saInfo fl">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($service->image)}}" class="saBg">
                        <div class="saInfoCont">
                            <div class="saName">
                                {{$service->cn}}<span>{{$service->en}}</span>
                            </div>
                            <div class="saTips">
                                {{$service->info}}
                            </div>
                            <a class="saBtn" href="">咨询顾问 >></a>
                            @foreach($service->des as $des)
                                <div class="saLi">
                                    {{$des['info']}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="saList fr">
                        <!-- 图片宽高146固定，不参照设计图 -->
                        @foreach($service->image_text as $image_text)
                            <div class="saListItem">
                                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($service['image'])}}"
                                     class="asLIstImg">
                                <div class="saListTitle">{{$image_text['title']}}</div>
                                <div class="saListInfo">
                                    {{$image_text['info']}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 专业试管婴儿医院 -->
    <div class="title">
        <div class="titleEn">TUBE BABY HOSPITAL</div>
        <div class="titleZn">专业试管婴儿医院</div>
        <img src="/home/img/titleIcon.png" class="titleIcon">
    </div>
    <!-- 设计图上六个 -->
    <div class="tubeBabyHospital clearfix">
        @foreach($hospitals as $hospital)
            <a href="{{route('out.hospital',$hospital->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}">
                <div class="tbgTitle">
                    {{$hospital->name}}
                </div>
                <div class="tbgTip">
                    {{$hospital->info}}
                </div>
            </a>
        @endforeach
    </div>

    <a class="tubeBabyHospitalMore" href="{{route('out.hospitals')}}">查看更多</a>

    <!-- 广告 -->
    @if(!empty($sidles))
        @foreach($sidles as $sidle)
            <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($sidle->image)}}">
        @endforeach
    @endif

    <!-- 专业试管婴儿专家 -->
    <div class="title">
        <div class="titleEn">TUBE BABY DOCTOR</div>
        <div class="titleZn">专业试管婴儿专家</div>
        <img src="/home/img/titleIcon.png" class="titleIcon">
    </div>
    <div class="tubeBabyDoctor clearfix">
        @foreach($doctors as $doctor)
            <div class="tbdItems">
                <img class="tbdItemsImg fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->image)}}">
                <div class="fl">
                    <div class="docName">{{$doctor->name}}</div>
                    <div class="docHos">所属医院：{{$doctor->hospital->name}}</div>
                    <div class="docPos">医生职位：{{$doctor->job}}</div>
                    <div class="docGood">擅长项目：{{implode('/',array_column($doctor->type,'name'))}}</div>
                    <div class="docHandle">
                        <a class="docHandleSee" href="{{route('out.doctor',$doctor->id)}}">查看详情</a>
                        <a class="docHandleTalk" href="{{route('out.doctor',$doctor->id)}}">立即咨询</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="tubeBabyHospitalMore" href="{{route('out.doctors')}}">查看更多</a>
    <!-- 成功案例 -->
    <div class="successCase">
        <div class="title">
            <div class="titleEn">SUCCESS CASE</div>
            <div class="titleZn">成功案例</div>
            <img src="/home/img/titleIcon.png" class="titleIcon">
        </div>
        <div class="container clearfix">
            @foreach($works as $work)
                @if($loop->index==0)
                    <a href="{{route('out.work',$work->id)}}" class="successCaseLeft scHover fl">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                        <div class="sclTitle textOne comhovera">
                            {{$work->title}}
                        </div>
                        <div class="sclInfo comhovera">
                            {{$work->info}}
                        </div>
                    </a>
                @endif
                @if($loop->index>0)
                    <div class="successCaseright fr">
                        <div class="scrTop clearfix">
                            @if($loop->index==1)
                                <a class="fl scHover" href="{{route('out.work',$work->id)}}">
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                                    <div class="srcTopTitle textOne comhovera"> {{$work->title}}</div>
                                    <div class="srcTopInfo comhovera">
                                        {{$work->info}}
                                    </div>
                                </a>
                            @endif
                            @if($loop->index==2)
                                <a class="fr scHover" href="{{route('out.work',$work->id)}}">
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                                    <div class="srcTopTitle textOne comhovera"> {{$work->title}}</div>
                                    <div class="srcTopInfo comhovera">
                                        {{$work->info}}
                                    </div>
                                </a>
                            @endif
                        </div>
                        @if($loop->index==3)
                            <a href="{{route('out.work',$work->id)}}" class="clearfix bdzBox scHover">
                                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}"
                                     class="bdz fl">
                                <div class="fl bdzBoxr">
                                    <div class="gbzTitle comhovera"> {{$work->title}}</div>
                                    <div class="bzdInfo comhovera">
                                        {{$work->info}}
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
        <a class="tubeBabyHospitalMore" href="{{route('out.works',-1)}}">查看更多</a>
    </div>

    <!-- 底部选项卡 新闻-->
    <div class="indexNews">

        <div class="indexNewsNav clearfix">
            @foreach($categories as $key=>$category)
                <div data-i='{{$key}}' @if($loop->first)class="indexNewsNavOn" @endif>
                    {{$category->name}}
                </div>
            @endforeach

        </div>
        @foreach($categories as $key=>$category)
            <div class="indexNewsCont @if($loop->first) indexNewsContOn @endif clearfix">
                @if(!empty($category->articles))
                    @foreach($category->articles as $article)
                        @if($loop->index==0)
                            <a class="fl indexNewsLinkL" href="{{route('home.article',$article->id)}}">
                                <img class="" src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                                <div class="textOne">{{$article->title}}</div>
                                <div class="textLinesTwo">{{$article->info}}</div>
                            </a>
                        @endif
                        <div class="fl indexNewsContR">
                            <div class="fl indexNewsContRL">
                                @if($loop->index>0 && $loop->index<5)
                                    <a class="indexNewsLinkR" href="{{route('home.article',$article->id)}}">
                                        <img class="fl" src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                                        <div class="fl indexNewsLinkRTxt">
                                            <div class="textOne">{{$article->title}}</div>
                                            <div class="textLinesTwo">{{$article->info}}
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            <div class="fl indexNewsUl">
                                @if($loop->index>4 && $loop->index<14)
                                    <a class="indexNewsUlA" href="{{route('home.article',$article->id)}}">{{$article->title}}</a>
                                @endif
                                <a class="indexNewsUlAMore" href="{{route('home.articles')}}">查看更多 >></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

@endsection
@section('js')
    <script>
        $(function () {

        })
    </script>
@endsection