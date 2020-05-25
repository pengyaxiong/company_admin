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
        <div class="successNavOn"><a href="{{route('mobile.about.join')}}">加盟代理</a></div>
        <div><a href="{{route('mobile.about.job')}}">人才招聘</a></div>
        <div><a href="{{route('mobile.about.content')}}">联系我们</a></div>
    </div>

    <div class="title aboutTitle">
        <div class="titleEn">JOIN AGENT</div>
        <div class="titleZn">加盟代理</div>
        <img src="/mobile/img/yellowArror.png" class="yellowArror" >
    </div>

    <input class="yourName placeholder" type="text" id="name" name="name"  placeholder="请输入您的姓名（必填）"/>
    <input class="yourPhone placeholder" type="text" id="phone" name="phone" placeholder="请输入您的联系方式（必填）" />
    <input class="companyName placeholder" type="text" id="company" name="company"  placeholder="请输入您的公司名称" />
    <textarea class="textarea placeholder" placeholder="备注" id="remark" name="remark"></textarea>
    <div class="formTips">48小时内我们会有专人与你详细沟通</div>
    <div class="submitBtn">提交申请</div>

@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function () {
            $(".submitBtn").click(function () {
                var name = $("#name").val();
                var phone = $("#phone").val();
                var company = $("#company").val();
                var remark = $("#remark").val();

                $.ajax({
                    type: "post",
                    url: "{{route('mobile.about.join_us')}}",
                    data: {
                        name: name,
                        phone: phone,
                        company: company,
                        remark: remark,
                    },
                    success: function (data) {
                        swal("提交成功!", data.message, "success");
                    },
                    error: function (data, textStatus, errorThrown) {
                       // console.log(data.responseText)
                        swal("提交失败!", JSON.parse(data.responseText)['message'], "error");
                    }
                },'json');

            })
        });
    </script>
@endsection