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
use App\Http\Controllers\Backend\AccredationController;
use App\Http\Controllers\Backend\AboutTestimonialsController;
use App\Http\Controllers\Backend\ChildPolicyController;
use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\PrivacyController;
use App\Http\Controllers\Backend\AdmissionController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\ScholarshipController;
use App\Http\Controllers\Backend\FeeStructureController;
use App\Http\Controllers\Backend\VirtualController;
use App\Http\Controllers\Backend\MediaCenterController;
use App\Http\Controllers\Backend\PerformingArtsController;
use App\Http\Controllers\Backend\TechnologyController;
use App\Http\Controllers\Backend\SportsController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SafetyController;
use App\Http\Controllers\Backend\BusServiceController;
use App\Http\Controllers\Backend\OtherFacilitiesController;
use App\Http\Controllers\Backend\STUCOController;
use App\Http\Controllers\Backend\CafeteriaController;




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

// ==== Manage School Calendar
Route::resource('manage-accredation-association', AccredationController::class);

// ==== Manage Testimonials
Route::resource('manage-about-testimonials', AboutTestimonialsController::class);

// ==== Manage Child Safeguarding Policy
Route::resource('manage-child-safeguarding-policy', ChildPolicyController::class);

// ==== Manage About Alumni
Route::resource('manage-about-alumni', AlumniController::class);

// ==== Manage Contact Us
Route::resource('manage-contact-us', ContactUsController::class);

// ==== Manage Privacy Policy
Route::resource('manage-privacy-policy', PrivacyController::class);

// ==== Manage Admission Criteria and Process
Route::resource('manage-admission-criteria', AdmissionController::class);

// ==== Manage FAQs
Route::resource('manage-faqs', FAQController::class);

// ==== Manage Merit Scholarship
Route::resource('manage-merit-scholarships', ScholarshipController::class);

// ==== Manage Fee Structure
Route::resource('manage-fee-structure', FeeStructureController::class);

// ==== Manage Virtual Tour
Route::resource('manage-virtual-tour', VirtualController::class);

// ==== Manage Media Centre
Route::resource('manage-media-center', MediaCenterController::class);

// ==== Manage IB Visual and Performing Arts
Route::resource('manage-ib-visual', PerformingArtsController::class);

// ==== Manage Technology
Route::resource('manage-technology', TechnologyController::class);

// ==== Manage Sports and Extra Curricular Activities
Route::resource('manage-sports-activities', SportsController::class);

// ==== Manage Service Learning
Route::resource('manage-service-learning', ServiceController::class);

// ==== Manage Safety and Security
Route::resource('manage-safety-security', SafetyController::class);

// ==== Manage Bus Service
Route::resource('manage-bus-service', BusServiceController::class);

// ==== Manage Other Facilities
Route::resource('manage-other-facilities', OtherFacilitiesController::class);

// ==== Manage STUCO
Route::resource('manage-stuco', STUCOController::class);

// ==== Manage Cafeteria
Route::resource('manage-cafeteria', CafeteriaController::class);






// ======================= Frontend =========================================

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');

    // ==== What sets us apart?
    Route::get('/what-sets-us-apart', [HomeController::class, 'what_sets_us_apart'])->name('frontend.what_sets_us_apart');

    // ==== Vision, Mission & Values
    Route::get('/vision-mission-and-values', [HomeController::class, 'vision_mission_and_values'])->name('frontend.vision_mission_and_values');

    // ==== Message From The Principal
    Route::get('/message-from-the-principal', [HomeController::class, 'message_from_the_principal'])->name('frontend.message_from_the_principal');

    // ==== Governance
    Route::get('/governance', [HomeController::class, 'governance'])->name('frontend.governance');

    // ==== Faculty & Staff
    Route::get('/faculty-and-staff', [HomeController::class, 'faculty_and_staff'])->name('frontend.faculty_and_staff');

    // ==== School Calendar
    Route::get('/school-calendar', [HomeController::class, 'school_calendar'])->name('frontend.school_calendar');

    // ==== Accreditation and associations
    Route::get('/accreditation-and-associations', [HomeController::class, 'accreditation_and_associations'])->name('frontend.accreditation_and_associations');

    // ==== Testimonials
    Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('frontend.testimonials');

    // ==== Child Safeguarding Policy
    Route::get('/child-safeguarding-policy', [HomeController::class, 'child_safeguarding_policy'])->name('frontend.child_safeguarding_policy');

    // ==== Alumni
    Route::get('/alumni', [HomeController::class, 'alumni'])->name('frontend.alumni');

    // ==== Contact Us
    Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('frontend.contact_us');

    // ==== Privacy Policy
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('frontend.privacy_policy');

    // ==== Admission Criteria and Process
    Route::get('/admission-criteria-and-process', [HomeController::class, 'admission_criteria_and_process'])->name('frontend.admission_criteria_and_process');

    // ==== FAQs
    Route::get('/faq', [HomeController::class, 'faq'])->name('frontend.faq');

    // ==== Fee Structure
    Route::get('/fee-structure', [HomeController::class, 'fee_structure'])->name('frontend.fee_structure');

    // ==== Merit Scholarship
    Route::get('/merit-scholarship', [HomeController::class, 'merit_scholarship'])->name('frontend.merit_scholarship');

    



});
