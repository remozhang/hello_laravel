@include('common.error')
<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea name="content" id="" class="form-control" placeholder="分享你的想法" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-share"></i>回复</button>
    </form>
</div>
<hr>