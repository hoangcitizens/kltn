@extends('layouts.admin')

@section('title', 'Quản lý thiết bị')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý thiết bị</h1>
        <a href="{{ route('admin.equipment.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên thiết bị</th>
                            <th>Danh mục</th>
                            <th>Loại thiết bị</th>
                            <th>Giá thuê</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipment as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                             class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @foreach($item->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $item->equipmentType->equipment_type_name }}</td>
                                <td>{{ number_format($item->price) }} VNĐ</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    @switch($item->status)
                                        @case('available')
                                            <span class="badge bg-success">Có sẵn</span>
                                            @break
                                        @case('rented')
                                            <span class="badge bg-warning">Đang cho thuê</span>
                                            @break
                                        @case('maintenance')
                                            <span class="badge bg-danger">Đang bảo trì</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.equipment.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.equipment.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $equipment->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 