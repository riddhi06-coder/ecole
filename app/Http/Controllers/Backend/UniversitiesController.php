<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UniversityColleges;
use App\Models\Universities;

class UniversitiesController extends Controller
{

    public function index()
    {
        return view('backend.academics.university.universities.index');
    }

    public function create(Request $request)
    {
        $countries = DB::table('countries')->get();
        return view('backend.academics.university.universities.create', compact('countries'));
    }

}