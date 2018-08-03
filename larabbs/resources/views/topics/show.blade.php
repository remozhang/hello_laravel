@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->description)

@section('content')
<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    作者：{{ $topic->user->name }}
                </div>
                <hr>
                <div class="media">
                    <div align="center">
                        <a href="{{ route('users.show', $topic->user->id) }}">
                            <img src="{{ $topic->user->avatar }}" width="300px" hight="300px" alt="" class="thumbnail img-responsive">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $topic->title }}
                </h1>

                <div class="article-meta text-center">
                    {{ $topic->created_at->diffForHumans() }}
                    .
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $topic->reply_count }}
                </div>

                <div class="topic-body">
                    {!! $topic->body !!}
                </div>

                {{-- 这里can应该是调用policies，来判断是否拥有权限来进行操作 --}}
                @can('update', $topic)
                    <div class="operate">
                        <hr>
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>

                        <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                <i class="glyphicon glyphicon-trash"></i>
                                删除
                            </button>
                        </form>
                        
                        {{--<a href="#" class="btn btn-default btn-xs" role="button">--}}
                            {{--<i class="glyphicon glyphicon-trash"></i> 删除--}}
                        {{--</a>--}}
                    </div>
                @endcan

            </div>
        </div>

        {{--用户回复列表--}}
        <div class="panel penel-default topic-reply">
            {{--注意读取时需要使用懒加载来避免N+1问题--}}
            <div class="panel-body">
                @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
            </div>
        </div>
    </div>
</div>


{{--<div class="container">--}}
    {{--<div class="col-md-10 col-md-offset-1">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h1>Topic / Show #{{ $topic->id }}</h1>--}}
            {{--</div>--}}

            {{--<div class="panel-body">--}}
                {{--<div class="well well-sm">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                            {{--<a class="btn btn-link" href="{{ route('topics.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                             {{--<a class="btn btn-sm btn-warning pull-right" href="{{ route('topics.edit', $topic->id) }}">--}}
                                {{--<i class="glyphicon glyphicon-edit"></i> Edit--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<label>Title</label>--}}
{{--<p>--}}
	{{--{{ $topic->title }}--}}
{{--</p> <label>Body</label>--}}
{{--<p>--}}
	{{--{{ $topic->body }}--}}
{{--</p> <label>User_id</label>--}}
{{--<p>--}}
	{{--{{ $topic->user_id }}--}}
{{--</p> <label>Category_id</label>--}}
{{--<p>--}}
	{{--{{ $topic->category_id }}--}}
{{--</p> <label>Reply_count</label>--}}
{{--<p>--}}
	{{--{{ $topic->reply_count }}--}}
{{--</p> <label>View_count</label>--}}
{{--<p>--}}
	{{--{{ $topic->view_count }}--}}
{{--</p> <label>Last_reply_user_id</label>--}}
{{--<p>--}}
	{{--{{ $topic->last_reply_user_id }}--}}
{{--</p> <label>Order</label>--}}
{{--<p>--}}
	{{--{{ $topic->order }}--}}
{{--</p> <label>Excerpt</label>--}}
{{--<p>--}}
	{{--{{ $topic->excerpt }}--}}
{{--</p> <label>Slug</label>--}}
{{--<p>--}}
	{{--{{ $topic->slug }}--}}
{{--</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

@endsection
