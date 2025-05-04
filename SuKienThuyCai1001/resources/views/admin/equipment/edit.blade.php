@extends('layouts.admin')

@section('title', 'Chỉnh sửa thiết bị')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa thiết bị</h1>
        <a href="{{ route('admin.equipment.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.equipment.update', $equipment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên thiết bị</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $equipment->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Danh mục</label>
                            <select class="form-select select2 @error('categories') is-invalid @enderror" 
                                    id="categories" name="categories[]" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ in_array($category->id, old('categories', $equipment->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="equipment_type_id" class="form-label">Loại thiết bị</label>
                            <select class="form-select select2 @error('equipment_type_id') is-invalid @enderror" 
                                    id="equipment_type_id" name="equipment_type_id" required>
                                <option value="">Chọn loại thiết bị</option>
                                @foreach($equipmentTypes as $type)
                                    <option value="{{ $type->id }}" 
                                            {{ old('equipment_type_id', $equipment->equipment_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->equipment_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('equipment_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Giá thuê (VNĐ)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $equipment->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" value="{{ old('quantity', $equipment->quantity) }}" required min="1">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="available" {{ old('status', $equipment->status) == 'available' ? 'selected' : '' }}>
                                    Có sẵn
                                </option>
                                <option value="rented" {{ old('status', $equipment->status) == 'rented' ? 'selected' : '' }}>
                                    Đang cho thuê
                                </option>
                                <option value="maintenance" {{ old('status', $equipment->status) == 'maintenance' ? 'selected' : '' }}>
                                    Đang bảo trì
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description">{{ old('description', $equipment->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            @if($equipment->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}" 
                                         class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Khởi tạo Select2 cho danh mục
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Chọn danh mục',
            allowClear: true
        });
    });

    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent'],
            language: 'vi'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection 