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





}