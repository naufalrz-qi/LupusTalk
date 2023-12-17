@extends('admin.dashboard')
@section('content')
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Category</h6>

                        <form class="forms-sample" method="POST" action="{{ route('store.category') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text"
                                    class="form-control
                                    @error('cat_name')
                                    is-invalid
                                    @enderror"
                                    name="cat_name" />
                                @error('cat_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categoryIcon" class="form-label">Category Icon</label>
                                <input type="text"
                                    class="form-control
                                    @error('cat_icon')
                                    is-invalid
                                    @enderror"
                                    name="cat_icon" />
                                @error('cat_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Description</label>
                                <textarea type="text"
                                    class="form-control"
                                    name="cat_description" ></textarea>
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
@endsection
