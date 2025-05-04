@extends('layouts.admin')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết yêu cầu liên hệ</h6>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="font-weight-bold mb-3">Thông tin người gửi</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Họ và tên</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $contact->phone ?? 'Không có' }}</td>
                        </tr>
                        <tr>
                            <th>Ngày gửi</th>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="font-weight-bold mb-3">Hành động</h5>
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <a href="mailto:{{ $contact->email }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-envelope"></i> Phản hồi qua Email
                                </a>
                            </div>
                            @if($contact->phone)
                            <div class="mb-3">
                                <a href="tel:{{ $contact->phone }}" class="btn btn-success btn-block">
                                    <i class="fas fa-phone"></i> Gọi điện thoại
                                </a>
                            </div>
                            @endif
                            <div>
                                <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#deleteContactModal">
                                    <i class="fas fa-trash"></i> Xóa yêu cầu này
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-left-info shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Nội dung tin nhắn</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-light rounded">
                                <p style="white-space: pre-line;">{{ $contact->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteContactModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa yêu cầu liên hệ này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="{{ route('admin.contacts.destroy', $contact->request_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 