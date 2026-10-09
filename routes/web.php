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
use App\Http\Controllers\Backend\GalleryImagesController;
use App\Http\Controllers\Backend\GalleryVideosController;
use App\Http\Controllers\Backend\ApplyAdmissionController;
use App\Http\Controllers\Backend\ScheduleVisitController;
use App\Http\Controllers\Backend\EnquiryAdmissionController;
use App\Http\Controllers\Backend\UniversityController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\PolicyController;
use App\Http\Controllers\Backend\TeachingJobsController;
use App\Http\Controllers\Backend\NonTeachingJobsController;
use App\Http\Controllers\Backend\LearnerProfileController;
use App\Http\Controllers\Backend\StudentSupportController;
use App\Http\Controllers\Backend\UniversityPageController;
use App\Http\Controllers\Backend\UniversitiesController;
use App\Http\Controllers\Backend\CurriculumController;
use App\Http\Controllers\Backend\IBPrimaryController;
use App\Http\Controllers\Backend\IBMiddleController;
use App\Http\Controllers\Backend\IBDiplomaController;
use App\Http\Controllers\Backend\CreativityController;
use App\Http\Controllers\Backend\PrimaryYearsController;
use App\Http\Controllers\Backend\MiddleYearsController;
use App\Http\Controllers\Backend\DiplomaYearsController;
use App\Http\Controllers\Backend\BulletinCategoryController;
use App\Http\Controllers\Backend\BulletinListingController;
use App\Http\Controllers\Backend\BulletinDetailsController;
use App\Http\Controllers\Backend\JobPostingController;
use App\Http\Controllers\Backend\GradesController;
use App\Http\Controllers\Backend\AdmissionEnquiriesController;
use App\Http\Controllers\Backend\BrochureDetailsController;
use App\Http\Controllers\Backend\StudentAdmissionController;
use App\Http\Controllers\Backend\JobEnquriesController;
use App\Http\Controllers\Backend\UserRolesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\GrayquestStudentController;
use App\Http\Controllers\Backend\ContactEnquriesController;

use App\Models\StudentPayemntDetails;
use Barryvdh\DomPDF\Facade\Pdf;




use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AdmissionFormController;
use App\Http\Controllers\Frontend\TeachingFormController;

// Route::post('/ccavenue/response', [AdmissionFormController::class, 'handleResponse']);
// Route::match(['get','post'], '/ccavenue/cancel', [AdmissionFormController::class, 'handleCancel']);


// Route::post('/ccavenue/response', [AdmissionFormController::class, 'handleResponse'])->name('ccavenue.response');
// // CCAvenue cancel callback
// Route::get('/ccavenue/cancel', [AdmissionFormController::class, 'handleCancel'])->name('ccavenue.cancel');

Route::post('/payment', [AdmissionFormController::class, 'redirectToCCAvenue'])->name('proceed.to.payment');


Route::get('/test-mail', function () {
    try {
        \Mail::raw('SMTP Test Email', function($message){
            $message->to('riddhi@matrixbricks.com')->subject('SMTP Test');
        });
        return "Mail sent ✅";
    } catch (\Exception $e) {
        return "SMTP failed ❌: ".$e->getMessage();
    }
});


Route::get('/test-invoice-pdf/{payment_id}', function ($payment_id) {

    $payment = StudentPayemntDetails::findOrFail($payment_id);

    $feeBreakup = json_decode($payment->fee_breakup, true) ?? [
        'amount' => $payment->amount,
        'convenience_charges' => 0,
        'gst_on_charges' => 0,
        'total_paid' => $payment->amount_paid,
    ];

    return Pdf::loadView(
        'frontend.payment_invoice_pdf',
        [
            'payment' => $payment,
            'feeBreakup' => $feeBreakup,
        ]
    )->stream('TEST_Payment_Invoice.pdf');
});


