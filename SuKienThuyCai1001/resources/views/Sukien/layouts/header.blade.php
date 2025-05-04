@php
    $equipmentTypes = App\Models\EquipmentType::all();
@endphp

<div class="menu px-sm-5 py-sm-3">
    <div class="banner_container">
        <div>
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="menu_container d-xl-block d-lg-block d-none">
                        <ul class="d-flex justify-content-between align-items-center m-0">
                            <li class="">
                                <a href="{{ route('trangchu.show') }}" class="home">
                                    <img loading="lazy" src="https://cdn-icons-png.flaticon.com/128/1946/1946436.png" alt=""> 
                                </a>
                            </li>
                            <li class="dropdown btn">
                                <a class="dropdown-toggle" href="#" role="button" aria-expanded="false">DỊCH VỤ</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'tiec-cuoi') }}">TIỆC CƯỚI</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'su-kien-le-hoi') }}">SỰ KIỆN LỄ HỘI</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'le-khai-truong') }}">LỄ KHAI TRƯƠNG</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'le-ra-mat-san-pham') }}">LỄ RA MẮT SẢN PHẨM</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'teambuilding') }}">TEAMBUILDING</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'su-kien-tri-an-khach-hang') }}">SỰ KIỆN TRI ÂN KHÁCH HÀNG</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('blog.category', 'trang-tri-decor-tieu-canh') }}">TRANG TRÍ DECOR TIỂU CẢNH</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown btn">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">THUÊ THIẾT BỊ</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('equipment.type', 'all') }}">TẤT CẢ THIẾT BỊ</a>

                                        
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    @foreach($equipmentTypes as $type)
                                    <li class="dropdown-item">
                                            <a href="{{ route('equipment.type', $type->id) }}">{{ strtoupper($type->equipment_type_name) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="btn">
                                <a href="{{ route('staff.indexUser') }}">THUÊ NHÂN SỰ</a>
                            </li>
                            <li class="btn">
                                <a href="{{ route('blog.index') }}">TIN TỨC</a>
                            </li>
                            <li class="btn">
                                <a href="{{ route('contact.index') }}">LIÊN HỆ & ĐÁNH GIÁ</a>
                            </li>
                            @if(Session::has('user_id'))
                                <li class="dropdown btn position-relative">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Session::get('user_name') }}
                                    </a>
                                    <ul class="dropdown-menu position-absolute" style="right: 0; left: auto; margin-top: 0;">
                                    <li class="dropdown-item">
                                            <a href="{{ route('user.profile') }}">Thông tin tài khoản</a>
                                    </li>
                                    <li class="dropdown-item">
                                            <a href="{{ route('user.bookings') }}">Lịch sử đặt hàng</a>
                                    </li>
                                    <li class="dropdown-item">
                                            <a href="{{ route('staff.rentals.index') }}">Lịch sử thuê nhân sự</a>
                                    </li>
                                    <li class="dropdown-item">
                                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn">ĐĂNG XUẤT</button>
                                            </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                                <li class="btn">
                                    <a href="{{ route('login') }}">ĐĂNG NHẬP</a>
                            </li>
                                <li class="btn">
                                    <a href="{{ route('register') }}">ĐĂNG KÝ</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>             
</div>
