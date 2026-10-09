<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use App\Models\AdmissionDetails;
use App\Models\Grades;
use App\Models\BrochureDetail;

class AdmissionFormController extends Controller
{

    public function store(Request $request)
    {
        // dd($request);


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
                'utm'=> 'nullable|string|max:2000',
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
            $admission->utm = $validated['utm'];       

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
            $gradeName = Grades::where('id', $admission->join_grade)->value('grade'); 


            // ✅ Step 3: Trigger Email
            $data = [
                'student_name' => $admission->student_name,
                'father_name' => $validated['f_name'],
                'mother_name' => $validated['m_name'],
                'grade'        => $gradeName ?? 'N/A',
                'form_type' => $request->input('form_type'),
                 // ADD THESE
                'f_email'      => $validated['f_email'],
                'f_phone'      => $validated['f_mobile'],
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

            try {

                Mail::send('frontend.admission_mail', $data, function ($message) use ($validated, $subject) {
                    $message->to($validated['f_email'], $validated['f_name']) 
                            ->from('no-reply@ecolemondiale.org', 'Ecole Mondiale')
                            ->replyTo($validated['f_email'], $validated['f_name'])
                            ->subject('Thank you for your ' . $subject . '!');
                });
                
                
                Mail::send('frontend.admission_admin_mail', $data, function ($message) use ($validated, $subject) {

                    $message->to(['admission@ecolemondiale.org'])
                            ->from('no-reply@ecolemondiale.org', 'Ecole Mondiale')
                            ->replyTo($validated['f_email'], $validated['f_name'])
                            ->subject('New ' . $subject . ' Received');
                });
            
                Log::info('Admission email sent successfully.');
            
            } catch (\Exception $e) {
            
                Log::error('Admission email failed: '.$e->getMessage());
            }

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

    public function proceed_to_payment(Request $request)
    {
        try {
            \Log::info('🟢 Proceed to Payment initiated', ['request_data' => $request->all()]);

            $formTypeMap = [
                'apply_for_admission' => 1,
                'schedule_a_visit' => 2,
                'enquiry_form' => 3,
            ];
            $formType = $formTypeMap[$request->input('form_type')] ?? $request->input('form_type');

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
                'passport_type' => 'required|in:1,2',
                'foregin_passport_type' => 'nullable|in:1,2,3',
                'specific_learning' => 'nullable|string|max:500',
                'heard_from' => 'required|string|max:255',
                'wish_you_know' => 'nullable|string|max:500',
                'utm' => 'nullable|string|max:255',
            ]);

            // ✅ Save admission
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
            $admission->utm = $validated['utm'] ?? null;

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

            $admission->passport_type = $validated['passport_type'];
            $admission->foregin_passport_type = $validated['foregin_passport_type'] ?? null;
            $admission->specific_learning = $validated['specific_learning'] ?? null;
            $admission->heard_from = $validated['heard_from'];
            $admission->wish_you_know = $validated['wish_you_know'] ?? null;
            $admission->inserted_at = now();
            $admission->save();

            $order_id = '#EWMS_' . rand(100000, 999999);
            $t_id = rand(10000000, 99999999);

            // ✅ Return JSON to JS
            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully.',
                'order_id' => $order_id,
                't_id' => $t_id,
                'redirect_url' => route('frontend.payment.show', $admission->id)
            ]);

        } catch (\Throwable $e) {
            \Log::error('❌ Proceed to Payment Error: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ]);
        }
    }

    public function showPayment($id)
    {
        $admission = AdmissionDetails::findOrFail($id);

        $order_id = 'EWMS_' . rand(100000, 999999);
        $t_id = rand(10000000, 99999999);

        $countries = DB::table('countries')
            ->orderBy('id', 'asc')
            ->get();


        $brochure = BrochureDetail::first();
        $feesData = json_decode($brochure->fees, true); 

        $amount = 0;
        foreach ($feesData as $fee) {
            if ($fee['passport_type'] == $admission->passport_type) {
                $amount = $fee['amount'];
                break;
            }
        }

        $admission->update([
            'order_id' => $order_id,
            't_id'     => $t_id,
            'amount'   => $amount,
        ]);

        return view('frontend.proceed_to_payment', compact('order_id', 't_id', 'admission', 'amount','countries'));
    }

    
    public function redirectToCCAvenue(Request $request)
    {
      // Hardcoded credentials for testing
        $merchant_id = '11278';
        $access_code = '6J2BHM5KCK1HU8JN';
        $working_key = 'BC45FF1DD75AA750EAA5F43C74B96244';
    
        Log::info('🌐 Step 1: Received request to redirect to CCAvenue', [
            'incoming_request' => $request->all(),
            'env' => [
                'merchant_id' => $merchant_id,
                'access_code' => $access_code,
                'working_key_present' => !empty($working_key),
                'working_key_length' => strlen($working_key)
            ]
        ]);
    
        // ✅ 1. Update billing & shipping info
        AdmissionDetails::where('id', $request->admission_id)->update([
            'billing_name'     => $request->billing_name,
            'billing_address'  => $request->billing_address,
            'billing_city'     => $request->billing_city,
            'billing_state'    => $request->billing_state,
            'billing_zip'      => $request->billing_zip,
            'billing_country'  => $request->billing_country, // DB can stay 99
            'billing_phone'    => $request->billing_phone,
            'billing_email'    => $request->billing_email,
            'shipping_name'    => $request->shipping_name,
            'shipping_address' => $request->shipping_address,
            'shipping_city'    => $request->shipping_city,
            'shipping_state'   => $request->shipping_state,
            'shipping_zip'     => $request->shipping_zip,
            'shipping_country' => $request->shipping_country, // DB can stay 99
            'shipping_phone'   => $request->shipping_phone,
            'shipping_email'   => $request->shipping_email,
            'amount'   => $request->amount,
        ]);
    
        // ✅ 2. Prepare CCAvenue parameters (COUNTRY MUST BE ISO CODE)
        $parameters = [
            'merchant_id'      => (string) $merchant_id,  // ensure string
            'order_id'         => $request->order_id,
            'currency'         => 'INR',
            'amount'           => number_format((float) $request->amount, 2, '.', ''),
            // 'amount'           => '1',
            'redirect_url' =>   'https://www.ecolemondiale.org/ccavenue/response',
            'cancel_url'   =>   'https://www.ecolemondiale.org/ccavenue/cancel',
            'language'         => 'en',  // ← lowercase 'en' is safer
            'billing_name'     => trim($request->billing_name ?? ''),
            'billing_address'  => trim($request->billing_address ?? ''),
            'billing_city'     => trim($request->billing_city ?? ''),
            'billing_state'    => trim($request->billing_state ?? 'Maharashtra'),  // fallback
            'billing_zip'      => trim($request->billing_zip ?? ''),
            'billing_country'  => 'IN',
            'billing_tel'      => trim($request->billing_phone ?? ''),
            'billing_email'    => trim($request->billing_email ?? ''),
            'shipping_name'    => trim($request->shipping_name ?? $request->billing_name ?? ''),
            'shipping_address' => trim($request->shipping_address ?? $request->billing_address ?? ''),
            'shipping_city'    => trim($request->shipping_city ?? $request->billing_city ?? ''),
            'shipping_state'   => trim($request->shipping_state ?? $request->billing_state ?? 'Maharashtra'),
            'shipping_zip'     => trim($request->shipping_zip ?? $request->billing_zip ?? ''),
            'shipping_country' => 'IN',
            'shipping_tel'     => trim($request->shipping_phone ?? $request->billing_phone ?? ''),
            'shipping_email'   => trim($request->shipping_email ?? $request->billing_email ?? ''),
        ];
        
        // Build merchant_data – safer version
        $merchant_data = '';
        foreach ($parameters as $key => $value) {
            if ($value !== '' && $value !== null) {  // ← skip empty values
                $merchant_data .= $key . '=' . $value . '&';
            }
        }
        $merchant_data = rtrim($merchant_data, '&');  // remove last &
        $merchant_data = trim($merchant_data);        // remove any leading/trailing spaces
        
        //dd($parameters, $merchant_data);
    
        Log::info('🧱 Step 3: Merchant data string', [
            'merchant_data' => $merchant_data
        ]);
    
        // ✅ 4. Encrypt
        $encrypted_data = $this->encryptCCAvenueData($merchant_data, $working_key);
    
        Log::info('🔐 Step 4: Encrypted data generated', [
            'encrypted_sample' => substr($encrypted_data, 0, 120) . '...',
            'length' => strlen($encrypted_data)
        ]);
    
        // ✅ 5. Redirect
        $ccavenue_url = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    
    
        Log::info('🚀 Step 5: Redirecting to CCAvenue', [
            'ccavenue_url' => $ccavenue_url,
            'access_code'  => $access_code
        ]);
    
        return view('frontend.ccavenue-redirect', compact(
            'encrypted_data',
            'access_code',
            'ccavenue_url'
        ));
    }
    
    
    public function handleResponse(Request $request)
    {
        file_put_contents(
            storage_path('logs/ccavenue_raw.txt'),
            json_encode($_POST, JSON_PRETTY_PRINT),
            FILE_APPEND
        );
        
        
        Log::info('📩 Step 0: Entered handleResponse method', [
            'request_all' => $request->all()
        ]);
    
        $working_key = 'BC45FF1DD75AA750EAA5F43C74B96244';
    
        $encResponse = $request->encResp;
        Log::info('📩 Step 1: Received encResp', [
            'encResponse_present' => !empty($encResponse),
            'encResponse_length' => strlen($encResponse ?? '')
        ]);
    
        if (!$encResponse) {
            Log::error('❌ Step 2: No encResp found in request');
            return response()->view('frontend.payment-failed', [
                'message' => 'Invalid response from payment gateway'
            ]);
        }
    
        $decryptedResponse = $this->decryptCCAvenueData($encResponse, $working_key);
        Log::info('🔐 Step 3: Decrypted response', [
            'decrypted_preview' => substr($decryptedResponse, 0, 200) . '...'
        ]);
    
        parse_str($decryptedResponse, $responseArray);
        Log::info('📄 Step 4: Parsed response array', ['responseArray' => $responseArray]);
    
        $orderId = $responseArray['order_id'] ?? 'failed_' . time();
        $orderStatus = $responseArray['order_status'] ?? 'Failure';
    
        Log::info('📊 Step 5: Extracted order info', [
            'order_id' => $orderId,
            'order_status' => $orderStatus
        ]);
    
        if (!$orderId) {
            Log::error('❌ Step 6: Order ID missing in response');
            return response()->view('frontend.payment-failed', [
                'message' => 'Order ID missing in response'
            ]);
        }
    
        $admission = AdmissionDetails::where('order_id', $orderId)->first();
        Log::info('🗂 Step 7: Fetched admission record', [
            'admission_found' => $admission ? true : false,
            'admission_id' => $admission->id ?? null
        ]);
    
        if ($admission) {
            $admission->update([
                'payment_status' => $orderStatus === 'Success' ? 'Paid' : 'Failed',
                'tracking_id'    => $responseArray['tracking_id'] ?? null,
                'bank_ref_no'    => $responseArray['bank_ref_no'] ?? null,
                'payment_mode'   => $responseArray['payment_mode'] ?? null,
                'order_status'   => $orderStatus,
                'currency'       => $responseArray['currency'] ?? 'INR',
                'status_message' => $responseArray['status_message'] ?? $responseArray['failure_message'] ?? 'Payment failed',
                'modified_at'    => now()
            ]);
        } else {
            Log::warning('⚠️ Admission not found — logging failed transaction', [
                'order_id' => $orderId,
                'status'   => $orderStatus
            ]);
        }

    
        if ($orderStatus === 'Success') {
            Log::info('🎉 Step 9: Payment successful', ['order_id' => $orderId]);
            return response()->view('frontend.payment-success', compact('responseArray'));
        } elseif ($orderStatus === 'Aborted') {
            Log::warning('⚠️ Step 10: Payment aborted', ['order_id' => $orderId]);
            return response()->view('frontend.payment-failed', compact('responseArray'));
        } else {
            Log::error('❌ Step 11: Payment failed', ['order_id' => $orderId, 'status' => $orderStatus]);
            return response()->view('frontend.payment-failed', compact('responseArray'));
        }
    }

    private function decryptCCAvenueData($encryptedText, $workingKey)
    {
        Log::info('🧩 Step DEC1: Starting decryption', ['encryptedText_length' => strlen($encryptedText)]);

        $key = $this->hextobin(md5($workingKey));
        $iv = pack("C*", 0x00, 0x01, 0x02, 0x03,
                        0x04, 0x05, 0x06, 0x07,
                        0x08, 0x09, 0x0a, 0x0b,
                        0x0c, 0x0d, 0x0e, 0x0f);
        
        $encryptedBinary = $this->hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedBinary, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);

        Log::info('✅ Step DEC2: Decryption done', ['preview' => substr($decryptedText, 0, 120) . '...']);
        return $decryptedText;
    }
    
    
    private function encryptCCAvenueData($plainText, $workingKey)
    {
        $key = pack('H*', md5($workingKey));
        $iv  = pack(
            "C*",
            0x00,0x01,0x02,0x03,
            0x04,0x05,0x06,0x07,
            0x08,0x09,0x0a,0x0b,
            0x0c,0x0d,0x0e,0x0f
        );
    
        $encrypted = openssl_encrypt(
            $plainText,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
    
        return strtoupper(bin2hex($encrypted));
    }

    
    private function hextobin($hexString)
    {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            $binString .= $packedString;
            $count += 2;
        }
        return $binString;
    }


    public function handleCancel(Request $request)
    {
        // dd($request);
    $orderId = $request->orderNo ?? 'cancelled_' . time();
    
    $admission = AdmissionDetails::where('order_id', $orderId)->first();

    if ($admission) {
        // Update existing record instead of creating a new one
        $admission->update([
            'payment_status' => 'Cancelled',
            'order_status'   => 'Aborted',
            'status_message' => 'User cancelled the payment',
            'modified_at'    => now()
        ]);

        Log::warning('⚠️ Payment cancelled by user (admission updated)', [
            'order_id' => $orderId
        ]);
    } else {
        // Optional: create a placeholder if no record exists
        AdmissionDetails::create([
            'order_id'        => $orderId,
            'payment_status'  => 'Cancelled',
            'order_status'    => 'Aborted',
            'status_message'  => 'User cancelled the payment',
            'currency'        => 'INR',
            'inserted_at'     => now(),
            'modified_at'     => now()
        ]);

        Log::warning('⚠️ Payment cancelled by user (placeholder created)', [
            'order_id' => $orderId
        ]);
    }

    return response()->view('frontend.payment-failed', [
        'message' => 'Payment was cancelled by user.'
    ]);
}






}