// ==========================================================================
// Authentication Routes — MUST stay OUTSIDE the auth group
// (guests need these to log in; putting them inside causes a redirect loop)
// ==========================================================================
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');


// ==========================================================================
// Parent / Payment-gateway routes — MUST stay OUTSIDE the auth group
// (parents open these from email links; Razorpay/Grayquest servers post
// here; none of them have an admin login session)
// ==========================================================================
Route::get('/pay/{reference}', [StudentAdmissionController::class, 'razorpayCheckout'])->name('razorpay.checkout');
Route::post('/razorpay/capture', [StudentAdmissionController::class, 'captureRazorpayPayment'])->name('razorpay.capture');
Route::post('/razorpay/callback', [StudentAdmissionController::class, 'razorpayCallback'])->name('razorpay.callback');
Route::get('/payment/success', function() {return view('backend.student_admission.payment_success')->with('message', 'Payment completed successfully!');})->name('payment.success.page');
Route::get('/payment-failed/{reference}', [StudentAdmissionController::class, 'paymentFailed'])->name('payment.failed.page');

Route::get('/grayquest/pay/{application_id}',[GrayquestStudentController::class, 'paymentPage'])->name('grayquest.payment.page');
Route::post('/grayquest/payment-success', [GrayquestStudentController::class, 'paymentSuccess'])->name('grayquest.success');
Route::post('/grayquest/success', [GrayquestStudentController::class, 'paymentSuccess'])->name('grayquest.success');
Route::post('/grayquest/redirect', [GrayquestStudentController::class, 'getRedirectUrl'])->name('grayquest.redirect');


// =========================================================================== Backend Routes

// Route::get('/', function () {
//     return view('frontend.index');
// });



// // Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {

        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');


        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
        Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');




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

        // ==== Manage Apply For Admission
        Route::resource('manage-apply-admission', ApplyAdmissionController::class);

        // ==== Schedule A Visit For Admission
        Route::resource('manage-schedule-visit', ScheduleVisitController::class);

        // ==== Enquiry About Admission
        Route::resource('manage-enquiry-admission', EnquiryAdmissionController::class);

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

        // ==== Manage Gallery Images
        Route::resource('manage-gallery-images', GalleryImagesController::class);

        // ==== Manage Gallery Videos
        Route::resource('manage-gallery-videos', GalleryVideosController::class);

        // ==== Manage University of Bath
        Route::resource('manage-university-bath', UniversityController::class);

        // ==== Manage Career Opportunities
        Route::resource('manage-career', CareerController::class);

        // ==== Manage Policies
        Route::resource('manage-policies', PolicyController::class);

        // ==== Manage Teaching Job Opportunities
        Route::resource('manage-teaching-jobs', TeachingJobsController::class);

        // ==== Manage Teaching Job Posting
        Route::resource('manage-job-postings', JobPostingController::class);

        // ==== Manage Non-Teaching Job Opportunities
        Route::resource('manage-nonteaching-jobs', NonTeachingJobsController::class);

        // ==== Manage IB Learner Profile
        Route::resource('manage-learner-profile', LearnerProfileController::class);

        // ==== Manage Student Support Services
        Route::resource('manage-student-support', StudentSupportController::class);

        // ==== Manage University & College Counselling Programme
        Route::resource('manage-university-page', UniversityPageController::class);

        // ==== Manage University & College Counselling Programme
        Route::resource('manage-universities', UniversitiesController::class);

        // ==== Manage Curriculum Overview
        Route::resource('manage-curriculum', CurriculumController::class);

        // ==== Manage IB Primary Years Programme
        Route::resource('manage-ib-primary', IBPrimaryController::class);

        // ==== Manage IB Middle Years Programme
        Route::resource('manage-ib-middle', IBMiddleController::class);

        // ==== Manage IB Diploma Programme
        Route::resource('manage-ib-diploma', IBDiplomaController::class);

        // ==== Manage Creativity, Activity, Service
        Route::resource('manage-creativity-activity', CreativityController::class);

        // ==== Manage IB Early Years & Primary Years Programme
        Route::resource('manage-pyp', PrimaryYearsController::class);

        // ==== IB Middle Years Programme
        Route::resource('manage-myp', MiddleYearsController::class);

        // ==== Manage IB Diploma Programme
        Route::resource('manage-diploma', DiplomaYearsController::class);

        // ==== Manage Bulletin Board Catgeory
        Route::resource('manage-bulletin-category', BulletinCategoryController::class);

        // ==== Manage Bulletin Board Listing
        Route::resource('manage-bulletin-listing', BulletinListingController::class);
        Route::post('/bulletin/highlight-toggle', [BulletinListingController::class, 'toggleHighlight'])->name('bulletin.toggle.highlight');


        // ==== Manage Bulletin Board Details
        Route::resource('manage-bulletin-details', BulletinDetailsController::class);
        Route::get('/bulletin/articles/{categoryId}', [App\Http\Controllers\Backend\BulletinDetailsController::class, 'getArticles'])->name('bulletin.getArticles');

        // ==== Manage Grades Master
        Route::resource('manage-grades', GradesController::class);

        // ==== Manage Admission Enquiries
        Route::resource('manage-addmission-enquiries', AdmissionEnquiriesController::class);
        Route::get('/manage-addmission-enquiries/{id}', [AdmissionController::class, 'show'])->name('manage-addmission-enquiries.show');
        Route::get('/admission/{id}/pdf',[AdmissionEnquiriesController::class, 'generatePdf'])->name('admission.pdf');
        Route::put('/admission/{id}/status', [AdmissionEnquiriesController::class, 'updateStatus'])->name('admission.updateStatus');

        // ==== Manage Brochure Admission Details
        Route::resource('manage-brochure-details', BrochureDetailsController::class);

        // ==== Manage Ecole Student Admission Details
        Route::resource('manage-student-details', StudentAdmissionController::class);
        Route::post('/students/import', [StudentAdmissionController::class, 'import'])->name('student.import');
        Route::post('/update-emi', [StudentAdmissionController::class, 'updateEmi'])->name('update.emi');
        Route::post('/send-payment-mail', [StudentAdmissionController::class, 'sendPaymentMail'])->name('send.payment.mail');

        Route::get('/generate-pdf', [StudentAdmissionController::class, 'streamPDF'])->name('generate.pdf');
        Route::get('/students/export', [StudentAdmissionController::class, 'exportCsv'])->name('students.export');





        // ==== Manage Grayquest Student Admission Details
        Route::resource('manage-grayquest-student', GrayquestStudentController::class);
        Route::post('/grayquest/import', [GrayquestStudentController::class, 'import'])->name('graquest.import');
        Route::get('/graquest/export', [GrayquestStudentController::class, 'export'])->name('graquest.export');
        Route::post('/grayquest/create', [GrayquestStudentController::class, 'createApplication'])->name('grayquest.create');
        Route::get('/grayquest/status', [GrayquestStudentController::class, 'checkStatus'])->name('grayquest.status');
        Route::post('/grayquest/create-application', [GrayquestStudentController::class, 'createApplication'])->name('grayquest.create-application');
        Route::post('/grayquest/generate-ids', [GrayquestStudentController::class, 'generateStudentIDs'])->name('grayquest.generateIDs');
        Route::post('/grayquest/send-mail', [GrayquestStudentController::class, 'sendMail'])->name('grayquest.sendMail');



        // ==== Manage Job Enquiries
        Route::resource('manage-job-enquiries', JobEnquriesController::class);
        Route::get('/manage-job-enquiries/{id}', [JobEnquriesController::class, 'show'])->name('manage-job-view.show');
        Route::get('/job-application/pdf/{id}', [JobEnquriesController::class, 'downloadPDF'])->name('job-application.pdf');

        // ==== Manage Contact Enquiries
        Route::resource('manage-contact-enquiries', ContactEnquriesController::class);
        Route::get('/manage-contact-enquiries/{id}', [ContactEnquriesController::class, 'show'])->name('manage-contact-view.show');
        Route::get('/job-contact/pdf/{id}', [ContactEnquriesController::class, 'downloadPDF'])->name('contact-application.pdf');


        // ==== Manage Role Management
        Route::resource('manage-roles', UserRolesController::class);

        // ==== Manage User Management
        Route::resource('manage-users', UserController::class);
        Route::post('/manage-users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('manage-users.toggle-status');

});


