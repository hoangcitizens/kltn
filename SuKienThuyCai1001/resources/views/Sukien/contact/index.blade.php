@extends('Sukien.layouts.noidung')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="container py-5">
    <!-- Add Font Awesome directly using script tag -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="contact-header text-center mb-5">
                <h2 class="display-4 fw-bold">Liên Hệ & Đánh Giá</h2>
                <p class="lead text-muted">Chúng tôi luôn sẵn sàng lắng nghe ý kiến của bạn để cải thiện dịch vụ tốt hơn</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="contact-info-card p-4 h-100">
                        <h3 class="mb-4">Thông Tin Liên Hệ</h3>
                        
                        <div class="contact-item d-flex align-items-center mb-4">
                            <div class="icon-box">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Địa Chỉ</h5>
                                <p>268 Lý Thường Kiệt, Phường 14, Quận 10, TP.HCM</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex align-items-center mb-4">
                            <div class="icon-box">
                                <i class="fas fa-phone-alt" aria-hidden="true"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Điện Thoại</h5>
                                <p>+84 123 456 789</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex align-items-center mb-4">
                            <div class="icon-box">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Email</h5>
                                <p>info@sukienthuycai.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex align-items-center">
                            <div class="icon-box">
                                <i class="fas fa-clock" aria-hidden="true"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Giờ Làm Việc</h5>
                                <p>8:00 AM - 8:00 PM, Thứ Hai - Thứ Bảy</p>
                            </div>
                        </div>
                        
                        <div class="social-media mt-5">
                            <h5>Kết nối với chúng tôi</h5>
                            <div class="social-icons mt-3">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-md-7">
                    <div class="contact-form-card p-4">
                        <h3 class="mb-4">Gửi Lời Nhắn</h3>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="message" class="form-label">Lời nhắn <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Gửi Tin Nhắn</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Google Maps Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4946681012923!2d106.65843731483634!3d10.773372892323583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec3c161a3fb%3A0xef77cd47a1cc691e!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJDhuqFpIGjhu41jIFF14buRYyBnaWEgVFAuSENN!5e0!3m2!1svi!2s!4v1650528030181!5m2!1svi!2s" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<style>
.contact-header h2 {
    color: #3498db;
    position: relative;
    padding-bottom: 15px;
}

.contact-header h2:after {
    content: '';
    position: absolute;
    width: 80px;
    height: 3px;
    background-color: #3498db;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}

.contact-info-card, 
.contact-form-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    height: 100%;
}

.icon-box {
    width: 50px;
    height: 50px;
    background-color: rgba(52, 152, 219, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #3498db;
    font-size: 20px;
}

.contact-text h5 {
    font-size: 1rem;
    margin-bottom: 5px;
    color: #2c3e50;
}

.contact-text p {
    margin-bottom: 0;
    color: #7f8c8d;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icon {
    width: 40px;
    height: 40px;
    background-color: rgba(52, 152, 219, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3498db;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background-color: #3498db;
    color: white;
}

.form-control {
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
}

.form-label {
    font-weight: 500;
    color: #2c3e50;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
    transform: translateY(-2px);
}

.map-container {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}
</style>
@endsection 