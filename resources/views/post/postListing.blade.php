@extends('template.master')
@section('content')
<div class="container">
    <div class="card m-5 p-5">
        <div class="card-header">
        <h4 class="card-title">Post Listing</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table
            id="basic-datatables"
            class="display table table-striped table-hover"
            >
            <thead>
                <tr>
                    <th>Img</th>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Updated Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        <img src="{{ URL::asset($post->image) }}" alt="Post Image" style="width:100px; height:auto;">
                    </td>
                    <td><span class="badge badge-primary p-2">{{ $post->formatted_id }}</span></td>
                    <td>{{ $post->category->title}}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <div class="form-button-action">
                            <a href="{{ URL::to('admin-backend/post-form/edit/' . $post->id) }}" class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ URL::to('admin-backend/post-form/delete/' . $post->id) }}" class="btn btn-link btn-danger btn-lg">
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
