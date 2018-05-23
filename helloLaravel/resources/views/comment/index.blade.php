@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">管理评论</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Content</th>
                                    <th>User</th>
                                    <th>Page</th>
                                    <th>查看</th>
                                    <th>编辑</th>
                                    <th>删除</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <th>{{$comment->content}}</th>
                                    <th>
                                        {{$comment->nickname}}<br>
                                        {{$comment->email}}
                                    </th>
                                    <th><a href="{{"//" . $comment->website}}">{{$comment->website}}</a></th>
                                    <th><a href="{{url("article/". $comment->article_id)}}">{{$comment->title}}</a></th>
                                    <th><a href="{{url('comment/' . $comment->id . '/edit' )}}" class="btn btn-success">编辑</a></th>
                                    <th>
                                        <form action="{{url('comment/' . $comment->id)}}">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{$comments->links()}}
                        {{--@foreach ($articles as $article)--}}
                            {{--<hr>--}}
                            {{--<div class="article">--}}
                                {{--<h4>{{ $article->title }}</h4>--}}
                                {{--<div class="content">--}}
                                    {{--<p>--}}
                                        {{--{{ $article->body }}--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a href="{{ url('admin/articles/'.$article->id.'/edit') }}" class="btn btn-success">编辑</a>--}}
                            {{--<a href="{{ url('article/'. $article->id ) }}" class="btn btn-dark">查看</a>--}}
                            {{--<form action="{{ url('admin/articles/'.$article->id) }}" method="POST" style="display: inline;">--}}
                                {{--这里laravel的请求处理会要求所有非get或post的请求 都由post处理--}}
                                {{--等同于<input type="hidden" name="_method" value="DELETE">--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button type="submit" class="btn btn-danger">删除</button>--}}
                            {{--</form>--}}
                        {{--@endforeach--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection