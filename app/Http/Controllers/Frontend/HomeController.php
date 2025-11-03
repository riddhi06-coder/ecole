<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\ProgrammeOffered;
use App\Models\HomeFestivities;
use App\Models\HomeFeatures;
use App\Models\BulletinBoard;
use App\Models\Testimonial;
use App\Models\Clients;
use App\Models\WhatSetsUsApart;
use App\Models\VisionMission;
use App\Models\MessagePrincipal;
use App\Models\Governance;
use App\Models\FacultyStaff;
use App\Models\SchoolCalendar;
use App\Models\AccredationAssociation;
use App\Models\AboutTestimonial;
use App\Models\ChildPolicy;
use App\Models\AboutAlumni;
use App\Models\ContactUs;
use App\Models\PrivacyPolicy;
use App\Models\AdmissionProcedure;
use App\Models\Faqs;
use App\Models\FeeStructure;
use App\Models\MeritScholarship;
use App\Models\VirtualTour;
use App\Models\MediaCenter;
use App\Models\IBVisual;
use App\Models\Technology;
use App\Models\SportsActivity;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\STUCO;
use App\Models\Service;
use App\Models\Cafeteria;
use App\Models\SafetySecurity;
use App\Models\BusService;
use App\Models\OtherFacilities;
use App\Models\ApplyAdmission;
use App\Models\ScheduleVisit;
use App\Models\EnquiryAdmission;
use App\Models\UniversityBath;
use App\Models\Career;
use App\Models\Policy;
use App\Models\ManageTeachingJob;
use App\Models\ManageNonTeachingJob;
use App\Models\ManageLearnerProfile;
use App\Models\StudentSupport;
use App\Models\UniversityPage;
use App\Models\UniversityColleges;
use App\Models\Curriculum;
use App\Models\IBPrimary;
use App\Models\IBMiddle;
use App\Models\IBDiploma;
use App\Models\CreativityActivity;
use App\Models\Pyp;
use App\Models\Myp;
use App\Models\Diploma;
use App\Models\BulletinListing;
use App\Models\BulletinDetails;
use App\Models\BulletinCategory;
use App\Models\JobPosting;


class HomeController extends Controller
{

    // === Home
    public function home() {
        $home = Banner::wherenull('deleted_by')->get();
        $programmes = ProgrammeOffered::whereNull('deleted_by')->get();
        $festivities = HomeFestivities::whereNull('deleted_by')->get();
        $features = HomeFeatures::whereNull('deleted_by')->get();
        $bulletin = BulletinBoard::whereNull('deleted_by')->get();
        $testimonials = Testimonial::whereNull('deleted_by')->get();
        $clients = Clients::whereNull('deleted_by')->get();


        // === Fetch Univariety Alumni API
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://ags.univariety.com/common/v1/schoolapi/alumni-profile-card-notable',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'api-key: 742rUs9xMOOEiKuC'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $alumniData = json_decode($response, true);


        // === Attach related bulletin URLs to each festivity
        foreach ($festivities as $festivity) {

            if (stripos($festivity->heading, 'IB Continuum School') !== false) {
                // Direct link for IB Continuum School
                $festivity->url = route('frontend.accreditation_and_associations');
            
            } else {
                // Try to find a related bulletin article by matching heading
                $article = BulletinListing::where('article_name', 'like', '%' . $festivity->heading . '%')->first();

                if ($article) {
                
                    // Get category from related listing or directly from category_id
                    $category = BulletinCategory::find($article->category_id);
                    $categorySlug = $category ? $category->slug : 'general';
                    $articleSlug = $article->slug ?? Str::slug($article->article_name);

                    // Build full route
                    $festivity->url = route('frontend.bulletin_board_details', [
                        'category_slug' => $categorySlug,
                        'article_slug' => $articleSlug
                    ]);

                } else {
          
                    $festivity->url = 'javascript:void(0)';
                }
            }
        }


        // === Attach related bulletin URLs to each bulletin card
        foreach ($bulletin as $item) {
            $article = BulletinListing::where('article_name', 'like', '%' . $item->title . '%')->first();

            if ($article) {
                $category = BulletinCategory::find($article->category_id);
                $categorySlug = $category ? $category->slug : 'general';
                $articleSlug = $article->slug ?? Str::slug($article->article_name);

                $item->url = route('frontend.bulletin_board_details', [
                    'category_slug' => $categorySlug,
                    'article_slug' => $articleSlug
                ]);

                Log::info('Bulletin card mapped:', [
                    'title' => $item->title,
                    'url' => $item->url
                ]);
            } else {
                $item->url = 'javascript:void(0)';
                Log::warning('No article found for bulletin card:', [
                    'title' => $item->title
                ]);
            }
        }


        return view('frontend.home', compact('home','programmes','festivities','features','bulletin','testimonials','clients','alumniData'));
    }

