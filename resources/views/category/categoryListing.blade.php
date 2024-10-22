@extends('template.master')
@section('content')
<div class="container">
    <div class="card m-5 p-5">
        <div class="card-header">
        <h4 class="card-title">Category Listing</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table
            id="basic-datatables"
            class="display table table-striped table-hover"
            >
            <thead>
                <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Updated Time</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <div class="form-button-action">
                            <a href="{{ URL::to('admin-backend/category-form/edit/' . $category->id) }}" class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ URL::to('admin-backend/category-form/delete/' . $category->id) }}" class="btn btn-link btn-danger btn-lg">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection
