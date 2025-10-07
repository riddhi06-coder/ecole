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
        $universities = DB::table('university_college_counselling as u')
            ->leftJoin('countries as c', 'u.country_id', '=', 'c.id')
            ->whereNull('u.deleted_by')
            ->select('u.*', 'c.name as country_name')
            ->get();
            
        return view('backend.academics.university.universities.index', compact('universities'));
    }


    public function create(Request $request)
    {
        $countries = DB::table('countries')->get();
        return view('backend.academics.university.universities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'universities' => 'required|array|min:1',
            'universities.*.name' => 'required|string|max:255',
            'universities.*.url' => 'nullable|url|max:255',
        ], [
            'country_id.required' => 'Please select a country.',
            'country_id.exists' => 'Selected country does not exist.',
            'universities.required' => 'Please add at least one university.',
            'universities.*.name.required' => 'University name is required.',
            'universities.*.url.url' => 'Please enter a valid URL.',
        ]);

        try {
            // ✅ Extract and encode names + URLs
            $names = [];
            $urls = [];

            foreach ($validated['universities'] as $uni) {
                $names[] = $uni['name'];
                $urls[] = $uni['url'] ?? null;
            }

            // ✅ Save using Model
            UniversityColleges::create([
                'country_id'  => $validated['country_id'],
                'name'        => json_encode($names, JSON_UNESCAPED_UNICODE),
                'url'         => json_encode($urls, JSON_UNESCAPED_UNICODE),
                'status'      => 1,
                'created_by'  => Auth::id(),
                'created_at'  => Carbon::now(),
            ]);

            return redirect()
                ->route('manage-universities.index')
                ->with('message', 'University details added successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}