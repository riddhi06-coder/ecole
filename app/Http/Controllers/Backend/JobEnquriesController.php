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
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use App\Models\User;
use App\Models\TeachingApplication;


class JobEnquriesController extends Controller
{

    public function index(Request $request)
    {
        $career = DB::table('career_page')->first();
        $titles = [];
        if ($career && $career->teaching_details) {
            $titles = json_decode($career->teaching_details, true);
        }
    
        // Fetch all teaching applications with job details
        
        $query = DB::table('teaching_applications as a')
            ->leftJoin('countries as c', 'a.nationality_id', '=', 'c.id')
            ->leftJoin('job_posting as j', 'a.position_applied', '=', 'j.id') 
            ->whereNull('a.deleted_by')
            ->orderby('id','desc')
            ->select(
                'a.*',
                'c.name as country_name',
                'c.nationality as nationality_name',
                'j.job_roles as job_role'
            );
    
        // ✅ Filter by Application Date (last X days)
        if ($request->has('application_days') && is_numeric($request->application_days)) {
            $days = (int) $request->application_days;
            $query->where('a.created_at', '>=', now()->subDays($days));
        }
    
        $query = $query->orderBy('a.created_at', 'desc')->get();
            
        /// Get distinct values for dropdown filters
        $genders = DB::table('teaching_applications')
            ->whereNotNull('gender')
            ->distinct()
            ->pluck('gender');
    
        $nationalities = DB::table('teaching_applications as a')
            ->leftJoin('countries as c', 'a.nationality_id', '=', 'c.id')
            ->whereNotNull('c.nationality')
            ->distinct()
            ->pluck('c.nationality');
    
        $maritalStatuses = DB::table('teaching_applications')
            ->whereNotNull('marital_status')
            ->distinct()
            ->pluck('marital_status');
    
        $noticePeriods = DB::table('teaching_applications')
            ->whereNotNull('notice_period')
            ->distinct()
            ->pluck('notice_period');
    
        $salaries = DB::table('teaching_applications')
        ->whereNotNull('current_salary')
        ->distinct()
        ->pluck('current_salary');
    
    
        $expected_salary = DB::table('teaching_applications')
            ->whereNotNull('expected_salary')
            ->distinct()
            ->pluck('expected_salary');
            
            
        $roleIds = DB::table('teaching_applications')
            ->whereNotNull('position_applied')
            ->distinct()
            ->pluck('position_applied');
            
        $roles = DB::table('job_posting')
            ->whereIn('id', $roleIds)
            ->whereNull('deleted_by')
            ->pluck('job_roles', 'id');  


    
    
        return view('backend.job_enquiries.index', compact('query', 'titles', 'genders', 'nationalities',
                    'maritalStatuses', 'noticePeriods', 'salaries','expected_salary','roles'));
    }

    public function show($id)
    {
        // Fetch the application details
        $application = DB::table('teaching_applications as a')
            ->leftJoin('countries as c', 'a.nationality_id', '=', 'c.id')
            ->leftJoin('job_posting as j', 'a.position_applied', '=', 'j.id')
            ->where('a.id', $id)
            ->select(
                'a.*',
                'c.name as country_name',
                'c.nationality as nationality_name',
                'j.job_roles as job_role'
            )
            ->first();

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }

        // Pass the application to the view
        return view('backend.job_enquiries.show', compact('application'));
    }
    
    public function downloadPDF($id)
    {
    $application = \DB::table('teaching_applications as a')
        ->leftJoin('countries as c', 'a.nationality_id', '=', 'c.id')
        ->leftJoin('job_posting as j', 'a.position_applied', '=', 'j.id')
        ->whereNull('a.deleted_by')
        ->where('a.id', $id)
        ->select(
            'a.*',
            'c.name as country_name',
            'c.nationality as nationality_name',
            'j.job_roles as job_role'
        )
        ->first();

    if (!$application) {
        abort(404, 'Application not found.');
    }

    // Decode all JSON fields
    $jsonFields = [
        'education',
        'pd_courses_attended',
        'pd_courses_conducted',
        'publications',
        'referees'
    ];

    foreach ($jsonFields as $field) {
        if (!empty($application->$field)) {
            $decoded = json_decode($application->$field, true);
            if (is_string($decoded)) {
                $decoded = json_decode(stripslashes($decoded), true);
            }
            $application->$field = is_array($decoded) ? $decoded : [];
        } else {
            $application->$field = [];
        }
    }

    $pdf = \PDF::loadView('backend.job_enquiries.job_application_pdf', compact('application'))
        ->setPaper('a4', 'portrait')
        ->setOptions(['isRemoteEnabled' => true]);

    $fileName = 'Application_' . $application->name . '_' . now()->format('d-m-Y') . '.pdf';

    return $pdf->stream($fileName);
}


}