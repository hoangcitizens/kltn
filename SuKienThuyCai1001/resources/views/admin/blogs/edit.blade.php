@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<div class="container">
    <h1>Edit Blog</h1>
    
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Excerpt</label>
            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ $blog->excerpt }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Featured Image</label>
            @if($blog->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current image" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control ckeditor" id="content" name="content" rows="10" required>{{ $blog->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>
@endsection 