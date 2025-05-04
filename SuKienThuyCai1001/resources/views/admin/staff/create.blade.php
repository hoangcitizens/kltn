@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhân sự mới</h1>
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

            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tên danh mục nhân sự</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name') }}" required>
                </div>

                <!-- <div class="form-group">
                    <label for="category">Danh mục</label>
                    <input type="text" class="form-control" id="category" name="category" 
                           value="{{ old('category') }}" required>
                </div> -->

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" 
                           value="{{ old('quantity', 1) }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="price">Giá thuê</label>
                    <input type="number" class="form-control" id="price" name="price" 
                           value="{{ old('price') }}" min="0" required>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Thêm nhân sự</button>
            </form>
        </div>
    </div>
</div>
@endsection 