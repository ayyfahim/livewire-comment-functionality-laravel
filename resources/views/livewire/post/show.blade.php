<div class="wrapper light-wrapper">
    <div class="container inner pt-80">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="blog classic-view boxed">
                    <div class="post mb-0">
                        <div class="box bg-white shadow">
                            <figure class="main rounded">
                                <img src="{{ asset('uploads/post/main_image/'.$post->main_image) }}" alt="" />
                            </figure>
                            <div class="space40"></div>
                            <div class="post-content">
                                <h1 class="post-title text-center">{{$post->name}}</h1>
                                <div class="meta text-center">
                                    <span class="date">
                                        <i class="jam jam-clock"></i>{{$post->created_at->format('d M Y')}}
                                    </span>
                                    <span class="author">
                                        <i class="jam jam-user"></i>
                                        <a href="#">By {{ $post->author->name }}</a>
                                    </span>
                                    <span class="comments">
                                        <i class="jam jam-message-alt">
                                        </i>
                                        <a href="#">{{ $all_comments_count }} Comments</a>
                                    </span>
                                </div>

                                {{-- Post Content --}}
                                {!! $post->content !!}

                                <div class="space10"></div>
                                <div class="d-lg-flex justify-content-between align-items-center meta-footer">
                                    <ul class="list-unstyled tag-list">
                                        @forelse ($post->categories as $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}"
                                                class="btn btn-s">{{$category->name}}</a>
                                        </li>
                                        @empty

                                        @endforelse
                                    </ul>
                                    <div class="space20 d-lg-none"></div>
                                    <div class="d-flex align-items-center">
                                        <p class="pr-20 mb-0"><strong>Share on:</strong></p>
                                        <ul class="social social-mute">
                                            <li><a href="#"><i class="jam jam-facebook"></i></a></li>
                                            <li><a href="#"><i class="jam jam-twitter"></i></a></li>
                                            <li><a href="#"><i class="jam jam-pinterest"></i></a></li>
                                        </ul>
                                        <!-- /.social -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.post-content -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.post -->
                    <div class="space50"></div>
                    <div class="box bg-white shadow">
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="rounded">
                                    <img alt="" src="{{ asset('images/topcruder_2.jpg') }}" />
                                </figure>
                            </div>
                            <!--/column -->
                            <div class="col-md-8">
                                <h4>About the Author</h4>
                                <p class="mb-10">{{ env('APP_DESC') }}</p>
                                <ul class="social">
                                    <li>
                                        <a href="https://www.twitter.com/topcruder">
                                            <i class="jam jam-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/topcruder">
                                            <i class="jam jam-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.pinterest.com/topcruder">
                                            <i class="jam jam-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.vimeo.com/topcruder">
                                            <i class="jam jam-vimeo"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/topcruder">
                                            <i class="jam jam-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.box -->
                    <div class="space50"></div>
                    <div class="box bg-white shadow">
                        <div id="comments">
                            <h3>{{ $all_comments_count }} Comments</h3>
                            @if ($all_comments_count > 0)
                            <ol id="singlecomments" class="commentlist">
                                @foreach ($comments as $comment)
                                <li>
                                    @include('partials.comment_body', ['comment' => $comment])
                                    @include('partials.replies', ['comments' => $comment->replies])
                                </li>
                                @endforeach
                            </ol>
                            @endif
                        </div>
                        <!-- /#comments -->
                        <div class="{{( $all_comments_count > 0) ? 'space80' : 'space40'}}"></div>
                        <div id="comment-box">
                            <h3>Would you like to share your thoughts?</h3>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            @if ($replyingTo)
                            <p>
                                <a href="#" id="removeReply" class="badge badge-pill bg-purple"
                                    data-turbolinks="false">Replying to:
                                    {{ $replyingTo }} <i class="jam jam-close" wire:click="removeReply"></i>
                                </a>
                            </p>
                            @endif
                            <div class="space20"></div>
                            <form id="comment-form" class="comment-form" wire:submit.prevent="submit">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name*" name="name"
                                        wire:model="name">
                                    <div class="help-block with-errors">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email*" name="email"
                                        wire:model="email">
                                    <div class="help-block with-errors">
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Website" name="website"
                                        wire:model="website">
                                    <div class="help-block with-errors">
                                        @error('website')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="5"
                                        placeholder="Enter your comment here..." wire:model="comment"></textarea>
                                    <div class="help-block with-errors">
                                        @error('comment')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn">Submit</button>
                            </form>
                            <!-- /.comment-form -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.wrapper -->
<div class="wrapper gray-wrapper">
    <div class="container inner">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h3 class="mb-30">You Might Also Like</h3>
                <div class="grid-view">
                    <div class="carousel owl-carousel" data-margin="30" data-dots="true" data-autoplay="false"
                        data-autoplay-timeout="5000"
                        data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "3"}}'>
                        {{-- Recent Posts --}}
                        @foreach ($recentPosts as $post)
                        <div class="item">
                            <figure class="overlay overlay1 rounded mb-30">
                                <a href="{{ route('post.show', $post->slug) }}">
                                    <img src="{{ asset('uploads/post/thumbnail/'.$post->main_image) }}"
                                        alt="{{ $post->name }}" />
                                </a>
                                <figcaption>
                                    <h5 class="from-top mb-0">Read More</h5>
                                </figcaption>
                            </figure>
                            <div class="category">
                                @foreach ($post->categories as $category)
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="badge badge-pill bg-purple">{{ $category->name }}</a>
                                @endforeach
                            </div>
                            <h2 class="post-title">
                                <a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a>
                            </h2>
                            <div class="meta mb-0">
                                <span class="date">
                                    <i class="jam jam-clock"></i>{{$post->created_at->format('d M Y')}}</span>
                                <span class="comments">
                                    <i class="jam jam-message-alt"></i>
                                    <a href="{{ route('post.show', $post->slug) }}">{{ $post->all_comments_count }}
                                        Comments</a>
                                </span>
                            </div>
                        </div>
                        <!-- /.item -->
                        @endforeach
                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!-- /.grid-view -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.wrapper -->

@section('script')
{{-- 
<script>
    $(document).ready(function () {
        var form = document.getElementById('comment-form');

        function addInput(value) {
            $('#reply_field').remove();
            var input = document.createElement("input");
            input.type = 'hidden';
            input.name = 'reply';
            input.value = value;
            input.id = "reply_field";
            form.appendChild(input);
        };
        $(document).on('click', '#reply', function (event) {
            event.preventDefault();
            addInput(this.dataset['comment']);
            $('html, body').animate({
                scrollTop: $("#comment-box").offset().top + (-80)
            }, 500);
        })
    });
</script> 
--}}
<script>
    $(document).ready(function () {
        $(document).on('click', '#reply', function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: $("#comment-box").offset().top + (-80)
            }, 500);
        })
        $(document).on('click', '#removeReply', function (event) {
            event.preventDefault();
        })
    });
</script>
@endsection