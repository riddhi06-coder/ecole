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
use App\Models\AdmissionDetails;


class AdmissionEnquiriesController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table('admission_details as a')
            ->leftJoin('countries as c', 'a.country_id', '=', 'c.id')
            ->leftJoin('grades as g', 'a.join_grade', '=', 'g.id')
            ->whereNull('a.deleted_by')
            ->select(
                'a.id',
                'a.student_name',
                'a.dob',
                'a.present_school',
                'a.join_grade',
                'a.grade',
                'a.year',
                'a.form_type',
                'c.name as country_name',
                'c.nationality as nationality_name',
                'g.grade as join_grade_name'
            );

        // 🔹 Filter by form_type if passed via AJAX
        if ($request->ajax() && $request->has('form_type') && $request->form_type != '') {
            $query->where('a.form_type', $request->form_type);
        }

        $admission = $query->get();

        // 🔹 Return HTML if it's an AJAX call
        if ($request->ajax()) {
            $html = '';
            foreach ($admission as $key => $item) {
                $html .= '<tr>
                    <td>'.($key + 1).'</td>
                    <td>'.($item->student_name ?? '-').'</td>
                    <td>'.($item->dob ? \Carbon\Carbon::parse($item->dob)->format('d M, Y') : '-').'</td>
                    <td>'.($item->present_school ?? '-').'</td>
                    <td>'.($item->join_grade_name ?? '-').'</td>
                    <td>'.($item->country_name ?? '-').'</td>
                    <td>'.($item->nationality_name ?? '-').'</td>
                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                </tr>';
            }

            if (count($admission) === 0) {
                $html = '<tr><td colspan="8" class="text-center">No records found.</td></tr>';
            }

            return response()->json(['html' => $html]);
        }

        return view('backend.addmission_enquiries.index', compact('admission'));
    }


    public function create(Request $request)
    {
        return view('backend.addmission_enquiries.create');
    }
}