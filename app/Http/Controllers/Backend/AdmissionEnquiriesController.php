<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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
            ->orderBy('a.inserted_at', 'desc')
            ->select(
                'a.id',
                'a.student_name',
                'a.dob',
                'a.inserted_at',
                'a.present_school',
                'a.join_grade',
                'a.grade',
                'a.year',
                'a.form_type',
                'a.payment_status',
                 'a.application_status',
                'a.order_status',
                'c.name as country_name',
                'c.nationality as nationality_name',
                'g.grade as join_grade_name'
            );
    
        // ðŸ”¹ Apply filter
        if ($request->ajax() && $request->filled('form_type')) {
            $query->where('a.form_type', $request->form_type);
        }
    
        $admission = $query->get();
    
        // ðŸ”¹ AJAX RESPONSE
        if ($request->ajax()) {
    
            if ($admission->isEmpty()) {
                return response()->json([
                    'html' => '<tr>
                        <td colspan="7" class="text-center text-muted">
                            No records found.
                        </td>
                    </tr>'
                ]);
            }
    
            $grouped = $admission->groupBy('form_type');
            $html = '';
            $counter = 1;
    
            foreach ($grouped as $formTypeKey => $items) {
    
                // Form Type Heading
                $formTypeName =
                    $formTypeKey == 1 ? 'Application for Admission' :
                    ($formTypeKey == 2 ? 'Schedule a Visit' :
                    ($formTypeKey == 3 ? 'Enquiry for Admission' : 'Other'));
    
                $html .= '
                    <tr class="table-primary">
                        <td colspan="8" class="fw-bold text-center">'.$formTypeName.'</td>
                    </tr>
                ';
    
                foreach ($items as $item) {
    
                    // Payment badge
                    if ($item->payment_status === 'Paid') {
                        $paymentBadge = '<span class="badge bg-success">Paid</span>';
                    } elseif ($item->payment_status === 'Failed') {
                        $paymentBadge = '<span class="badge bg-danger">Failed</span>';
                    } elseif ($item->payment_status === 'Cancelled') {
                        $paymentBadge = '<span class="badge bg-warning">Cancelled</span>';
                    } elseif ($item->payment_status) {
                        $paymentBadge = '<span class="badge bg-secondary">'.$item->payment_status.'</span>';
                    } else {
                        $paymentBadge = '<span class="badge bg-secondary">NA</span>';
                    }
                    
                    
                    /* ================= APPLICATION STATUS (NEW) ================= */
                    if (!empty($item->application_status)) {
                        switch ($item->application_status) {
                            case 'Viewed':
                                $appBadge = '<span class="badge bg-info">Viewed</span>';
                                break;
                            case 'Under Review':
                                $appBadge = '<span class="badge bg-warning text-dark">Under Review</span>';
                                break;
                            case 'Processed':
                                $appBadge = '<span class="badge bg-primary">Processed</span>';
                                break;
                            default:
                                $appBadge = '<span class="badge bg-secondary">'.$item->application_status.'</span>';
                        }
                    } else {
                        $appBadge = '<span class="badge bg-secondary">Status: NA</span>';
                    }


    
                    $viewUrl = route('manage-addmission-enquiries.show', $item->id);
                    $pdfUrl  = route('admission.pdf', $item->id);
    
                    $html .= '
                        <tr>
                            <td>'.$counter++.'</td>
                            <td>'.($item->student_name ?? '-').'</td>
                            <td>'.($item->join_grade_name ?? '-').'</td>
                            <td>'.($item->country_name ?? '-').'</td>
                            <td>'.
                                ($item->inserted_at
                                    ? Carbon::parse($item->inserted_at)->format('d M Y, h:i A')
                                    : '-'
                                ).'
                            </td>
                            <td>'.$paymentBadge.'</td>
                            <td>'.$appBadge.'</td>
                            <td>
                                <a href="'.$viewUrl.'" class="btn btn-primary btn-sm">View</a>
                                <a href="'.$pdfUrl.'" class="btn btn-danger btn-sm" target="_blank">PDF</a>
                            </td>
                        </tr>
                    ';
                }
            }
    
            return response()->json(['html' => $html]);
        }
    
        // ðŸ”¹ Normal page load
        return view('backend.addmission_enquiries.index', compact('admission'));
    }
    
    

    public function show($id)
    {
        $admission = DB::table('admission_details as a')
            ->leftJoin('countries as c', 'a.country_id', '=', 'c.id')
            ->leftJoin('grades as g', 'a.join_grade', '=', 'g.id')
            ->where('a.id', $id)
            ->select(
                'a.id',
                'a.student_name',
                'a.dob',
                'a.address',
                'a.city',
                'a.pincode',
                'a.present_school',
                'a.grade',
                'a.join_grade',
                'a.year',
                'a.utm',
                'a.form_type',
                'a.application_status',

                'a.father_details',
                'a.mother_details',
                'a.passport_type',
                'a.foregin_passport_type',
                'a.specific_learning',
                'a.heard_from',
                'a.wish_you_know',
                'c.name as country_name',
                'c.nationality as nationality_name',
                'g.grade as join_grade_name',
                
                
                'a.order_id',
                'a.t_id',
                'a.amount',
                'a.billing_name',
                'a.billing_address',
                'a.billing_city',
                'a.billing_state',
                'a.billing_zip',
                'a.billing_country',
                'a.billing_phone',
                'a.billing_email',
                'a.shipping_name',
                'a.shipping_address',
                'a.shipping_city',
                'a.shipping_state',
                'a.shipping_zip',
                'a.shipping_country',
                'a.shipping_phone',
                'a.shipping_email',
                'a.payment_status',
                'a.tracking_id',
                'a.bank_ref_no',
                'a.payment_mode',
                'a.order_status',
                'a.status_message',
                'a.currency',
        
            )
            ->first();
            
        

        if (!$admission) {
            abort(404, 'Admission record not found.');
        }

        return view('backend.addmission_enquiries.show', compact('admission'));
    }
    
    
    public function generatePdf($id)
    {
        $admission = DB::table('admission_details as a')
            ->leftJoin('countries as c1', 'c1.id', '=', 'a.country_id')
            ->leftJoin('countries as c2', 'c2.id', '=', 'a.nationality_id')
    
            // 👉 JOIN grades table for GRADE TO JOIN
            ->leftJoin('grades as g', 'g.id', '=', 'a.join_grade')
    
            ->where('a.id', $id)
            ->select(
                'a.*',
                'c1.name as country_name',
                'c2.name as nationality_name',
    
                // ✅ Grade to Join from DB
                'g.grade as join_grade_text',
    
                // ✅ Present Grade (STATIC mapping)
                DB::raw("
                    CASE a.grade
                        WHEN '1' THEN 'Playschool'
                        WHEN '2' THEN 'Nursery'
                        WHEN '3' THEN 'Kindergarten 1'
                        WHEN '4' THEN 'Kindergarten 2'
                        WHEN '5' THEN 'Grade 1'
                        WHEN '6' THEN 'Grade 2'
                        WHEN '7' THEN 'Grade 3'
                        WHEN '8' THEN 'Grade 4'
                        WHEN '9' THEN 'Grade 5'
                        WHEN '10' THEN 'Grade 6'
                        WHEN '11' THEN 'Grade 7'
                        WHEN '12' THEN 'Grade 8'
                        WHEN '13' THEN 'Grade 9'
                        WHEN '14' THEN 'Grade 10'
                        WHEN '15' THEN 'Grade 11'
                        WHEN '16' THEN 'Grade 12'
                        WHEN '17' THEN 'Not Applicable'
                        ELSE '-'
                    END AS grade_text
                ")
            )
            ->first();
    
        if (!$admission) {
            abort(404);
        }
    
        $formType = match ((string) $admission->form_type) {
            '1' => 'Application for Admission',
            '2' => 'Schedule a Visit',
            '3' => 'Enquiry for Admission',
            default => 'Other',
        };
    
        $pdf = Pdf::loadView(
            'backend.addmission_enquiries.pdf',
            compact('admission', 'formType')
        )->setPaper('A4', 'portrait');
    
        return $pdf->stream($admission->student_name.'_'.$admission->id.'.pdf');
    }

    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Viewed,Under Review,Processed',
        ]);
    
        DB::table('admission_details')
            ->where('id', $id)
            ->update([
                'application_status' => $request->status,
                'modified_at' => now(),
            ]);
    
        return back()->with('message', 'Status updated successfully.');
    }




}