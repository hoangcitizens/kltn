<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
// use App\Http\Controllers\Event\SuKienController;
use App\Http\Controllers\SuKienController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\EquipmentController as AdminEquipmentController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffRentalController;
use App\Http\Controllers\Admin\StaffRentalController as AdminStaffRentalController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Sukien.trangchu');
});

Route::get('/Sukien', [SuKienController::class, 'index']);
Route::get('/Sukien', [SuKienController::class, 'index'])->name('trangchu.show');
Route::get('/Tintuc', [SuKienController::class, 'Blog'])->name('tintuc.show');

// Service routes
Route::prefix('dich-vu')->group(function () {
    Route::get('/tiec-cuoi', [ServiceController::class, 'wedding'])->name('services.wedding');
    Route::get('/tiec-cuoi/{slug}', [ServiceController::class, 'showWeddingPost'])->name('services.wedding.post');
});

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

// Event routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
    Route::post('/', [EventController::class, 'store'])->name('events.store')->middleware('auth');
    Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
    Route::put('/{id}', [EventController::class, 'update'])->name('events.update')->middleware('auth');
    Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('auth');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User routes
// Staff Routes
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/user', [StaffController::class, 'indexUser'])->name('staff.indexUser');

Route::middleware(['check.login'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.update-profile');
    Route::get('/my-bookings', [UserController::class, 'bookings'])->name('user.bookings');


    // Staff Rental Routes
    Route::get('/staff/{staff}/rentals/create', [StaffRentalController::class, 'create'])->name('staff.rentals.create');
    Route::post('/staff/rentals', [StaffRentalController::class, 'store'])->name('staff.rentals.store');
    Route::get('/staff/rentals', [StaffRentalController::class, 'index'])->name('staff.rentals.index');
    Route::get('/staff/rentals/{rental}', [StaffRentalController::class, 'show'])->name('staff.rentals.show');
    Route::put('/staff/rentals/{rental}/cancel', [StaffRentalController::class, 'cancel'])->name('staff.rentals.cancel');
    Route::delete('/staff/rentals/{rental}', [StaffRentalController::class, 'destroy'])->name('staff.rentals.destroy');
});

// Admin routes
Route::middleware(['check.login', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Booking routes
Route::middleware(['check.login'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{id}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::put('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::put('/bookings/{id}/return', [BookingController::class, 'returnEquipment'])->name('bookings.return');
});

// Equipment routes
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/type/{type}', [EquipmentController::class, 'getByType'])->name('equipment.type');
Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');

// Admin Auth Routes (public routes)
Route::get('/admin', [AdminAuthController::class, 'showLoginForm']);
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (protected routes)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Blogs
    Route::resource('blogs', AdminBlogController::class);

    // Equipment
    Route::resource('equipment', AdminEquipmentController::class);

    // Equipment rental approval routes
    Route::get('/equipment-rentals', [AdminEquipmentController::class, 'rentalRequests'])->name('equipment.rentals');
    Route::get('/equipment-rentals/{booking_id}', [AdminEquipmentController::class, 'rentalRequestDetail'])->name('equipment.rental.detail');
    Route::put('/equipment-rentals/{booking_id}/approve', [AdminEquipmentController::class, 'approveRental'])->name('equipment.rental.approve');
    Route::put('/equipment-rentals/{booking_id}/reject', [AdminEquipmentController::class, 'rejectRental'])->name('equipment.rental.reject');
    Route::put('/equipment-rentals/{booking_id}/return', [AdminEquipmentController::class, 'markAsReturned'])->name('equipment.rental.return');

    // Staff routes
    Route::resource('staff', AdminStaffController::class);

    // Staff Rental Routes
    Route::get('/staff-rentals', [AdminStaffRentalController::class, 'index'])->name('staff.rentals');
    Route::get('/staff-rentals/{rental}', [AdminStaffRentalController::class, 'show'])->name('staff-rentals.show');
    Route::put('/staff-rentals/{rental}/approve', [AdminStaffRentalController::class, 'approve'])->name('staff-rentals.approve');
    Route::put('/staff-rentals/{rental}/reject', [AdminStaffRentalController::class, 'reject'])->name('staff-rentals.reject');
    Route::delete('/staff-rentals/{rental}', [AdminStaffRentalController::class, 'destroy'])->name('staff-rentals.destroy');

    // Statistics routes
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');

    // User Management
    Route::resource('users', UserController::class);

    // Contact management routes
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