// ======================= Frontend =========================================

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');
    
    // ==== Alumni Guidance
    Route::get('/ecole-alumni-guidance', [HomeController::class, 'alumni_guidance'])->name('frontend.alumni_guidance');
    
    // ==== Success Stories
    Route::get('/ecole-success-stories', [HomeController::class, 'success_stories'])->name('frontend.success_stories');
    
    
     // ==== Sitemap
    Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('frontend.sitemap');

    // ==== What sets us apart?
    Route::get('/about-us/what-sets-us-apart', [HomeController::class, 'what_sets_us_apart'])->name('frontend.what_sets_us_apart');

    // ==== Vision, Mission & Values
    Route::get('/about-us/vision-mission-and-values', [HomeController::class, 'vision_mission_and_values'])->name('frontend.vision_mission_and_values');

    // ==== Message From The Principal
    Route::get('/about-us/message-from-the-principal', [HomeController::class, 'message_from_the_principal'])->name('frontend.message_from_the_principal');

    // ==== Governance
    Route::get('/about-us/governance', [HomeController::class, 'governance'])->name('frontend.governance');

    // ==== Faculty & Staff
    Route::get('/about-us/faculty-and-staff', [HomeController::class, 'faculty_and_staff'])->name('frontend.faculty_and_staff');

    // ==== School Calendar
    Route::get('/about-us/school-calendar', [HomeController::class, 'school_calendar'])->name('frontend.school_calendar');

    // ==== Accreditation and associations
    Route::get('/about-us/accreditation-and-associations', [HomeController::class, 'accreditation_and_associations'])->name('frontend.accreditation_and_associations');

    // ==== Testimonials
    Route::get('/about-us/testimonials', [HomeController::class, 'testimonials'])->name('frontend.testimonials');

    // ==== Child Safeguarding Policy
    Route::get('/about-us/child-safeguarding-policy', [HomeController::class, 'child_safeguarding_policy'])->name('frontend.child_safeguarding_policy');

    // ==== Alumni
    Route::get('/about-us/alumni', [HomeController::class, 'alumni'])->name('frontend.alumni');

    // ==== Contact Us
    Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('frontend.contact_us');

    // ==== Privacy Policy
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('frontend.privacy_policy');

    // ==== Admission Criteria and Process
    Route::get('/admissions/admission-criteria-and-process', [HomeController::class, 'admission_criteria_and_process'])->name('frontend.admission_criteria_and_process');

    // ==== FAQs
    Route::get('/admissions/faq', [HomeController::class, 'faq'])->name('frontend.faq');

    // ==== Fee Structure
    // Route::get('/admissions/fee-structure', [HomeController::class, 'fee_structure'])->name('frontend.fee_structure');

    // ==== Merit Scholarship
    Route::get('/admissions/merit-scholarship', [HomeController::class, 'merit_scholarship'])->name('frontend.merit_scholarship');

    // ==== Virtual Tour
    Route::get('/campus-life/virtual-tour', [HomeController::class, 'virtual_tour'])->name('frontend.virtual_tour');

    // ==== Media Centre
    Route::get('/campus-life/media-center', [HomeController::class, 'media_center'])->name('frontend.media_center');

    // ==== IB Visual and Performing Arts
    Route::get('/campus-life/ib-visual-and-performing-arts', [HomeController::class, 'ib_visual_and_performing_arts'])->name('frontend.ib_visual_and_performing_arts');

    // ==== Technology
    Route::get('/campus-life/technology', [HomeController::class, 'technology'])->name('frontend.technology');

    // ==== Sports and Extra Curricular Activities
    Route::get('/campus-life/sports-and-extra-curricular-activities', [HomeController::class, 'sports_and_extra_curricular_activities'])->name('frontend.sports_and_extra_curricular_activities');

    // ==== Gallery
    Route::get('/campus-life/gallery', [HomeController::class, 'gallery'])->name('frontend.gallery');

    // Route to show gallery by slug
    Route::get('/campus-life/images/{slug}', [HomeController::class, 'showBySlug'])->name('gallery.show');

    // ==== STUCO
    Route::get('/campus-life/stuco', [HomeController::class, 'stuco'])->name('frontend.stuco');

    // ==== Service Learning
    Route::get('/campus-life/service-learning', [HomeController::class, 'service_learning'])->name('frontend.service_learning');

    // ==== Cafeteria
    Route::get('/campus-life/cafeteria', [HomeController::class, 'cafeteria'])->name('frontend.cafeteria');

    // ==== Safety and Security
    Route::get('/campus-life/safety-and-security', [HomeController::class, 'safety_and_security'])->name('frontend.safety_and_security');

    // ==== Bus Service
    Route::get('/campus-life/bus-service', [HomeController::class, 'bus_service'])->name('frontend.bus_service');

    // ==== Other Facilities
    Route::get('/campus-life/other-facilities', [HomeController::class, 'other_facilities'])->name('frontend.other_facilities');

    // ==== Apply For Admission
    Route::get('/admissions/apply-for-admission', [HomeController::class, 'apply_for_admission'])->name('frontend.apply_for_admission');

    // ==== Schedule A Visit For Admission
    Route::get('/admissions/schedule-a-visit-for-admission', [HomeController::class, 'schedule_a_visit_for_admission'])->name('frontend.schedule_a_visit_for_admission');

    // ==== Enquiry About Admission
    Route::get('/admissions/enquiry-about-admission', [HomeController::class, 'enquiry_about_admission'])->name('frontend.enquiry_about_admission');

    // ==== University of Bath
    Route::get('/university-of-bath', [HomeController::class, 'university_of_bath'])->name('frontend.university_of_bath');

    // ==== Career Opportunities
    Route::get('/careers/career-opportunities', [HomeController::class, 'career_opportunities'])->name('frontend.career_opportunities');

    // ==== Policies
    Route::get('/policies', [HomeController::class, 'policies'])->name('frontend.policies');

    // ==== Teaching Job Opportunities
    Route::get('/careers/vacancy/teaching-job-opportunities', [HomeController::class, 'teaching_job_opportunities'])->name('frontend.teaching_job_opportunities');

    // ==== Teaching Job Opportunities Form
    Route::get('/careers/vacancy/teaching-job-opportunities-form', [HomeController::class, 'teaching_job_opportunities_form'])->name('frontend.teaching_job_opportunities_form');

    // ==== Non-Teaching Job Opportunities
    Route::get('/careers/vacancy/non-teaching-job-opportunities', [HomeController::class, 'non_teaching_job_opportunities'])->name('frontend.non_teaching_job_opportunities');

    // ==== Non-Teaching Job Opportunities Form 
    Route::get('/careers/vacancy/non-teaching-job-opportunities-form', [HomeController::class, 'non_teaching_job_opportunities_form'])->name('frontend.non_teaching_job_opportunities_form');

    // ==== IB Learner Profile
    Route::get('/academic/ib-learner-profile', [HomeController::class, 'ib_learner_profile'])->name('frontend.ib_learner_profile');

    // ==== Student Support Services
    Route::get('/academic/student-support-services', [HomeController::class, 'student_support_services'])->name('frontend.student_support_services');

    // ==== University & College Counselling Programme
    Route::get('/academic/college-counselling', [HomeController::class, 'college_counselling'])->name('frontend.college_counselling');

    // ==== Curriculum Overview
    Route::get('/academic/curriculum-overview', [HomeController::class, 'curriculum_overview'])->name('frontend.curriculum_overview');

    // ==== IB Primary Years Programme
    Route::get('/academic/primary-years-programme', [HomeController::class, 'primary_years_programme'])->name('frontend.primary_years_programme');

    // ==== IB Middle Years Programme
    Route::get('/academic/middle-years-programme', [HomeController::class, 'middle_years_programme'])->name('frontend.middle_years_programme');

    // ==== IB Diploma Programme
    Route::get('/academic/diploma-programme', [HomeController::class, 'diploma_programme'])->name('frontend.diploma_programme');

    // ==== Creativity, Activity, Service
    Route::get('/academic/cas-service-programme', [HomeController::class, 'cas_service_programme'])->name('frontend.cas_service_programme');

    // ====  Creativity, Activity, Service Detail Page
    Route::get('/academic/cas-service-programme/{slug}', [HomeController::class, 'creativity_detail'])->name('frontend.creativity_detail');

    // ==== IB Early Years & Primary Years Programme
    Route::get('/academic/ib-pyp-schools-mumbai', [HomeController::class, 'ib_pyp_schools_mumbai'])->name('frontend.ib_pyp_schools_mumbai');

    // ==== IB Middle Years Programme
    Route::get('/academic/ib-myp-schools-mumbai', [HomeController::class, 'ib_myp_schools_mumbai'])->name('frontend.ib_myp_schools_mumbai');

    // ==== IB Diploma Programme
    Route::get('/academic/ib-diploma-school-mumbai', [HomeController::class, 'ib_diploma_school_mumbai'])->name('frontend.ib_diploma_school_mumbai');

    // ==== Bulletin Board
    Route::get('/bulletin-board', [HomeController::class, 'bulletin_board'])->name('frontend.bulletin_board');

    // ==== Bulletin Board Category
    Route::get('/bulletin-board/{category_slug}', [HomeController::class, 'bulletin_board_category_list'])->name('frontend.bulletin_board_category_list');

    // ==== Bulletin Board Details
    Route::get('/bulletin-board/{category_slug}/{article_slug}', [HomeController::class, 'bulletin_board_details'])->name('frontend.bulletin_board_details');
    
    // ==== Thankyou Page
    Route::get('/thank-you', [HomeController::class, 'thank_you'])->name('thank.you');
    
     // ==== Thankyou Page
    Route::get('/ecole-thank-you', [HomeController::class, 'ecole_thank_you'])->name('ecole.thank.you');

    // ==== Admission Form Submission
    Route::post('/apply-for-admission/store', [AdmissionFormController::class, 'store'])->name('admission.store');

    // ==== Proceed to Payment
    Route::post('/proceed-to-payment', [AdmissionFormController::class, 'proceed_to_payment'])->name('frontend.proceed_to_payment');
    Route::get('/proceed/{id}', [AdmissionFormController::class, 'showPayment'])->name('frontend.payment.show');
    // Route::post('/payment', [AdmissionFormController::class, 'redirectToCCAvenue'])->name('proceed.to.payment');
    // Route::post('/ccavenue/response', [AdmissionFormController::class, 'handleResponse'])->name('ccavenue.response');
    
    // Route::post('ccavenue/response', [AdmissionFormController::class, 'handleResponse'])
    // ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    // ->name('ccavenue.response');
    
    // ==== Teaching Form Submission
    Route::post('/teaching-form-submit', [TeachingFormController::class, 'teaching_store'])->name('teaching.store');
    
    // ==== Contact Us Form Submission
    Route::post('/contact-form-submit', [TeachingFormController::class, 'contact_store'])->name('contact.store');

    Route::fallback(function () {
        return redirect('/', 301);
    });

});