<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


use App\Models\TeachingApplication;
use App\Models\ContactEnquiry;


class TeachingFormController extends Controller
{
    
    public function teaching_store(Request $request)
    {
      
        Log::info('Teaching form submission started', [
            'ip' => $request->ip(),
            'email' => $request->email,
            'apply' => $request->apply,
        ]);
        
        
        /* ---------------- CAPTCHA VALIDATION ---------------- */
            $request->validate([
                'g-recaptcha-response' => 'required'
            ], [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.'
            ]);
            
            $captcha   = $request->input('g-recaptcha-response');
            $secretKey = config('services.recaptcha.secret_key');
            $ip        = $request->ip();
            
            $verifyResponse = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => $secretKey,
                    'response' => $captcha,
                    'remoteip' => $ip
                ]
            );
            
            $captchaResult = $verifyResponse->json();
            
            if (empty($captchaResult['success'])) {
                Log::warning('Captcha verification failed', [
                    'ip' => $ip,
                    'response' => $captchaResult
                ]);
            
                return back()
                    ->withErrors(['captcha' => 'Captcha verification failed. Please try again.'])
                    ->withInput();
            }
            
            Log::info('Captcha verified successfully');
            /* ---------------------------------------------------- */
            
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'mobile_no' => 'required|min:10|max:15',
            'position_applied' => 'required',
            'utm'=> 'nullable|string|max:2000',
            'gender' => 'required',
            'photo_upload' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);
    
        if ($validator->fails()) {
            
            Log::warning('Teaching form validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
        
            return back()->withErrors($validator)->withInput();
        }
    
        Log::info('Teaching form validation passed');
     
        try {
            // -----------------------------------------------------------
            // 🔥 Convert "apply" text to numeric value (your requirement)
            // -----------------------------------------------------------
            $applyValue = 1;  // default for Teaching Job Opportunities
    
            if ($request->apply == "Teaching Job Opportunities") {
                $applyValue = 1;
            } elseif ($request->apply == "Non-Teaching Job Opportunities") {
                $applyValue = 2;
            }
            // -----------------------------------------------------------
    
            Log::info('Apply value resolved', ['apply_value' => $applyValue]);
            // Handle uploads
            $photoPath = null;
            $resumePath = null;
    
            if ($request->hasFile('photo_upload')) {
                $photoName = time() . '_' . $request->file('photo_upload')->getClientOriginalName();
                $request->file('photo_upload')->move(public_path('uploads/photos'), $photoName);
                $photoPath = 'uploads/photos/' . $photoName;
                
                 Log::info('Photo uploaded', ['path' => $photoPath]);
            }
    
            if ($request->hasFile('resume')) {
                $resumeName = time() . '_' . $request->file('resume')->getClientOriginalName();
                $request->file('resume')->move(public_path('uploads/resumes'), $resumeName);
                $resumePath = 'uploads/resumes/' . $resumeName;
                
                Log::info('Resume uploaded', ['path' => $resumePath]);
            }
    
            // Save main record
            $app = TeachingApplication::create([
                'apply' => $applyValue, // ✅ Correct value inserted here
                'name' => $request->input('name'),
                'position_applied' => $request->input('position_applied'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
                'utm' => $request->input('utm'),
                'nationality_id' => $request->input('nationality'),
                'marital_status' => $request->input('marital_status'),
                'childs_name' => $request->input('childs_name'),
                'childs_age' => $request->input('childs_age'),
                'current_address' => $request->input('current_address'),
                'zipcode' => $request->input('zipcode'),
                'landline_no' => $request->input('landline_no'),
                'mobile_no' => $request->input('mobile_no'),
                'permanent_address' => $request->input('permanent_address'),
                'availability_date' => $request->input('availability_date'),
                'email' => $request->input('email'),
                'notice_period' => $request->input('notice_period'),
                'skype_id' => $request->input('skype_id'),
                'criminal_offence' => $request->input('criminal_offence'),
                'photo_path' => $photoPath,
                'passport_no' => $request->input('passport_no'),
                'passport_issue_place' => $request->input('passport_issue_place'),
                'passport_issue_date' => $request->input('passport_issue_date'),
                'passport_expiry_date' => $request->input('passport_expiry_date'),
    
                // JSON fields
                'education' => json_encode($request->input('edu')),
                'pd_courses_attended' => json_encode($request->input('pd_courses_attended')),
                'pd_courses_conducted' => json_encode($request->input('pd_courses_conducted')),
                'publications' => json_encode($request->input('prd')),
                'referees' => json_encode($request->input('referees')),
                'employment' => json_encode($request->input('employment')),
    
                'experience_international_schools' => $request->input('experience_international_schools'),
                'supervisor_concern' => $request->input('supervisor_concern'),
                'direct_experience_in' => $request->input('direct_experience_in'),
                'current_employer' => $request->input('current_employer'),
                'experience_years' => $request->input('experience_years'),
                'experience_months' => $request->input('experience_months'),
                'current_designation' => $request->input('current_designation'),
    
                'it_skills' => $request->input('it_skills'),
                'hobbies' => $request->input('hobbies'),
                'language_skills' => $request->input('language_skills'),
                'current_salary' => $request->input('current_salary'),
                'expected_salary' => $request->input('expected_salary'),
                'philosophy' => $request->input('philosophy'),
                'other_information' => $request->input('other_information'),
                'resume_path' => $resumePath,
                'created_at' => Carbon::now(),
            ]);
            
            Log::info('Teaching application saved', ['application_id' => $app->id]);
            
            // dd($applyValue);
    
            // Fetch job role
            $job = \App\Models\JobPosting::find($app->position_applied);
            $jobRole = $job ? $job->job_roles : 'N/A';
            
             Log::info('Job role resolved', ['job_role' => $jobRole]);
            
            // Email data
            $data = [
                'name' => $app->name,
                'email' => $app->email,
                'position' => $jobRole,
            ];
            
            // ----------------------------------------------
            // SUBJECT LINES BASED ON APPLY TYPE (1 or 2)
            // ----------------------------------------------
            $subjectLine = ($applyValue == 1)
                ? 'Thank you for applying for Teaching Position: ' . $jobRole
                : 'Thank you for applying for Non-Teaching Position: ' . $jobRole;
            
            $adminSubject = ($applyValue == 1)
                ? 'New Teaching Job Application: ' . $app->name
                : 'New Non-Teaching Job Application: ' . $app->name;
            // ----------------------------------------------
            
            
            try {

                Mail::send('frontend.teaching_thankyou', $data, function ($message) use ($app, $subjectLine) {
                    $message->to($app->email)
                            ->from('no-reply@ecolemondiale.org', 'Ecole Mondiale World School')
                            ->subject($subjectLine);
                });
            
                Log::info('Applicant email sent');
            
            } catch (\Exception $e) {
            
                Log::error('Applicant mail failed', ['error' => $e->getMessage()]);
            }
            
            
            try {
            
                Mail::send('frontend.teaching_admin_notification', $data, function ($message) use ($app, $adminSubject) {
                    $message->to(['hr@ecolemondiale.org'])
                            ->from('no-reply@ecolemondiale.org', 'Ecole Mondiale World School')
                            ->replyTo($app->email, $app->name)
                            ->subject($adminSubject);
                });
            
                Log::info('Admin email sent');
            
            } catch (\Exception $e) {
            
                Log::error('Admin mail failed', ['error' => $e->getMessage()]);
            }
            
             Log::info('Admin email sent');
             
            return redirect()->route('ecole.thank.you')->with('success', 'Application submitted successfully!');
            
        } catch (\Exception $e) {
            Log::error('Teaching job form failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            Log::error('Teaching job form failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }


    public function contact_store(Request $request)
    {
       
        Log::info('Contact form submission started', [
            'ip' => $request->ip(),
            'input' => $request->only('name', 'email', 'phone', 'enquiry_type', 'form_type')
        ]);
    
        try {
            
            
            /* ---------------- CAPTCHA VALIDATION ---------------- */
            $request->validate([
                'g-recaptcha-response' => 'required'
            ], [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.'
            ]);
            
            $captcha   = $request->input('g-recaptcha-response');
            $secretKey = config('services.recaptcha.secret_key');
            $ip        = $request->ip();
            
            $verifyResponse = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => $secretKey,
                    'response' => $captcha,
                    'remoteip' => $ip
                ]
            );
            
            $captchaResult = $verifyResponse->json();
            
            if (empty($captchaResult['success'])) {
                Log::warning('Captcha verification failed', [
                    'ip' => $ip,
                    'response' => $captchaResult
                ]);
            
                return back()
                    ->withErrors(['captcha' => 'Captcha verification failed. Please try again.'])
                    ->withInput();
            }
            
            Log::info('Captcha verified successfully');
            /* ---------------------------------------------------- */
            /* ---------------------------------------------------- */
        
        
            $request->validate([
                'name' => 'required|regex:/^[A-Za-z\s]+$/',
                'email' => 'required|email',
                'phone' => 'required|digits_between:10,15',
                'utm'=> 'nullable|string|max:2000',
                'enquiry_type' => 'nullable|string',
                'form_type' => 'required|string',
                'message' => 'nullable|string|max:2000'
            ]);
    
            Log::info('Validation successful.');
    
            // Save to DB
            $enquiry = ContactEnquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'utm' => $request->utm,
                'enquiry_type' => $request->enquiry_type ?? '',
                'form_type' => ($request->form_type === 'contact') ? 1 : 2,
                'message' => $request->message,
                'inserted_at' => Carbon::now()
            ]);
    
            Log::info('Data stored in DB', [
                'enquiry_id' => $enquiry->id
            ]);
            
            $submitted_via = ($request->form_type === 'contact')
                ? 'Contact Form'
                : 'Quick Admission Enquiry Form';
            
            $subject = 'New Enquiry';
            
          
            
             // Send Email to Admin
            Mail::send('frontend.contact_form_mail', [
                'data' => $enquiry,
                'subject' => 'New Enquiry Received',
                 'submitted_via' => $submitted_via
            ], function($mail) {
                $mail->to('enquiry@ecolemondiale.org');
                // $mail->cc('shweta@matrixbricks.com');
                $mail->subject('New Enquiry Received');
            });
            
            
            // Send Auto-reply Email to Client
            Mail::send('frontend.contact_user_mail', [
                'data' => $enquiry,
                'subject' => 'Thank you for Reaching out!'
            ], function($mail) use ($enquiry) {
                $mail->to($enquiry->email);
                $mail->subject('Thank you for Reaching out!');
            });
    
            Log::info('Email sent successfully');
    
            return redirect()->route('ecole.thank.you')->with('success', 'Thank you! We will get back to you soon!');
    
        } catch (\Exception $e) {
            Log::error('Error in contact form submission: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
    
            return back()->withErrors(['error' => 'Something went wrong! Please try again later.'])
                         ->withInput();
        }
    }


}
