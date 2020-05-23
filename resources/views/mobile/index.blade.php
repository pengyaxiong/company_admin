@extends('mobile.layouts.base')

@section('title')

@endsection
@section('css')
    <style>
        .advantageCont {
            display: none;
            -webkit-justify-content: center;
            justify-content: baseline;
        }

        .advantageContOn {
            display: flex;
            display: -webkit-flex;
        }

        .indexNewsBox {
            display: none;
        }

        .indexNewsBoxOn {
            display: block;
        }
    </style>
@endsection
@section('content')

    <!-- 轮播 -->
    <div class="idexSwiper swiper-container">
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
            <img src="/mobile/img/left.png" class="arrow arrow-left">
            <img src="/mobile/img/right.png" class="arrow arrow-right">
        </div>
    </div>

    <!-- 专业领域 -->
    <div class="title">
        <div class="titleEn">PROFESSIONAL FIELD</div>
        <div class="titleZn">专业领域</div>
        <img src="/mobile/img/yellowArror.png" class="yellowArror">
    </div>
    <!-- 固定五个 -->
    <div class="professionalField">
        @foreach($fields as $field)
            <a href="#">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($field->image)}}">
                <div>{{$field->title}}</div>
            </a>
        @endforeach
    </div>

    <!-- 华孕宝服务优势 -->
    <div class="advantage">
        <div class="title">
            <div class="titleEn">SERVICE ADVANTAGES</div>
            <div class="titleZn">华孕宝服务优势</div>
            <img src="/mobile/img/yellowArror.png" class="yellowArror">
        </div>
        <div class="advantageNav">
            @foreach($services as $key=>$service)
                <div data-i='{{$key}}' @if($loop->first)class="advantageNavOn " @endif>{{$service->title}}</div>
            @endforeach
        </div>
        @foreach($services as $key=>$service)
            <div class="advantageCont @if($loop->first) advantageContOn @endif clearfix">
                <div class="advantageContLeft">
                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($service->image)}}"
                         class="advantageContBg">
                    <div class="advantageContLeftBox">
                        <div class="advantageTitle">
                            {{$service->cn}}<span>{{$service->en}}</span>
                        </div>
                        <div class="advantageDes">
                            {{$service->info}}
                        </div>
                        <a class="advantageContBtn" href="">咨询顾问 >></a>
                        @foreach($service->des as $des)
                            <div class="advantageLink textLinesTwo">
                                {{$des['info']}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="advantageContList">
                    <!-- 图片宽高146固定，不参照设计图 -->
                    @foreach($service->image_text as $image_text)
                        <a href="">
                            <img src="{{\Storage::disk(config('admin.upload.disk'))->url($service['image'])}}"
                                 class="asLIstImg">
                            <div class="textLinesTwo">{{$image_text['title']}}</div>
                            <div class="textLinesThree">
                                {{$image_text['info']}}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- 专业试管婴儿医院 -->
    <div class="title">
        <div class="titleEn">TUBE BABY HOSPITAL</div>
        <div class="titleZn">专业试管婴儿医院</div>
        <img src="/mobile/img/yellowArror.png" class="yellowArror">
    </div>
    <!-- 设计图上六个 -->
    <div class="tubeBabyHospital clearfix">
        @foreach($hospitals as $hospital)
            <a href="{{route('mobile.out.hospital',$hospital->id)}}">
                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($hospital->image)}}">
                <div class="tbgTitle textOne">
                    {{$hospital->name}}
                </div>
                <div class="tbgTip textLinesTwo">
                    {{$hospital->info}}
                </div>
            </a>
        @endforeach
    </div>

    <a class="tubeBabyHospitalMore" href="{{route('mobile.out.hospitals')}}">查看更多</a>

    <!-- 广告 -->
    @if(!empty($sidles))
        @foreach($sidles as $sidle)
            <img class="indexad" src="{{\Storage::disk(config('admin.upload.disk'))->url($sidle->image)}}">
        @endforeach
    @endif

    <!-- 专业试管婴儿专家 -->
    <div class="tubeBabyDoctor ">
        <div class="title">
            <div class="titleEn">TUBE BABY DOCTOR</div>
            <div class="titleZn">专业试管婴儿专家</div>
            <img src="/mobile/img/yellowArror.png" class="yellowArror">
        </div>
        @foreach($doctors as $doctor)
            <div class="tbdItems">
                <img class="tbdItemsImg" src="{{\Storage::disk(config('admin.upload.disk'))->url($doctor->image)}}">
                <div class="tbdItemsCont">
                    <div class="docName textOne">{{$doctor->name}}</div>
                    <div class="docHos textOne">所属医院：{{$doctor->hospital->name}}</div>
                    <div class="docPos textOne">医生职位：{{$doctor->job}}</div>
                    <div class="docGood textOne">擅长项目：{{implode('/',array_column($doctor->type,'name'))}}</div>
                    <div class="docHandle">
                        <a class="docHandleSee" href="{{route('mobile.out.doctor',$doctor->id)}}">查看详情</a>
                        <a class="docHandleTalk" href="{{route('mobile.out.doctor',$doctor->id)}}">立即咨询</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="tubeBabyHospitalMore" href="{{route('mobile.out.doctors')}}">查看更多</a>
    <!-- 成功案例 -->
    <div class="successCase">
        <div class="title">
            <div class="titleEn">SUCCESS CASE</div>
            <div class="titleZn">成功案例</div>
            <img src="/mobile/img/yellowArror.png" class="yellowArror">
        </div>
        <div class="container ">
            @foreach($works as $work)
                @if($loop->index==0)
                    <a href="{{route('mobile.out.work',$work->id)}}" class="successCaseLeft">
                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                        <div class="sclTitle textOne ">
                            {{$work->title}}
                        </div>
                        <div class="sclInfo textLinesThree">
                            {{$work->info}}
                        </div>
                    </a>
                @endif
                @if($loop->index>0)
                    <div class="successCaseright ">
                        <div class="scrTop ">
                            @if($loop->index==1)
                                <a href="{{route('mobile.out.work',$work->id)}}">
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                                    <div class="srcTopTitle textOne "> {{$work->title}}</div>
                                    <div class="srcTopInfo textLinesTwo">
                                        {{$work->info}}
                                    </div>
                                </a>
                            @endif
                            @if($loop->index==2)
                                <a href="{{route('mobile.out.work',$work->id)}}">
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}">
                                    <div class="srcTopTitle textOne "> {{$work->title}}</div>
                                    <div class="srcTopInfo textLinesTwo">
                                        {{$work->info}}
                                    </div>
                                </a>
                            @endif
                        </div>
                        @if($loop->index==3)
                            <a href="{{route('mobile.out.work',$work->id)}}" class="bdzBox">
                                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($work->image)}}"
                                     class="bdz ">
                                <div class=" bdzBoxr">
                                    <div class="gbzTitle textLinesTwo"> {{$work->title}}</div>
                                    <div class="bzdInfo ">
                                        {{$work->info}}
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
        <a class="tubeBabyHospitalMore" href="{{route('mobile.out.works',-1)}}">查看更多</a>
    </div>

    <!-- 底部选项卡 新闻-->
    <div class="indexNews">

        <div class="indexNewsNav">
            @foreach($categories as $key=>$category)
                <div data-i='{{$key}}' @if($loop->first)class="indexNewsNavOn" @endif>
                    {{$category->name}}
                </div>
            @endforeach

        </div>
        @foreach($categories as $key=>$category)
            <div class="indexNewsBox @if($loop->first) class='indexNewsBoxOn' @endif">
                @if(!empty($category->articles))
                    @foreach($category->articles as $article)
                        <div class="indexNewsCont">
                            @if($loop->index==0)
                                <a class=" indexNewsLinkL" href="{{route('mobile.article',$article->id)}}">
                                    <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                                    <div class="textOne">{{$article->title}}</div>
                                    <div class="textLinesTwo">{{$article->info}}</div>
                                </a>
                            @endif
                            <div class=" indexNewsContR">
                                @if($loop->index>0 && $loop->index<5)
                                    <a class="indexNewsContRLink" href="{{route('mobile.article',$article->id)}}">
                                        <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}">
                                        <div class=" indexNewsLinkRTxt">
                                            <div class="indexNewsContRTitle textOne">{{$article->title}}</div>
                                            <div class="indexNewsContRDes textOne">{{$article->info}}
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="indexNewsUlBox">
                            @if($loop->index>4 && $loop->index<14)
                                <a class="textOne"
                                   href="{{route('mobile.article',$article->id)}}">{{$article->title}}</a>
                            @endif
                        </div>
                    @endforeach
                @endif
                <div class="indexNewsMore">
                    <a href="{{route('mobile.articles',['id'=>$category->id])}}">查看更多 >></a>
                </div>
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