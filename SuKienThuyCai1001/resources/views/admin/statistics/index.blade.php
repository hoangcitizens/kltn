@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thống kê hệ thống</h1>
    </div>

    <!-- Filter Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.statistics.index') }}" method="GET" class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">Từ ngày</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                               value="{{ $startDate->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_date">Đến ngày</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                               value="{{ $endDate->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">Lọc</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="statisticsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="revenue-tab" data-bs-toggle="tab" href="#revenue" role="tab">
                <i class="fas fa-dollar-sign"></i> Doanh thu
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="equipment-tab" data-bs-toggle="tab" href="#equipment" role="tab">
                <i class="fas fa-tools"></i> Thiết bị
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="staff-tab" data-bs-toggle="tab" href="#staff" role="tab">
                <i class="fas fa-users"></i> Nhân sự
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="blog-tab" data-bs-toggle="tab" href="#blog" role="tab">
                <i class="fas fa-blog"></i> Blog
            </a>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="statisticsTabsContent">
        <!-- Revenue Tab -->
        <div class="tab-pane fade show active" id="revenue" role="tabpanel">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tổng doanh thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($totalRevenue) }} VNĐ
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Doanh thu thiết bị</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($equipmentRevenue) }} VNĐ
                                    </div>
                                    <div class="mt-2 text-muted">
                                        {{ $equipmentCount }} đơn hàng
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tools fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Doanh thu nhân sự</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($staffRevenue) }} VNĐ
                                    </div>
                                    <div class="mt-2 text-muted">
                                        {{ $staffCount }} đơn hàng
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Equipment Tab -->
        <div class="tab-pane fade" id="equipment" role="tabpanel">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tổng quan thiết bị</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Tổng số thiết bị</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ $totalEquipment }}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-tools fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Thiết bị có sẵn</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ $availableEquipment }}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thiết bị theo danh mục</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Danh mục</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->equipment_count }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thiết bị theo loại</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Loại thiết bị</th>
                                            <th>Tổng số</th>
                                            <th>Có sẵn</th>
                                            <th>Đang thuê</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($equipmentByType as $type)
                                        <tr>
                                            <td>{{ $type['equipment_type_name'] }}</td>
                                            <td>{{ $type['count'] }}</td>
                                            <td>{{ $type['available'] }}</td>
                                            <td>{{ $type['count'] - $type['available'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Tab -->
        <div class="tab-pane fade" id="staff" role="tabpanel">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tổng số đơn thuê</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalStaffRentals }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Đang chờ duyệt</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pendingStaffRentals }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Đã duyệt</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $approvedStaffRentals }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Đã từ chối</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $rejectedStaffRentals }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Đã hoàn thành</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $completedStaffRentals }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-double fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Tab -->
        <div class="tab-pane fade" id="blog" role="tabpanel">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Tổng số bài viết</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalBlogs }} bài
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-blog fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Bài viết mới</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $recentBlogs }} bài
                                    </div>
                                    <div class="mt-2 text-muted">
                                        Từ {{ $startDate->format('d/m/Y') }} đến {{ $endDate->format('d/m/Y') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#statisticsTabs a'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (e) {
                e.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endpush
@endsection 