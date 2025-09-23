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





}