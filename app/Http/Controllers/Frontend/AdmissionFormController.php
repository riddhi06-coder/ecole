<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\AdmissionDetails;
use App\Models\Grades;

class AdmissionFormController extends Controller
{

    public function store(Request $request)
    {
        // dd($request);


        // ✅ Step 0: Verify Google reCAPTCHA
        // $captcha = $request->input('g-recaptcha-response');
        // if (!$captcha) {
        //     return redirect()->back()->with('admission_captcha', 'Please verify that you are not a robot.')->withInput();
        // }

        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $captcha,
        //     'remoteip' => $request->ip(),
        // ]);
        

        // $result = $response->json();
        // if (empty($result['success']) || $result['success'] !== true) {
        //     return redirect()->back()->with('admission_captcha', 'Captcha verification failed. Please try again.')->withInput();
        // }


        try {
            // ✅ Step 0: Convert form_type text to numeric value
            $formTypeMap = [
                'apply_for_admission' => 1,
                'schedule_a_visit' => 2,
                'enquiry_form' => 3,
            ];

            // Default to 1 if invalid or not provided
            $formType = $formTypeMap[$request->input('form_type')] ?? $request->input('form_type');

            // ✅ Step 1: Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'dob' => 'required|date',
                'address' => 'required|string|max:500',
                'country' => 'required|integer|exists:countries,id',
                'city' => 'required|string|max:255',
                'pincode' => 'required|integer',
                'present_school' => 'required|string|max:255',
                'grade' => 'required|string',
                'join_grade' => 'required|string',
                'year' => 'required|string',
                'nationality' => 'required|integer|exists:countries,id',

                // Father Details
                'f_name' => 'required|string|max:255',
                'f_mobile' => 'required|string|max:20',
                'f_mobile_code' => 'nullable|string|max:10',
                'f_occupation' => 'required|string|max:255',
                'f_designation' => 'required|string|max:255',
                'f_organization' => 'required|string|max:255',
                'f_email' => 'required|email|max:255',
                'f_offtel' => 'required|string|max:20',
                'f_offtel_code' => 'nullable|string|max:10',
                'f_offadd' => 'required|string|max:500',

                // Mother Details
                'm_name' => 'required|string|max:255',
                'm_mobile' => 'required|string|max:20',
                'm_mobile_code' => 'nullable|string|max:10',
                'm_occupation' => 'required|string|max:255',
                'm_designation' => 'required|string|max:255',
                'm_organization' => 'required|string|max:255',
                'm_email' => 'required|email|max:255',
                'm_offtel' => 'required|string|max:20',
                'm_offtel_code' => 'nullable|string|max:10',
                'm_offadd' => 'required|string|max:500',

                // Other Info
                'passport_type' => 'required|in:1,2',
                'foregin_passport_type' => 'nullable|in:1,2,3',
                'specific_learning' => 'nullable|string|max:500',
                'heard_from' => 'required|string|max:255',
                'wish_you_know' => 'nullable|string|max:500',
            ]);


            // ✅ Step 2: Store data in DB
            $admission = new AdmissionDetails();
            $admission->form_type = $formType;
            $admission->student_name = $validated['name'];
            $admission->dob = $validated['dob'];
            $admission->address = $validated['address'];
            $admission->country_id = $validated['country'];
            $admission->city = $validated['city'];
            $admission->pincode = $validated['pincode'];
            $admission->present_school = $validated['present_school'];
            $admission->grade = $validated['grade'];
            $admission->join_grade = $validated['join_grade'];
            $admission->year = $validated['year'];
            $admission->nationality_id = $validated['nationality'];

            // ✅ Father details
            $admission->father_details = json_encode([
                'name' => $validated['f_name'],
                'mobile_code' => $validated['f_mobile_code'] ?? '',
                'mobile' => $validated['f_mobile'],
                'occupation' => $validated['f_occupation'],
                'designation' => $validated['f_designation'],
                'organization' => $validated['f_organization'],
                'email' => $validated['f_email'],
                'offtel_code' => $validated['f_offtel_code'] ?? '',
                'offtel' => $validated['f_offtel'],
                'offadd' => $validated['f_offadd'],
            ]);

            // ✅ Mother details
            $admission->mother_details = json_encode([
                'name' => $validated['m_name'],
                'mobile_code' => $validated['m_mobile_code'] ?? '',
                'mobile' => $validated['m_mobile'],
                'occupation' => $validated['m_occupation'],
                'designation' => $validated['m_designation'],
                'organization' => $validated['m_organization'],
                'email' => $validated['m_email'],
                'offtel_code' => $validated['m_offtel_code'] ?? '',
                'offtel' => $validated['m_offtel'],
                'offadd' => $validated['m_offadd'],
            ]);

            // ✅ Other Info
            $admission->passport_type = $validated['passport_type'];
            $admission->foregin_passport_type = $validated['foregin_passport_type'] ?? null;
            $admission->specific_learning = $validated['specific_learning'] ?? null;
            $admission->heard_from = $validated['heard_from'];
            $admission->wish_you_know = $validated['wish_you_know'] ?? null;

            $admission->inserted_at = Carbon::now();

            $admission->save();


            // ✅ Step 3: Prepare data for email
            $gradeName = Grades::where('id', $admission->join_grade)->value('grade'); // This returns only the grade name


            // ✅ Step 3: Trigger Email
            $data = [
                'student_name' => $admission->student_name,
                'father_name' => $validated['f_name'],
                'mother_name' => $validated['m_name'],
                'grade'        => $gradeName ?? 'N/A',
                'form_type' => $request->input('form_type'),
            ];

            // 💡 Define dynamic headings and subjects
            $formType = $request->input('form_type');
            $subjectMap = [
                1 => 'Application for Admission',
                2 => 'Request for Scheduling a Visit',
                3 => 'Enquiry for Admission',
            ];

            $subject = $subjectMap[$formType] ?? 'New Admission Enquiry';
            $data['subject'] = $subject; 

            Mail::send('frontend.admission_mail', $data, function ($message) use ($validated, $subject) {
                $message->to('riddhi@matrixbricks.com')
                        ->from($validated['f_email'], $validated['f_name'])
                        ->subject('Thank you for your ' . $subject . '!');
            });

            // ✅ Step 4: Redirect
            return redirect()->route('thank.you')->with('success', 'Admission form submitted successfully!');


        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (Exception $e) {
            Log::error('❌ Unexpected error while submitting admission form.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong. Please try again.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



}
