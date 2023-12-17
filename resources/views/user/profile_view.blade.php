@extends('user.dashboard')
@section('content')
    <div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-5 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div>
                            <img class="wd-100 rounded-circle mb-4"
                                src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                alt="profile">
                            <span class="h4 ms-3 text-light">{{ $profileData->username }}</span>
                        </div>
                        <p>{{ $profileData->bio }}</p>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">{{ $profileData->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profileData->email }}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-7 col-xl-8 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Admin Profile</h6>

                        <form class="forms-sample" method="POST" action="{{ route('admin.profile.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off"
                                    name="username" placeholder="Username" value="{{ $profileData->username }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleInputName" autocomplete="off"
                                    placeholder="Name" name="name" value="{{ $profileData->name }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"
                                    name="email" value="{{ $profileData->email }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Bio</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" name="bio"
                                    value="{{ $profileData->bio }}" placeholder="Bio"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image" autocomplete="off" name="photo"
                                    value="{{ $profileData->photo }}" />
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"></label>
                                <img id="showImage" class="wd-100 rounded-circle mb-4"
                                    src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                    alt="profile">
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
