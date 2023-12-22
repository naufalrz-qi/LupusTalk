@extends(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard')
@section('head')
    <style>
        .post-image {
            max-width: 100%;
            max-height: 300px;
            width: 100%;
            height: 250px;
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
                    @foreach ($posts as $post)
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
                                                        href="{{ route('delete.post', $post->id) }}"><i
                                                            data-feather="trash-2" class="icon-sm me-2"></i> <span
                                                            class="">Delete
                                                            Post</span></a>
                                                @endif

                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('detail.post', $post->id) }}"><i
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
                                    <small><a href="#">{{ $post->topic->topic_name }}</a></small>
                                    <h2>{{ $post->post_title }}</h2>
                                    <p class="mb-3 tx-14">{{ $post->post_content }}</p>
                                    @if (!empty($post->post_photo))
                                        <img class="img-fluid post-image"
                                            src="{{ url('upload/posts/' . $post->post_photo) }}" alt="">
                                    @endif
                                    <div class="mt-3">
                                        @foreach ($post->categories as $category)
                                            <a class="btn btn-inverse-primary"> {{ $category->cat_name }}</a>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="d-flex post-actions">
                                        <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                                            <i class="icon-md" data-feather="heart"></i>
                                            <p class="d-none d-md-block ms-2">Like</p>
                                        </a>




                                        <a class="d-flex align-items-center text-muted me-4 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#answer_{{ $post->id }}"
                                            aria-expanded="false" aria-controls="answer_{{ $post->id }}">
                                            <i class="icon-md" data-feather="message-square"></i>
                                            <p class="d-none d-md-block ms-2">Comment</p>
                                        </a>


                                        <a href="javascript:;" class="d-flex align-items-center text-muted">
                                            <i class="icon-md" data-feather="share"></i>
                                            <p class="d-none d-md-block ms-2">Share</p>
                                        </a>
                                    </div>
                                </div>

                                <div id="answer_{{ $post->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="accordion-body">

                                            <form class="forms-sample" method="POST"
                                                action="{{ route('store.answer', $post->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Your
                                                        answer</label>
                                                    <textarea type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" name="answer_content"
                                                        placeholder="Your answer"></textarea>
                                                    @error('answer_content')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @error('answer_photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @error('post_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @error('answer_by')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <div class="mb-3">
                                                        <label for="image_{{ $post->id }}" class="form-label"><span
                                                                class="btn btn-info">Add Photo</span></label>
                                                        <button type="submit"
                                                            class="btn btn-primary text-dark">Send</button>

                                                        <input type="file" class="form-control"
                                                            id="image_{{ $post->id }}" autocomplete="off"
                                                            name="answer_photo" style="display: none;" />
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <img id="showImage_{{ $post->id }}" class="wd-100 rounded mb-4"
                                                        src="{{ url('upload/no_image.jpg') }}" alt="profile">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded">
                                    @foreach ($answers as $answer)
                                        @if ($answer->post->id === $post->id)
                                            <div class="card-header p-0">

                                                <div class="my-2 tx-14 text-center text-secondary">
                                                    <p>Answer Section</p>
                                                </div>


                                            </div>
                                        @break
                                    @endif
                                @endforeach
                                @foreach ($answers as $answer)
                                    @if (!empty($answer->post_id))
                                        @if ($answer->post->id === $post->id)
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        @if ($answer->user->role === 'user')
                                                            <img class="img-xs rounded-circle"
                                                                src="{{ !empty($answer->user->photo) ? url('upload/user_images/' . $answer->user->photo) : url('upload/no_image.jpg') }}"
                                                                alt="">
                                                        @elseif($answer->user->role === 'admin')
                                                            <img class="img-xs rounded-circle"
                                                                src="{{ !empty($answer->user->photo) ? url('upload/admin_images/' . $answer->user->photo) : url('upload/no_image.jpg') }}"
                                                                alt="">
                                                        @endif

                                                        <div class="ms-2">
                                                            <p>{{ $answer->user->name }}</p>
                                                            <p class="tx-11 text-muted">
                                                                {{ $answer->created_at->format('Y-m-d H:i:s') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a type="button" id="dropdownMenuButton2"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="icon-lg pb-3px"
                                                                data-feather="more-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton2">
                                                            @if ($answer->answer_by === Auth::user()->id)
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                    href="#"><i data-feather="edit-2"
                                                                        class="icon-sm me-2"></i> <span
                                                                        class="">Edit
                                                                        Post</span></a>
                                                                <a id="delete"
                                                                    class="dropdown-item d-flex align-items-center"
                                                                    href="#"><i data-feather="trash-2"
                                                                        class="icon-sm me-2"></i> <span
                                                                        class="">Delete
                                                                        Post</span></a>
                                                            @endif

                                                            <a class="dropdown-item d-flex align-items-center"
                                                                href="#"><i data-feather="corner-right-up"
                                                                    class="icon-sm me-2"></i> <span class="">Go
                                                                    to
                                                                    post</span></a>
                                                            <a class="dropdown-item d-flex align-items-center"
                                                                href="javascript:;"><i data-feather="share-2"
                                                                    class="icon-sm me-2"></i> <span
                                                                    class="">Share</span></a>
                                                            <a class="dropdown-item d-flex align-items-center"
                                                                href="javascript:;"><i data-feather="copy"
                                                                    class="icon-sm me-2"></i> <span
                                                                    class="">Copy
                                                                    link</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-4 mb-3 tx-14">{{ $answer->answer_content }}</p>
                                                @if (!empty($answer->answer_photo))
                                                    <img class="img-fluid post-image wd-100"
                                                        src="{{ url('upload/answers/' . $answer->answer_photo) }}"
                                                        alt="">
                                                @endif
                                            </div>
                                            <hr>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach ($answers as $answer)
                                    @if ($answer->post->id === $post->id)
                                        <div class="card-footer">
                                            <a class="my-2 tx-14 text-center text-secondary"
                                                href="{{ route('detail.post', $post->id) }}">See more
                                                answer</a>
                                        </div>
                                    @break
                                @endif
                            @endforeach

                        </div>





                    </div>


                </div>
            @endforeach
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

        image_input();
    });

    function image_input() {
        @foreach ($posts as $post)
            console.log({{ $post->id }});


            $('#image_{{ $post->id }}').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage_{{ $post->id }}').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        @endforeach
    };
</script>
@endsection
