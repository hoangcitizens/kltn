@extends('Sukien.layouts.noidung')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h4>{{ $user->username }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="text-muted">{{ $user->phone ?? 'Chưa cập nhật số điện thoại' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update-profile') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




