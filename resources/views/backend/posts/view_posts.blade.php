@extends('admin.dashboard')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Data Posts</li>
            </ol>
            <ol class="breadcrumb">
                <a class="btn btn-inverse-info" href="{{ route('add.post') }}">Add Post</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Posts</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categories</th>
                                        <th>Topic</th>
                                        <th>Title</th>
                                        <th>Post By</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>

                                                @foreach ($item->categories as $category)
                                                    <a class="btn btn-inverse-primary"> {{ $category->cat_name }}</a>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->topic->topic_name }}</td>
                                            <td>{{ $item->post_title }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->created_at }}</td>

                                            <td>
                                                <a class="btn btn-inverse-info" href="{{ route('detail.post', $item->id) }}">Preview</a>
                                                <a class="btn btn-inverse-warning"
                                                    href="{{ route('edit.post', $item->id) }}">Edit</a>
                                                <a class="btn btn-inverse-danger" id="delete"
                                                    href="{{ route('delete.post', $item->id) }}">Delete</a>
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
