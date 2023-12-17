@extends('admin.dashboard')
@section('content')
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Topic</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.topic') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $topic->id }}">
                            <div class="mb-3">
                                <label for="topicName" class="form-label">Topic Name</label>
                                <input type="text" value="{{ $topic->topic_name }}"
                                    class="form-control
                                    @error('topic_name')
                                    is-invalid
                                    @enderror"
                                    name="topic_name" />
                                @error('topic_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="topicDescription" class="form-label">Description</label>
                                <textarea type="text"
                                    class="form-control"
                                    name="topic_description" >{{ $topic->topic_description }}</textarea>
                            </div>



                            <button type="submit" class="btn btn-primary me-2">
                                Edit Data
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
