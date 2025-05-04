@if(session('user'))
    <div class="dropdown">
        <button class="btn btn-link dropdown-toggle text-white" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ session('user')->username }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Thông tin tài khoản</a></li>
            <li><a class="dropdown-item" href="{{ route('user.bookings') }}">Lịch sử đặt hàng</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>
@else
    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Đăng nhập</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
@endif 