    // === What sets us apart?
    public function what_sets_us_apart() {
        $what_sets_us_apart = WhatSetsUsApart::wherenull('deleted_by')->get();
        return view('frontend.what_sets_us_apart', compact('what_sets_us_apart'));
    }

    // === Vision, Mission & Values
    public function vision_mission_and_values() {
        $vision_mission_and_values = VisionMission::wherenull('deleted_by')->get();
        return view('frontend.vision_mission_and_values', compact('vision_mission_and_values'));
    }

    // === Message From The Principal
    public function message_from_the_principal() {
        $message_from_the_principal = MessagePrincipal::wherenull('deleted_by')->first();
        return view('frontend.message_from_the_principal', compact('message_from_the_principal'));
    }

    // === Governance
    public function governance() {
        $governance = Governance::wherenull('deleted_by')->first();
        return view('frontend.governance', compact('governance'));
    }

    // ===  Faculty & Staff
    public function faculty_and_staff() {
        $faculty_and_staff = FacultyStaff::wherenull('deleted_by')->first();
        return view('frontend.faculty_and_staff', compact('faculty_and_staff'));
    }

    // ===  School Calendar
    public function school_calendar() {
        $school_calendar = SchoolCalendar::wherenull('deleted_by')->first();
        return view('frontend.school_calendar', compact('school_calendar'));
    }

    // ===  Accreditation and associations
    public function accreditation_and_associations() {
        $accreditation_and_associations = AccredationAssociation::wherenull('deleted_by')->get();
        return view('frontend.accreditation_and_associations', compact('accreditation_and_associations'));
    }

    // ==== Testimonials
    public function testimonials() {
        $testimonials = AboutTestimonial::wherenull('deleted_by')->first();
        $testimonial = AboutTestimonial::wherenull('deleted_by')->get();
        return view('frontend.testimonials', compact('testimonials','testimonial'));
    }
   
    // ===  Child Safeguarding Policy
    public function child_safeguarding_policy() {
        $child_safeguarding_policy = ChildPolicy::wherenull('deleted_by')->first();
        return view('frontend.child_safeguarding_policy', compact('child_safeguarding_policy'));
    }

    // ==== Alumni
    public function alumni() {
        $alumni_banner = AboutAlumni::wherenull('deleted_by')->first();
        $alumni = AboutAlumni::wherenull('deleted_by')->get();
        return view('frontend.alumni', compact('alumni_banner','alumni'));
    }

    // ==== Contact Us
    public function contact_us() {
        $contact_us = ContactUs::wherenull('deleted_by')->first();
        return view('frontend.contact_us', compact('contact_us'));
    }

    // ==== Privacy Policy
    public function privacy_policy() {
        $privacy_policy_banner = PrivacyPolicy::wherenull('deleted_by')->first();
        $privacy_policy = PrivacyPolicy::wherenull('deleted_by')->get();
        return view('frontend.privacy_policy', compact('privacy_policy_banner','privacy_policy'));
    }

    // ====  Apply For Admission
    public function apply_for_admission() {
        $apply_for_admission = ApplyAdmission::wherenull('deleted_by')->first();

        $countries = DB::table('countries')
            ->orderBy('id', 'asc')
            ->get();


        $nationality = DB::table('countries')
            ->orderBy('id', 'asc')
            ->get();

        // ✅ Generate dynamic academic years (previous, current, upcoming)
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        $academicYears = [
            ($currentYear) . ' - ' . $nextYear,
            ($nextYear) . ' - ' . ($nextYear + 1),
        ];


        return view('frontend.apply_for_admission', compact('apply_for_admission','countries','academicYears','nationality'));
    }

