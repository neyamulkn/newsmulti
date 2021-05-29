<li id="singleComment{{ $comment->id }}" style="background: #f7f7f7">
    <div class="comment-box">
        <a href="{{route('user_profile', [$comment->user->username])}}">
        <img alt="" src="{{ asset('upload/images/users/thumb_image/'.$comment->user->photo) }}"></a>
        <div class="comment-content">
            <h4><a style="float: left;border:none;" href="{{route('user_profile', [$comment->user->username])}}">{{$comment->user->name}}</a> <a @guest class="log-in-popup" href="#log-in-popup" @else onclick="reply_field('{{$comment->id}}')"  @endguest style="cursor: pointer;" ><i class="fa fa-comment-o"></i>Reply</a></h4>
            <span><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
            <p id="comment{{$comment->id}}">{{$comment->comments}}</p>
            @if(Auth::check())
                @if($comment->user_id == Auth::user()->id)
                    <a onclick="comment_edit('{{$comment->id}}')" class="comment-control">Edit</a> 
                    <a onclick="commentDelete('{{$comment->id}}')" class="comment-control">Delete</a>
                    
                @endif
                <a class="comment-control" onclick="reply_field('{{$comment->id}}', 'reply_form')" >Reply</a>
                <!-- comment_edit form-->
                <form method="get" action="{{route('comment_insert')}}" id="update_comment{{$comment->id}}" class="comment-reply-form">
                    <input type="hidden" value="{{$comment->id}}" name="id">
                     <input type="hidden" name="news_id" value="{{ $comment->news_id }}">
                    <div id="comment_edit{{$comment->id}}"></div>
                </form>
            @endif
        </div>

    <form method="post" style="padding-top: 10px;" action="{{route('comment_reply', $comment->id)}}" id="reply_form{{$comment->id}}" class="comment-reply-form">
    
    </form>


    </div>

</li>