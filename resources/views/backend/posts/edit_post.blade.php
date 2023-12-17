@extends(Auth::user()->role === 'admin'? 'admin.dashboard' : 'user.dashboard')
@section('content')
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Post</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.post') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                <select name="cat_id" class="js-example-basic-single form-select" data-width="100%">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $post->cat_id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleInputName" autocomplete="off"
                                    name="post_title" value="{{ $post->post_title }}" />
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Content</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" name="post_content">{{ $post->post_content }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Topics</label>
                                <select name="topics[]" class="js-example-basic-multiple form-select" multiple="multiple"
                                    data-width="100%">
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                            {{ in_array($topic->id, $post->topics->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $topic->topic_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image" autocomplete="off" name="post_photo" value="{{ $post->post_photo }}" />
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"></label>
                                <img id="showImage" class="wd-200 rounded mb-4"
                                    src="{{ !empty($post->post_photo) ? url('upload/admin_images/posts/' . $post->post_photo) : url('upload/no_image.jpg') }}"
                                    alt="photopost">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
