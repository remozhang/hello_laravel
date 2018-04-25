@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">新增一篇文章</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>新增失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('admin/articles') }}" method="POST">
                            {{--这段是laravel内置应对CSRF攻击的防范措施，任何POST PUT PATCH都会被检测是否提交了CSRF字段--}}
                            {{-- <input type="hidden" name="_token" value="{{csrf_field()}}}">--}}
                            {!! csrf_field() !!}
                            <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题" value="{{old('body')}}">
                            <br>
                            <textarea name="body" rows="10" class="form-control" required="required" placeholder="请输入内容">{{old('body')}}</textarea>
                            <br>
                            <button class="btn btn-lg btn-info">新增文章</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection