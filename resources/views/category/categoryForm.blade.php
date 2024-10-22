@extends('template.master')
@section('content')
<div class="container">
<div class="card m-5 p-5">
    <div class="card-title ">Category Form</div>
        <div class="card-body">
        @if(isset($category_data))
        <form method="POST" action="{{route('updateCategory')}}" class="row g-3 needs-validation" novalidate>
        @else
        <form method="POST" action="{{route('postCategory')}}" class="row g-3 needs-validation" novalidate>
        @endif
                @csrf
                <div class="">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($category_data->title) ? $category_data->title : '') }}" required>
                </div>
                <div class="">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" rows="5" name="description" required>{{ old('description', $category_data->description ?? '') }}</textarea>
                </div>
                <div class="col-12">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    @if(isset($category_data))
                    <input type="hidden" name="id" value="{{$category_data->id}}">
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
