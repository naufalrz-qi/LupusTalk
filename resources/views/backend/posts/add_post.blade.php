@extends(Auth::user()->role === 'admin'? 'admin.dashboard' : 'user.dashboard')
@section('content')
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Post</h6>

                        <form class="forms-sample" method="POST" action="{{ route('store.post') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                <select class="js-example-basic-single form-select" name="cat_id" data-width="100%">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleInputName" autocomplete="off" name="post_title" />
                                @error('post_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Content</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" name="post_content"></textarea>
                                @error('post_content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Topics</label>
                                <select class="js-example-basic-multiple form-select" name="topics[]" multiple="multiple" data-width="100%">
                                    @foreach ($topics as $item)
                                        <option value="{{ $item->id }}">{{ $item->topic_name }}</option>
                                    @endforeach
                                </select>
                                @error('topics')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image" autocomplete="off" name="post_photo" />
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"></label>
                                <img id="showImage" class="wd-200 rounded mb-4"
                                    src="{{ url('upload/no_image.jpg') }}"
                                    alt="photopost">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">
                                Save Changes
                            </button>

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
