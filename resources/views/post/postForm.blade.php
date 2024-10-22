@extends('template.master')
@section('content')
<div class="container">
<div class="card m-5 p-5">
    <div class="card-title ">Post Form</div>
        <div class="card-body">
        @if(isset($post_data))
        <form method="POST" action="{{route('postUpdate')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
        @else
        <form method="POST" action="{{route('postPost')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
        @endif
                @csrf
                <div class="img-preview card-body">
                    <label for="input-file" id="drop-area">
                        <input type="file" accept="image/*" id="input-file" name="image" hidden required />
                        <div id="img-view">
                            @if(isset($post_data))
                                <img src="{{ URL::asset($post_data->image) }}" alt="" style="width:100%; height:236px;border-radius:15px;padding:2px;" >
                            @else
                                <img src="{{ URL::asset('template/roomDefault.png') }}" alt="" >
                                <p>Drag and Draw or Click here to Upload Image.</p>
                            @endif
                        </div>
                        <div class="invalid-feedback">
                            Please Upload Image.
                        </div>
                    </label>
                </div>
                <div class="">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($post_data->title) ? $post_data->title : '') }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-select" id="category" name="category_id" required>
                        <option value="">- Choose Category -</option>
                        @if($categories)
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"
                        {{ $category->id == old('category_id', $selectedCategoryId ?? '') ? 'selected' : '' }}>{{$category->id}}-{{$category->title}}</option>
                        @endforeach
                        @else
                            <option value="">Category Data Empty</option>
                        @endif
                    </select>
                </div>
                <div class="">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="2" name="description" required>{{ old('description', isset($post_data->description) ? $post_data->description : '') }}</textarea>
                </div>
                <div class="">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" rows="8" name="content" required>{{ old('content', isset($post_data->content) ? $post_data->content : '') }}</textarea>
                </div>
                <div class="col-12">
                </div>
                <div class="col-12">
                    @if(isset($post_data))
                        <input type="hidden" name="id" value="{{$post_data->id}}">
                    @endif
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
