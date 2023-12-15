@extends('admin.dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Data Categories</li>
            </ol>
            <ol class="breadcrumb">
                <a class="btn btn-inverse-info" href="{{ route('add.category') }}">Add Category</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Categories</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Category Icon</th>
                                        <th>Category Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->cat_name }}</td>
                                            <td>{{ $item->cat_icon }}</td>
                                            <td>{{ $item->cat_description }}</td>
                                            <td><a class="btn btn-inverse-warning" href="{{ route('edit.category', $item->id) }}">Edit</a>
                                                <a class="btn btn-inverse-danger" id="delete" href="{{ route('delete.category', $item->id) }}">Delete</a></td>


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
