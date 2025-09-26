<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


use App\Http\Controllers\Backend\BannerDetailsController;
use App\Http\Controllers\Backend\ProgramOfferedController;
use App\Http\Controllers\Backend\FestivitiesController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\BulletinBoardController;
use App\Http\Controllers\Backend\TestimonialsController;
use App\Http\Controllers\Backend\ClientsController;
use App\Http\Controllers\Backend\WhatsetsusapartController;
use App\Http\Controllers\Backend\VisionMissionController;
use App\Http\Controllers\Backend\MessagePrincipalController;
use App\Http\Controllers\Backend\GovernanceController;
use App\Http\Controllers\Backend\FacultyStaffController;
use App\Http\Controllers\Backend\SchoolCalendarController;
use App\Http\Controllers\Backend\AboutTestimonialsController;
use App\Http\Controllers\Backend\ChildPolicyController;



use App\Http\Controllers\Frontend\HomeController;;

// =========================================================================== Backend Routes

// Route::get('/', function () {
//     return view('frontend.index');
// });
  
// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// // Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');
});


// Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
// });


// ==== Manage Banner Details
Route::resource('manage-banner-details', BannerDetailsController::class);

// ==== Manage Programme Offered
Route::resource('manage-programme-offered', ProgramOfferedController::class);

// ==== Manage Home Festivities
Route::resource('manage-home-festivities', FestivitiesController::class);

// ==== Manage Home Features
Route::resource('manage-home-features', FeaturesController::class);

// ==== Manage Bulletin Board
Route::resource('manage-bulletin-board', BulletinBoardController::class);

// ==== Manage Testimonials
Route::resource('manage-testimonials', TestimonialsController::class);

// ==== Manage Clients
Route::resource('manage-clients', ClientsController::class);

// ==== Manage What sets us apart?
Route::resource('manage-what-sets-us-apart', WhatsetsusapartController::class);

// ==== Manage Vision, Mission & Values
Route::resource('manage-vision-mission', VisionMissionController::class);

// ==== Manage Message From The Principal
Route::resource('manage-message-from-principal', MessagePrincipalController::class);

// ==== Manage Governance
Route::resource('manage-governance', GovernanceController::class);

// ==== Manage Faculty & Staff
Route::resource('manage-faculty-and-staff', FacultyStaffController::class);

// ==== Manage School Calendar
Route::resource('manage-school-calendar', SchoolCalendarController::class);

// ==== Manage Testimonials
Route::resource('manage-about-testimonials', AboutTestimonialsController::class);

// ==== Manage Child Safeguarding Policy
Route::resource('manage-child-safeguarding-policy', ChildPolicyController::class);






// ======================= Frontend =========================================

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');


});