    // ====  Schedule A Visit For Admission
    public function schedule_a_visit_for_admission() {
        $schedule_a_visit_for_admission = ScheduleVisit::wherenull('deleted_by')->first();
        return view('frontend.schedule_a_visit_for_admission', compact('schedule_a_visit_for_admission'));
    }

    // ====  Enquiry About Admission
    public function enquiry_about_admission() {
        $enquiry_about_admission = EnquiryAdmission::wherenull('deleted_by')->first();
        return view('frontend.enquiry_about_admission', compact('enquiry_about_admission'));
    }

    // ==== Admission Criteria and Process
    public function admission_criteria_and_process() {
        $admission_criteria_and_process_banner = AdmissionProcedure::wherenull('deleted_by')->first();
        $admission_criteria_and_process = AdmissionProcedure::wherenull('deleted_by')->get();
        return view('frontend.admission_criteria_and_process', compact('admission_criteria_and_process_banner','admission_criteria_and_process'));
    }

    // ==== FAQs
    public function faq() {
        $faq_banner = Faqs::wherenull('deleted_by')->first();
        $faq = Faqs::wherenull('deleted_by')->get();
        return view('frontend.faq', compact('faq_banner','faq'));
    }

    // ==== Fee Structure
    public function fee_structure() {
        $fee_structure_banner = FeeStructure::wherenull('deleted_by')->first();
        $fee_structure = FeeStructure::wherenull('deleted_by')->get();
        return view('frontend.fee_structure', compact('fee_structure_banner','fee_structure'));
    }

    // ====  Merit Scholarship
    public function merit_scholarship() {
        $merit_scholarship_banner = MeritScholarship::wherenull('deleted_by')->first();
        $merit_scholarship = MeritScholarship::wherenull('deleted_by')->get();
        return view('frontend.merit_scholarship', compact('merit_scholarship_banner','merit_scholarship'));
    }

    // ====  Virtual Tour
    public function virtual_tour() {
        $virtual_tour_banner = VirtualTour::wherenull('deleted_by')->first();
        $virtual_tour = VirtualTour::wherenull('deleted_by')->get();
        return view('frontend.virtual_tour', compact('virtual_tour_banner','virtual_tour'));
    }

    // ====  Media Centre
    public function media_center() {
        $media_center_banner = MediaCenter::wherenull('deleted_by')->first();
        $media_center = MediaCenter::wherenull('deleted_by')->get();
        return view('frontend.media_center', compact('media_center_banner','media_center'));
    }

    // ====  IB Visual and Performing Arts
    public function ib_visual_and_performing_arts() {
        $ib_visual_and_performing_arts_banner = IBVisual ::wherenull('deleted_by')->first();
        $ib_visual_and_performing_arts = IBVisual ::wherenull('deleted_by')->get();
        return view('frontend.ib_visual_and_performing_arts', compact('ib_visual_and_performing_arts_banner','ib_visual_and_performing_arts'));
    }

    // ====  Technology
    public function technology() {
        $technology_banner = Technology ::wherenull('deleted_by')->first();
        return view('frontend.technology', compact('technology_banner'));
    }

    // ====  Sports and Extra Curricular Activities
    public function sports_and_extra_curricular_activities() {
        $sports_and_extra_curricular_activities_banner = SportsActivity ::wherenull('deleted_by')->first();
        $sports_and_extra_curricular_activities = SportsActivity ::wherenull('deleted_by')->get();
        return view('frontend.sports_and_extra_curricular_activities', compact('sports_and_extra_curricular_activities_banner','sports_and_extra_curricular_activities'));
    }

    // ====  Gallery
    public function gallery() {
        $gallery_banner = GalleryImage ::wherenull('deleted_by')->first();
        $gallery = GalleryImage ::wherenull('deleted_by')->get();

        $gallery_videos = GalleryVideo ::wherenull('deleted_by')->get();
        return view('frontend.gallery', compact('gallery_banner','gallery','gallery_videos'));
    }
 
