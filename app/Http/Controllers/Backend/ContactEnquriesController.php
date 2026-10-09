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
use App\Models\ContactEnquiry;


class ContactEnquriesController extends Controller
{

    public function index(Request $request)
    {
        $query = ContactEnquiry::orderBy('id', 'desc');
    
        // Apply form type filter (AJAX)
        if ($request->filled('form_type')) {
            $query->where('form_type', $request->form_type);
        }
    
        $enquiries = $query->get()->groupBy('form_type');
    
        // 🔹 AJAX RESPONSE (HTML STRING)
        if ($request->ajax()) {
    
            $html = '';
    
            foreach ($enquiries as $formType => $items) {
    
                // Group heading
                $title = $formType == 1 ? 'Contact Enquiries' : 'Admission Enquiries';
    
                $html .= '
                    <tr class="table-secondary text-center">
                        <td colspan="7" class="fw-bold">'.$title.'</td>
                    </tr>
                ';
    
                foreach ($items as $key => $item) {
    
                    $viewUrl = route('manage-contact-view.show', $item->id);
                    $pdfUrl  = route('contact-application.pdf', $item->id);
    
                    $html .= '
                        <tr>
                            <td>'.($key + 1).'</td>
                            <td>'.($item->name ?? '-').'</td>
                            <td>'.($item->email ?? '-').'</td>
                            <td>'.($item->phone ?? '-').'</td>
                            <td>'.ucfirst($item->enquiry_type ?? '-').'</td>
                            <td>'.(
                                $item->inserted_at
                                    ? \Carbon\Carbon::parse($item->inserted_at)->format('d M Y, h:i A')
                                    : '-'
                                ).'
                            </td>
                            <td>
                                <a href="'.$viewUrl.'" class="btn btn-sm btn-primary">View</a><br><br>
                                <a href="'.$pdfUrl.'" class="btn btn-danger btn-sm">PDF</a>
                            </td>
                        </tr>
                    ';
                }
            }
    
            // No records at all
            if ($enquiries->count() === 0) {
                $html = '
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No records found.
                        </td>
                    </tr>
                ';
            }
    
            return response()->json([
                'html' => $html
            ]);
        }
    
        // 🔹 NORMAL PAGE LOAD
        return view('backend.contact_enquiries.index', compact('enquiries'));
    }
    
    
    public function show($id)
    {
        $contact = ContactEnquiry::findOrFail($id);
    
        // 🔹 Convert form_type to readable text
        $formType = $contact->form_type == 1
            ? 'Contact Form'
            : ($contact->form_type == 2 ? 'Home Admission' : 'Other');
    
        return view(
            'backend.contact_enquiries.show',
            compact('contact', 'formType')
        );
    }
    
    
    public function downloadPDF($id)
    {
        // Fetch record
        $admission = ContactEnquiry::findOrFail($id);
    
        // Form type label
        $formType = $admission->form_type == 1
            ? 'Contact Enquiry'
            : 'Admission Enquiry';
    
        // Load PDF view
        $pdf = Pdf::loadView(
            'backend.contact_enquiries.pdf',
            compact('admission', 'formType')
        )->setPaper('A4', 'portrait');
    
        return $pdf->stream('contact_'.$admission->id.'.pdf');
    }

}