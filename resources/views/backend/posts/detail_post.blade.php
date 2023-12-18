@extends(Auth::user()->role === 'admin'? 'admin.dashboard' : 'user.dashboard')
@section('head')
    <style>
        .post-image {
            max-width: 100%;
            max-height: 400px;
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            /* Add pointer cursor to indicate clickability */
        }

        /* Add a class for the full-size view */
        .full-size-image {
            max-width: 100%;
            max-height: none;
            width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content')
<div class="page-content">

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        @if ($post->user->role === 'user')
                                            <img class="img-xs rounded-circle"
                                                src="{{ !empty($post->user->photo) ? url('upload/user_images/' . $post->user->photo) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        @elseif($post->user->role === 'admin')
                                            <img class="img-xs rounded-circle"
                                                src="{{ !empty($post->user->photo) ? url('upload/admin_images/' . $post->user->photo) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        @endif

                                        <div class="ms-2">
                                            <p>{{ $post->user->name }}</p>
                                            <p class="tx-11 text-muted">{{ $post->created_at->format('Y-m-d H:i:s') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            @if ($post->post_by === Auth::user()->id)
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('edit.post', $post->id) }}"><i data-feather="edit-2"
                                                        class="icon-sm me-2"></i> <span class="">Edit
                                                        Post</span></a>
                                                <a id="delete" class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('delete.post', $post->id) }}"><i data-feather="trash-2"
                                                        class="icon-sm me-2"></i> <span class="">Delete
                                                        Post</span></a>
                                            @endif

                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('detail.post', $post->id) }}"><i
                                                    data-feather="corner-right-up" class="icon-sm me-2"></i> <span
                                                    class="">Go to post</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="share-2" class="icon-sm me-2"></i> <span
                                                    class="">Share</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="copy" class="icon-sm me-2"></i> <span
                                                    class="">Copy link</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <small><a href="#">{{ $post->category->cat_name }}</a></small>
                                <h2>{{ $post->post_title }}</h2>
                                <p class="mb-3 tx-14">{{ $post->post_content }}</p>
                                @if (!empty($post->post_photo))
                                    <img class="img-fluid post-image"
                                        src="{{ url('upload/posts/' . $post->post_photo) }}"
                                        alt="">
                                @endif
                                <div class="mt-3">
                                    @foreach ($post->topics as $topic)
                                        <a class="btn btn-inverse-primary"> {{ $topic->topic_name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex post-actions">
                                    <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                                        <i class="icon-md" data-feather="heart"></i>
                                        <p class="d-none d-md-block ms-2">Like</p>
                                    </a>
                                    <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                                        <i class="icon-md" data-feather="message-square"></i>
                                        <p class="d-none d-md-block ms-2">Comment</p>
                                    </a>
                                    <a href="javascript:;" class="d-flex align-items-center text-muted">
                                        <i class="icon-md" data-feather="share"></i>
                                        <p class="d-none d-md-block ms-2">Share</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        <!-- middle wrapper end -->

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    $(document).ready(function() {
        $('.post-image').on('click', function() {
            $(this).toggleClass('full-size-image');
        });
    });
</script>
@endsection
