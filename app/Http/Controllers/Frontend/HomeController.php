<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
        // dd($programmes);
        return view('frontend.home', compact('home','programmes','festivities','features','bulletin','testimonials','clients'));
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

    







}