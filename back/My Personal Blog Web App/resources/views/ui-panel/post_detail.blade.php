@extends('ui-panel.layouts.master')

@section('title', 'Mr.Min Personal Blog')
@section('content')
    <!-- Post Detail Section -->
    <section id="post-detail" class="bg-white">
        <div class="container">
            <div class="row">
                <input type="hidden" id="postId" value="{{ $post->id }}">
                <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                <div class="col-12 p-md-5 p-2 mt-3 mt-md-0 position-relative">
                    <img src="{{ asset("storage/post_images/$post->image") }}" alt="image"
                        class="img-fluid w-100 p-md-5">
                    <h1 class="display-md-3 text-uppercase text-white position-absolute top-50 start-50 translate-middle">
                        {{ $post->title }}</h1>
                </div>
                <div class="col-12">
                    <h1 class="display-6 text-uppercase text-center">{{ $post->title }}</h1>
                    <h6 class="text-muted text-center">{{ $post->category->name }} -
                        {{ $post->created_at->format('d-M-Y') }}</h6>
                    <p style="text-align: justify">{{ $post->content }}</p>
                    <div>
                        <span class="me-3" id="likeCount">{{ $likes->count() }} Likes</span>
                        <span id="dislikeCount">{{ $dislikes->count() }} Dislikes</span>
                    </div>
                    <div class="mb-4">
                        <button class="btn btn-primary mt-1" id="likeBtn"
                            @isset($isUser) @if ($isUser->type == 'like') disabled @endif @endisset><i
                                class="fa-solid fa-heart me-1"></i>Like</button>
                        <button class="btn btn-danger mt-1" id="dislikeBtn"
                            @isset($isUser) @if ($isUser->type == 'dislike') disabled @endif @endisset><i
                                class="fa-solid fa-heart-crack me-1"></i>Dislike</button>
                        <button data-bs-toggle="collapse" data-bs-target="#collapseItem"
                            class="btn btn-secondary text-white mt-1"><i class="fa-solid fa-comment me-1"></i>Comments<span
                                class="badge bg-dark ms-1">{{ $post->comments->count() }}</span></button>
                    </div>
                    @if (session('successMsg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successMsg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="collapse" id="collapseItem">
                        <!-- Comment Form -->
                        <div class="col-md-6">
                            <form name="commentForm">
                                <input type="hidden" id="postId" value="{{ $post->id }}">
                                <textarea id="text" placeholder="Your Comment..." rows="5" class="form-control" required></textarea>
                                <button type="submit" class="btn btn-primary my-3">Submit</button>
                            </form>
                        </div>
                        <!-- Comments -->
                        <div id="showComments" class="col-md-6">
                            @foreach ($post->comments as $comment)
                                @if ($comment->status == 'show')
                                    @if ($comment->user->image == null)
                                        <img src="{{ asset('images/default.png') }}" alt="personal image"
                                            class="rounded-circle img-fluid object-fit-cover"
                                            style="width:50px;height:50px">
                                    @else
                                        <img src="{{ asset('storage/images/' . $comment->user->image) }}"
                                            alt="personal image" class="rounded-circle border img-fluid object-fit-cover"
                                            style="width:50px;height:50px">
                                    @endif
                                    <strong class="ms-1 fs-5">{{ $comment->user->name }}</strong> | <span
                                        class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                    <p class="border border-danger bg-secondary text-white p-2 mt-3 mb-5 rounded-pill">
                                        {{ $comment->text }}
                                    </p>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function select() {
                $postId = $('#postId').val();
                $userId = $('#userId').val();

                likeCountSpan = $('#likeCount');
                dislikeCountSpan = $('#dislikeCount');
                likeCount = likeCountSpan.text().replace('Likes', '');
                dislikeCount = dislikeCountSpan.text().replace('Dislikes', '');
            }
            $('#likeBtn').click(function() {
                select();
                $.ajax({
                    type: "get",
                    url: "http://localhost:8000/users/ajax/like",
                    data: {
                        'post_id': $postId,
                        'user_id': $userId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'like success') {
                            likeCount++;
                            likeCountSpan.text(likeCount + ' ' + 'Likes');
                            if (dislikeCount != 0) {
                                dislikeCount = parseInt(dislikeCount) - 1;
                                dislikeCountSpan.text(dislikeCount + ' ' + 'Dislikes');
                            }
                            $('#likeBtn').attr('disabled', 'disabled');
                        } else {
                            likeCount++;
                            likeCountSpan.text(likeCount + ' ' + 'Likes');
                            if (dislikeCount != 0) {
                                dislikeCount = parseInt(dislikeCount) - 1;
                                dislikeCountSpan.text(dislikeCount + ' ' + 'Dislikes');
                            }
                            $('#likeBtn').attr('disabled', 'disabled');
                            $('#dislikeBtn').removeAttr('disabled');
                        }
                    }
                });
            })

            $('#dislikeBtn').click(function() {
                select();
                $.ajax({
                    type: "get",
                    url: "http://localhost:8000/users/ajax/dislike",
                    data: {
                        'post_id': $postId,
                        'user_id': $userId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'dislike success') {
                            dislikeCount++;
                            dislikeCountSpan.text(dislikeCount + ' ' + 'Dislikes');
                            if (likeCount != 0) {
                                likeCount = Number(likeCount) - 1;
                                likeCountSpan.text(likeCount + ' ' + 'Likes');
                            }
                            $('#dislikeBtn').attr('disabled', 'disabled');
                        } else {
                            dislikeCount++;
                            dislikeCountSpan.text(dislikeCount + ' ' + 'Dislikes');
                            if (likeCount != 0) {
                                likeCount = Number(likeCount) - 1;
                                likeCountSpan.text(likeCount + ' ' + 'Likes');
                            }
                            $('#dislikeBtn').attr('disabled', 'disabled');
                            $('#likeBtn').removeAttr('disabled');
                        }
                    }
                });
            })

            // Create Comments
            let commentForm = document.forms['commentForm'];
            commentForm.onsubmit = function(event) {
                event.preventDefault();
                let postId = $('#postId').val();
                let text = $('#text').val();

                $.ajax({
                    type: "get",
                    url: "/users/ajax/comment",
                    data: {
                        'post_id': postId,
                        'text': text
                    },
                    dataType: "json",
                    success: function(response) {
                        const dbDate = new Date(`${response.comment.created_at}`);
                        // Calculate the time difference between the current time and the database time
                        const diff = new Date() - dbDate;
                        // Convert the time difference to minutes
                        const diffMinutes = Math.floor(diff / 1000 / 60);
                        $('#showComments').append(`
                            <strong class="ms-1 fs-5">${response.user.name}</strong> | <span class="text-muted">${diffMinutes} recently</span>
                            <p class="border border-danger bg-secondary text-white p-2 mt-3 mb-5 rounded-pill">
                                ${response.comment.text}
                            </p>
                        `);

                        commentForm.reset();
                    }
                });
            }
        })
    </script>
@endsection