    //====  Gallery Detailed images
    public function showBySlug($slug)
    {
        // Fetch gallery where slug matches
        $gallery_banner = GalleryImage ::wherenull('deleted_by')->first();
        $galleryItem = GalleryImage::where('slug', $slug)
                              ->whereNull('deleted_by')
                              ->firstOrFail();

        $images = json_decode($galleryItem->gallery_images, true) ?? [];

        return view('frontend.gallery_images', compact('gallery_banner','galleryItem', 'images'));
    }

    // ====  STUCO
    public function stuco() {
        $stuco_banner = STUCO ::wherenull('deleted_by')->first();
        $stuco = STUCO ::wherenull('deleted_by')->get();
        return view('frontend.stuco', compact('stuco_banner','stuco'));
    }

    // ====  Service Learning
    public function service_learning() {
        $service_learning_banner = Service ::wherenull('deleted_by')->first();
        return view('frontend.service_learning', compact('service_learning_banner'));
    }

    // ====  Cafeteria
    public function cafeteria() {
        $cafeteria_banner = Cafeteria ::wherenull('deleted_by')->first();
        return view('frontend.cafeteria', compact('cafeteria_banner'));
    }

    // ====  Safety and Security
    public function safety_and_security() {
        $safety_and_security_banner = SafetySecurity ::wherenull('deleted_by')->first();
        return view('frontend.safety_and_security', compact('safety_and_security_banner'));
    }

    // ====  Bus Service
    public function bus_service() {
        $bus_service_banner = BusService ::wherenull('deleted_by')->first();
        return view('frontend.bus_service', compact('bus_service_banner'));
    }

    // ====  Other Facilities
    public function other_facilities() {
        $other_facilities_banner = OtherFacilities ::wherenull('deleted_by')->first();
        return view('frontend.other_facilities', compact('other_facilities_banner'));
    }

    // ====  University of Bath
    public function university_of_bath() {
        $university_of_bath_banner = UniversityBath ::wherenull('deleted_by')->first();
        return view('frontend.university_of_bath', compact('university_of_bath_banner'));
    }

    // ====  Career Opportunities
    public function career_opportunities() {
        $career_opportunities_banner = Career ::wherenull('deleted_by')->first();
        $job_opportunities = json_decode($career_opportunities_banner->teaching_details ?? '[]', true);
        return view('frontend.career_opportunities', compact('career_opportunities_banner','job_opportunities'));
    }

    // ====  Policies
    public function policies() {
        $policies_banner = Policy ::wherenull('deleted_by')->first();
        $job_opportunities = json_decode($policies_banner->documents ?? '[]', true);
        return view('frontend.policies', compact('policies_banner','job_opportunities'));
    }

    // ====  Teaching Job Opportunities
    public function teaching_job_opportunities() {
        $teaching_job_opportunities_banner = ManageTeachingJob ::wherenull('deleted_by')->first();
        return view('frontend.teaching_job_opportunities', compact('teaching_job_opportunities_banner'));
    }

    // ==== Teaching Job Opportunities Form
    public function teaching_job_opportunities_form(Request $request)
    {
        // ✅ Step 1: Get the last segment of the URL
        $categorySlug = $request->segment(count($request->segments()));


        // ✅ Step 1.1: Remove the last word (e.g., "form" from "teaching-job-opportunities-form")
        $slugParts = explode('-', $categorySlug);
        if (count($slugParts) > 1) {
            array_pop($slugParts); // remove last word
        }
        $cleanedSlug = implode('-', $slugParts);

        // ✅ Step 2: Fetch teaching categories from Career model
        $career = Career::first();
        $jobCategoryId = null;

        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);

            foreach ($decoded as $index => $item) {
                $slug = Str::slug($item['title']);

                if (Str::contains($cleanedSlug, $slug) || $slug === $cleanedSlug) {
                    $jobCategoryId = $index + 1;
                    break;
                }
            }
        }

        // ✅ Step 3: Get banner data
        $teaching_job_opportunities_banner = ManageTeachingJob::whereNull('deleted_by')->first();

        // ✅ Step 4: Fetch job postings based on matched category
        $teaching_job_opportunities_form_banner = collect();

        if ($jobCategoryId) {
            $teaching_job_opportunities_form_banner = JobPosting::where('job_category_id', $jobCategoryId)
                ->whereNull('deleted_by')
                ->get();
        } else {
            Log::warning('⚠️ No matching job category found even after cleanup', ['cleaned_slug' => $cleanedSlug]);
        }

        return view('frontend.teaching_job_opportunities_form', compact(
            'teaching_job_opportunities_form_banner',
            'teaching_job_opportunities_banner'
        ));
    }

    // ====  Non-Teaching Job Opportunities
    public function non_teaching_job_opportunities() {
        $non_teaching_job_opportunities_banner = ManageNonTeachingJob ::wherenull('deleted_by')->first();
        return view('frontend.non_teaching_job_opportunities', compact('non_teaching_job_opportunities_banner'));
    }

    // ==== Non-Teaching Job Opportunities Form
    public function non_teaching_job_opportunities_form(Request $request)
    {
        Log::info('🟢 Entered non_teaching_job_opportunities_form method.');

        // ✅ Step 1: Get the last segment of the URL
        $categorySlug = $request->segment(count($request->segments()));
        Log::info('📍 Raw category slug from URL', ['categorySlug' => $categorySlug]);

        // ✅ Step 1.1: Remove the last word
        $slugParts = explode('-', $categorySlug);
        if (count($slugParts) > 1) {
            array_pop($slugParts);
        }
        $cleanedSlug = implode('-', $slugParts);
        Log::info('🧹 Cleaned slug after removing last word', ['cleanedSlug' => $cleanedSlug]);

        // ✅ Step 1.2: Extract first 3 words
        $slugWords = explode('-', $cleanedSlug);
        $firstThree = implode(' ', array_slice($slugWords, 0, 3));
        $firstThreeSlug = implode('-', array_slice($slugWords, 0, 3));
        Log::info('🪄 Matching first 3 words', ['firstThree' => $firstThree, 'firstThreeSlug' => $firstThreeSlug]);

        // ✅ Step 2: Fetch non-teaching categories
        $career = Career::first();
        $jobCategoryId = null;

        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);
            if (is_array($decoded)) {
                foreach ($decoded as $index => $item) {
                    if (!isset($item['title'])) continue;

                    // Normalize strings — remove hyphens, multiple spaces
                    $title = strtolower(preg_replace('/[-\s]+/', ' ', $item['title']));
                    $slug = strtolower(preg_replace('/[-\s]+/', ' ', Str::slug($item['title'])));
                    $compareText = strtolower(preg_replace('/[-\s]+/', ' ', $firstThree));
                    $compareSlug = strtolower(preg_replace('/[-\s]+/', ' ', $firstThreeSlug));

                    Log::debug('🔍 Comparing normalized text', [
                        'title' => $title,
                        'slug' => $slug,
                        'compareText' => $compareText,
                        'compareSlug' => $compareSlug
                    ]);

                    // ✅ Match if normalized text matches partially
                    if (
                        str_contains($title, $compareText) ||
                        str_contains($slug, $compareSlug)
                    ) {
                        $jobCategoryId = $index + 1;
                        Log::info('✅ Match found using normalized comparison', [
                            'matched_title' => $item['title'],
                            'jobCategoryId' => $jobCategoryId
                        ]);
                        break;
                    }
                }
            } else {
                Log::warning('⚠️ non_teaching_details is not a valid JSON array');
            }
        } else {
            Log::warning('⚠️ No non_teaching_details found in Career model or Career record missing');
        }

        // ✅ Step 3: Get banner data
        $non_teaching_job_opportunities_banner = ManageTeachingJob::whereNull('deleted_by')->first();

        // ✅ Step 4: Fetch job postings
        $non_teaching_job_opportunities_form_banner = collect();

        if ($jobCategoryId) {
            $non_teaching_job_opportunities_form_banner = JobPosting::where('job_category_id', $jobCategoryId)
                ->whereNull('deleted_by')
                ->get();

            Log::info('📋 Job postings fetched successfully', [
                'jobCategoryId' => $jobCategoryId,
                'count' => $non_teaching_job_opportunities_form_banner->count()
            ]);
        } else {
            Log::warning('⚠️ No matching non-teaching job category found', [
                'firstThreeSlug' => $firstThreeSlug
            ]);
        }

        // ✅ Step 5: Return correct variables
        Log::info('🚀 Returning non_teaching_job_opportunities_form view');
        return view('frontend.non_teaching_job_opportunities_form', compact(
            'non_teaching_job_opportunities_form_banner',
            'non_teaching_job_opportunities_banner'
        ));
    }

    // ====  IB Learner Profile
    public function ib_learner_profile() {
        $ib_learner_profile_banner = ManageLearnerProfile ::wherenull('deleted_by')->first();
        $ib_learner_profile = ManageLearnerProfile ::wherenull('deleted_by')->get();
        return view('frontend.ib_learner_profile', compact('ib_learner_profile_banner','ib_learner_profile'));
    }

    // ====  Student Support Services
    public function student_support_services() {
        $student_support_services_banner = StudentSupport ::wherenull('deleted_by')->first();
        return view('frontend.student_support_services', compact('student_support_services_banner'));
    }

    // ====  Student Support Services
    public function college_counselling() {

        $college_counselling_banner = UniversityPage ::wherenull('deleted_by')->first();

        // Controller: Fetch colleges with country join
        $colleges = UniversityColleges::select(
                'university_college_counselling.*',
                'countries.name as country_name'
            )
            ->join('countries', 'university_college_counselling.country_id', '=', 'countries.id')
            ->whereNull('university_college_counselling.deleted_by')
            ->get();


        // Only include countries that have at least one university
        $availableCountries = DB::table('university_college_counselling')
                    ->join('countries', 'university_college_counselling.country_id', '=', 'countries.id')
                    ->whereNull('university_college_counselling.deleted_by')
                    ->select('countries.id', 'countries.name')
                    ->distinct()
                    ->get();

        return view('frontend.college_counselling', compact('college_counselling_banner','colleges','availableCountries'));
    }

    // ====  Curriculum Overview
    public function curriculum_overview() {
        $curriculum_overview_banner = Curriculum ::wherenull('deleted_by')->first();
        return view('frontend.curriculum_overview', compact('curriculum_overview_banner'));
    }

    // ==== IB Primary Years Programme
    public function primary_years_programme() {
        $curriculum_overview_banner = Curriculum ::wherenull('deleted_by')->first();
        $primary_banner = IBPrimary ::wherenull('deleted_by')->first();
        return view('frontend.primary_years_programme', compact('curriculum_overview_banner','primary_banner'));
    }

    // ==== IB Middle Years Programme
    public function middle_years_programme() {
        $curriculum_overview_banner = Curriculum ::wherenull('deleted_by')->first();
        $primary_banner = IBMiddle ::wherenull('deleted_by')->first();
        return view('frontend.middle_years_programme', compact('curriculum_overview_banner','primary_banner'));
    }

    // ==== IB Diploma Programme
    public function diploma_programme() {
        $curriculum_overview_banner = Curriculum ::wherenull('deleted_by')->first();
        $primary_banner = IBDiploma ::wherenull('deleted_by')->first();
        return view('frontend.diploma_programme', compact('curriculum_overview_banner','primary_banner'));
    }

    // ====  Creativity, Activity, Service
    public function cas_service_programme() {
        $cas_service_programme_banner = CreativityActivity ::wherenull('deleted_by')->first();
        $cas_service_programme = CreativityActivity ::wherenull('deleted_by')->get();
        return view('frontend.cas_service_programme', compact('cas_service_programme_banner','cas_service_programme'));
    }

    // ====  Creativity, Activity, Service Detail Page
    public function creativity_detail($slug)
    {
        $activity = CreativityActivity::where('detailed_sections', 'like', '%"slug":"' . $slug . '"%')
            ->whereNull('deleted_by')
            ->first();

        return view('frontend.creativity_detail', compact('activity'));
    }

    // ==== IB Early Years & Primary Years Programme
    public function ib_pyp_schools_mumbai() {
        $cib_pyp_schools_mumbai_banner = Pyp ::wherenull('deleted_by')->first();
        return view('frontend.ib_pyp_schools_mumbai', compact('cib_pyp_schools_mumbai_banner'));
    }

    // ==== IB Middle Years Programme
    public function ib_myp_schools_mumbai() {
        $ib_myp_schools_mumbai_banner = Myp ::wherenull('deleted_by')->first();
        return view('frontend.ib_myp_schools_mumbai', compact('ib_myp_schools_mumbai_banner'));
    }

    // ==== IB Diploma Programme
    public function ib_diploma_school_mumbai() {
        $ib_diploma_school_mumbai_banner = Diploma ::wherenull('deleted_by')->first();
        return view('frontend.ib_diploma_school_mumbai', compact('ib_diploma_school_mumbai_banner'));
    }

    // ====  Bulletin Board
    public function bulletin_board(Request $request) {

        // Search keyword
        $search = $request->input('search');
        $tag = $request->input('tag');

        // Fetch all bulletins, apply search filter if exists
        $bulletin_board = BulletinListing::with('category')
                        ->whereNull('deleted_by')
                        ->when($search, function($query, $search) {
                            $query->where(function($q) use ($search) {
                                $q->where('article_name', 'like', "%{$search}%")
                                  ->orWhere('short_desc', 'like', "%{$search}%");
                            });
                        })
                        ->when($tag, function($query, $tag) {
                            $query->whereRaw("FIND_IN_SET(?, special_tags)", [$tag]);
                        })
                        ->orderBy('inserted_at', 'asc')
                        ->get();
        // dd($bulletin_board);

        $bulletin_categories = BulletinCategory::withCount(['listings'])->whereNull('deleted_by')->get();

        $recent_posts = BulletinListing::whereNull('deleted_by')
                        ->orderBy('inserted_at', 'desc')
                        ->take(5)
                        ->get();
        return view('frontend.bulletin_board', compact('bulletin_board','bulletin_categories','recent_posts'));
    }

    // // ====  Bulletin Board Category
    public function bulletin_board_category_list(Request $request, $slug) {

        // Get category
        $category = BulletinCategory::where('slug', $slug)
                    ->whereNull('deleted_by')
                    ->firstOrFail();

        // Search keyword
        $search = $request->input('search');
        $tag = $request->input('tag');

        // dd($tag);

        // Get bulletins for this category
        $bulletin_board_category_list = BulletinListing::where('category_id', $category->id)
                    ->whereNull('deleted_by')
                    ->when($search, function($query, $search) {
                        // Apply filter only if search term exists
                        $query->where(function($q) use ($search) {
                            $q->where('article_name', 'like', "%{$search}%")
                            ->orWhere('short_desc', 'like', "%{$search}%");
                        });
                    })
                    ->when($tag, function($query, $tag) {
                        $query->whereRaw("FIND_IN_SET(?, special_tags)", [$tag]);
                    })
                    ->orderBy('inserted_at', 'asc')
                    ->get();

        // dd($bulletin_board_category_list);

        // Recent posts (latest 5 in this category)
        $recent_posts = BulletinListing::where('category_id', $category->id)
                            ->whereNull('deleted_by')
                            ->orderBy('inserted_at', 'desc')
                            ->take(5)
                            ->get();

        // All categories
        $bulletin_categories = BulletinCategory::withCount(['listings'])->whereNull('deleted_by')->get();

        return view('frontend.bulletin_board_category_list', compact(
            'category',
            'bulletin_board_category_list',
            'bulletin_categories',
            'recent_posts',
            'search'
        ));
    }

    // ==== Bulletin Board Details
    public function bulletin_board_details($category_slug, $article_slug)
    {
        // Fetch category first
        $category = BulletinCategory::where('slug', $category_slug)
                    ->whereNull('deleted_by')
                    ->firstOrFail();

        // Fetch article details from BulletinDetails table
        $article = BulletinListing::where('slug', $article_slug)
                    ->where('category_id', $category->id)
                    ->whereNull('deleted_by')
                    ->firstOrFail();
        // dd($article);

         // Optional: fetch recent posts for the sidebar from BulletinDetails
        $bulletin_details = BulletinDetails::where('category_id', $category->id)
                            ->where('article_id', $article->id) 
                            ->whereNull('deleted_by')
                            ->first();
        // dd($bulletin_details);

        // Optional: fetch recent posts for the sidebar from BulletinDetails
        $recent_posts = BulletinDetails::where('category_id', $category->id)
                            ->whereNull('deleted_by')
                            ->orderBy('inserted_at', 'desc')
                            ->take(5)
                            ->get();

        return view('frontend.bulletin_board_details', compact('category', 'article', 'recent_posts','bulletin_details'));
    }







}