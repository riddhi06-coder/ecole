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







}