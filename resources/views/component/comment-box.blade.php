<div class="comment-box" id="comment">
    @if ($errors->any())
        <div class="error-info">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <form action="{{route('comment.submit')}}" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="commentable_type" value="App\{{$model}}">
        <input type="hidden" name="commentable_id" value="{{$data->id}}">
        <div class="row">
            <div class="input-field col s12 m6 l4 colNotChange">
                <input name="username" id="username" type="text" required minlength="1" maxlength="8"
                       value="{{Cookie::get('userName')}}">
                <label for="username">姓名 *</label>
            </div>
            <div class="input-field col s12 m6 l4 colNotChange">
                <input name="email" id="email" type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"
                       value="{{Cookie::get('userEmail')}}">
                <label for="email">邮箱 *</label>
            </div>
            <div class="input-field col s12 m6 l4 colNotChange">
                <input name="site" id="site" type="url" value="{{Cookie::get('userSite')}}">
                <label for="site">网站</label>
            </div>
            <div class="col s12 colNotChange">
                            <textarea required placeholder="Say something ..." name="Content" id="content"
                                      maxlength="500" minlength="6" autocomplete="off"></textarea>
            </div>
            <div class="col s12 colNotChange">
                <div class="comment-captcha">
                    {!! Geetest::render('popup') !!}
                </div>
                <button class="waves-effect waves-indigo indigo white-text btn-flat" type="submit">
                    提交
                </button>
            </div>
        </div>
    </form>
    <div class="comment-list">
        <div class="comment-tip">
            @if(count($data->comments)>0)
                共有 {{count($data->comments)}} 条回忆
            @else
                欢迎留下你的看法或共同回忆，留言板始于2018年05月20日。
            @endif
        </div>
        @foreach($data->comments as $comment)
            <div class="comment-item">
                <div class="comment-avatar">
                    <a href="{{$comment->site or '#'}}" target="_blank" rel="nofollow">
                        <img src="{{getEmailAvatar($comment->email)}}"
                             alt="{{$comment->username}}的Gavatar头像">
                    </a>
                </div>
                <div class="comment-main">
                    <div class="comment-username">
                        <a href="{{$comment->site or '#'}}" target="_blank"
                           rel="nofollow">{{$comment->username}}</a>
                    </div>
                    <div class="comment-content">
                        {{$comment->content}}
                    </div>
                    <div class="comment-time">
                        {{$comment->created_at}} · {{$comment->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>