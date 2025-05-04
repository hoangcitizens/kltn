@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa nhân sự</h1>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Tên nhân sự</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $staff->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="category">Danh mục</label>
                    <input type="text" class="form-control" id="category" name="category" 
                           value="{{ old('category', $staff->category) }}" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" 
                           value="{{ old('quantity', $staff->quantity) }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="price">Giá thuê</label>
                    <input type="number" class="form-control" id="price" name="price" 
                           value="{{ old('price', $staff->price) }}" min="0" required>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    @if($staff->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $staff->image) }}" 
                                 alt="{{ $staff->name }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3">{{ old('description', $staff->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection 