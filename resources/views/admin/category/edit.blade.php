@extends('layouts.admin')

@section('content')

    <div class="card" style="margin-top: 2rem;">
        <div class="card-header">
            <h1>Edit/Update Category</h1>
        </div>
        <div class="card-body">
            <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" value="{{ $category->slug }}" name="slug" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" cols="3" class="form-control">{{ $category->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $category->status == "1" ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" {{ $category->popular == "1" ? 'checked':'' }} name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Mata Title</label>
                        <input type="text" value="{{ $category->meta_title }}" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" cols="3" class="form-control">{{ $category->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" cols="3" class="form-control">{{ $category->meta_descript }}</textarea>
                    </div>
                    @if($category->image)
                        <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Category Image">
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection