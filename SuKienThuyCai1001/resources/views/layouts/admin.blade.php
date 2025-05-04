<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #f8f9fa;
        }
        .content {
            padding: 20px;
        }
        .ck-editor__editable {
            min-height: 400px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h4>Admin Panel</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-list"></i> Danh mục
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.blogs.index') }}">
                                <i class="fas fa-blog"></i> Bài viết
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.equipment.index') }}">
                                <i class="fas fa-tools"></i>
                                <span>Quản lý thiết bị</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.staff.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Quản lý nhân sự</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.equipment.rentals') }}">
                                <i class="fas fa-clipboard-check"></i>
                                <span>Duyệt thuê thiết bị</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.staff.rentals') }}">
                                <i class="fas fa-clipboard-check"></i>
                                <span>Duyệt thuê nhân sự</span>
                            </a>
                        </li>
                        <!-- Nav Item - Statistics -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.statistics.index') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Thống kê doanh thu</span>
                            </a>
                        </li>
                        <!-- Nav Item - Users -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Quản lý tài khoản</span>
                            </a>
                        </li>
                        <!-- Sidebar - Contacts -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                                <i class="fas fa-fw fa-envelope"></i>
                                <span>Quản lý liên hệ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- CKEditor Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editors = document.querySelectorAll('.ckeditor');
            editors.forEach(editor => {
                ClassicEditor
                    .create(editor, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
                        language: 'en'
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
    @yield('scripts')
</body>
</html> 