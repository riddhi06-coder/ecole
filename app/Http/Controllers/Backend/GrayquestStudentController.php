<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\User;
use App\Models\GrayquestPaymentDetails;



class GrayquestStudentController extends Controller
{

    public function index()
    {
        $students = GrayquestPaymentDetails::orderBy('id', 'desc')->get();
        $years = GrayquestPaymentDetails::select('year')->distinct()->orderBy('year', 'asc')->pluck('year');
        
        return view('backend.grayquest.index' , compact('students', 'years'));
    }
    
    
    public function update(Request $request, $id)
    {
        // Find student
        $student = GrayquestPaymentDetails::findOrFail($id);
    
        // ✅ Validation
        $request->validate([
            'year'            => 'required|string|max:255',
            'student_name'    => 'required|string|max:255',
            'grade'           => 'required|string|max:255',
            'gr_no'           => 'required|string|max:255',
            'amount'          => 'required|numeric',
    
            'father_name'     => 'required|string|max:255',
            'mother_name'     => 'required|string|max:255',
    
            'father_mobile'   => 'required|digits:10',
            'mother_mobile'   => 'required|digits:10',
    
            'father_email'    => 'required|email',
            'mother_email'    => 'required|email',
    
            'student_address' => 'required|string',
        ]);
    
        // ✅ Update only editable fields
        $student->update([
            'year'            => $request->year,
            'student_name'    => $request->student_name,
            'grade'           => $request->grade,
            'gr_no'           => $request->gr_no,
            'amount'          => $request->amount,
    
            'father_name'     => $request->father_name,
            'mother_name'     => $request->mother_name,
    
            'father_mobile'   => $request->father_mobile,
            'mother_mobile'   => $request->mother_mobile,
    
            'father_email'    => $request->father_email,
            'mother_email'    => $request->mother_email,
    
            'student_address' => $request->student_address,
        ]);
    
        // ✅ Redirect
        return redirect()
            ->route('manage-grayquest-student.index')
            ->with('message', 'Student details updated successfully ✅');
    }

    
    // public function import(Request $request)
    // {
    //     \Log::info('Payment import started', [
    //         'user_id' => auth()->id()
    //     ]);
    
    //     $request->validate([
    //         'import_file' => 'required|mimes:csv,txt,xlsx,xls'
    //     ]);
    
    //     $file = $request->file('import_file');
    //     $extension = strtolower($file->getClientOriginalExtension());
    
    //     // =========================
    //     // READ FILE
    //     // =========================
    //     if (in_array($extension, ['csv', 'txt'])) {
    //         $rows = array_map('str_getcsv', file($file->getRealPath()));
    //     } else {
    //         $rows = Excel::toArray([], $file)[0];
    //     }
    
    //     if (count($rows) < 2) {
    //         \Log::warning('Import aborted: No data rows');
    //         return back()->withErrors('File has no data');
    //     }
    
    //     // =========================
    //     // CLEAN HEADERS
    //     // =========================
    //     $rawHeader = array_shift($rows);
    
    //     $header = [];
    //     foreach ($rawHeader as $key => $value) {
    //         $clean = strtolower(trim(preg_replace('/\s+/', '_', $value)));
    //         if ($clean !== '') {
    //             $header[$key] = $clean;
    //         }
    //     }
    
    //     $headerValues = array_values($header);
    //     \Log::info('Cleaned headers', $headerValues);
    
    //     // =========================
    //     // CLEAR EXISTING DATA
    //     // =========================
    //     GrayquestPaymentDetails::truncate(); // remove all existing rows
    //     \Log::info('Existing payment records cleared');
    
    //     // =========================
    //     // INSERT NEW ROWS
    //     // =========================
    //     foreach ($rows as $rowNumber => $rowData) {
    //         // Pad or trim to match headers
    //         $rowData = array_pad($rowData, count($headerValues), null);
    //         $rowData = array_slice($rowData, 0, count($headerValues));
        
    //         $rowAssoc = array_combine($headerValues, $rowData);
    //         if (!$rowAssoc) {
    //             \Log::warning("Row {$rowNumber} skipped: header/value mismatch");
    //             continue;
    //         }
        
    //         // Skip completely empty rows
    //         $allEmpty = true;
    //         foreach ($rowAssoc as $value) {
    //             if (!is_null($value) && $value !== '') {
    //                 $allEmpty = false;
    //                 break;
    //             }
    //         }
    //         if ($allEmpty) {
    //             \Log::info("Row {$rowNumber} skipped: completely empty row");
    //             continue;
    //         }
        
    //         GrayquestPaymentDetails::create($rowAssoc);
    //         \Log::info("Row {$rowNumber} inserted");
    //     }
    
    
    //     \Log::info('Payment import completed successfully');
    
    //     return back()->with('message', 'Data imported successfully');
    // }
    
    
    public function import(Request $request)
    {
        \Log::info('Payment import started', [
            'user_id' => auth()->id()
        ]);
    
        $request->validate([
            'import_file' => 'required|mimes:csv,txt,xlsx,xls'
        ]);
    
        $file = $request->file('import_file');
        $extension = strtolower($file->getClientOriginalExtension());
    
        // =========================
        // READ FILE
        // =========================
        if (in_array($extension, ['csv', 'txt'])) {
            $rows = array_map('str_getcsv', file($file->getRealPath()));
        } else {
            $rows = Excel::toArray([], $file)[0];
        }
    
        if (count($rows) < 2) {
            \Log::warning('Import aborted: No data rows');
            return back()->withErrors('File has no data');
        }
    
        // =========================
        // CLEAN HEADERS
        // =========================
        $rawHeader = array_shift($rows);
    
        $header = [];
        foreach ($rawHeader as $key => $value) {
            $clean = strtolower(trim(preg_replace('/\s+/', '_', $value)));
            if ($clean !== '') {
                $header[$key] = $clean;
            }
        }
    
        $headerValues = array_values($header);
        \Log::info('Cleaned headers', $headerValues);
    
        // =========================
        // START TRANSACTION
        // =========================
        DB::beginTransaction();
    
        try {
    
            $seen = []; // for duplicate GR in same file
    
            foreach ($rows as $rowNumber => $rowData) {
    
                // Pad / trim
                $rowData = array_pad($rowData, count($headerValues), null);
                $rowData = array_slice($rowData, 0, count($headerValues));
    
                $rowAssoc = array_combine($headerValues, $rowData);
    
                if (!$rowAssoc) {
                    \Log::warning("Row {$rowNumber} skipped: header mismatch");
                    continue;
                }
    
                // Skip empty row
                if (empty(array_filter($rowAssoc))) {
                    \Log::info("Row {$rowNumber} skipped: empty");
                    continue;
                }
    
                // ✅ Check GR NO
                $grNo = $rowAssoc['gr_no'] ?? null;
    
                if (!$grNo) {
                    \Log::warning("Row {$rowNumber} skipped: GR No missing");
                    continue;
                }
    
                // ✅ Check duplicate in same file
                if (isset($seen[$grNo])) {
                    \Log::warning("Row {$rowNumber} skipped: duplicate GR No in file ({$grNo})");
                    continue;
                }
    
                $seen[$grNo] = true;
    
                // =========================
                // UPSERT (INSERT OR UPDATE)
                // =========================
                GrayquestPaymentDetails::updateOrCreate(
                    ['gr_no' => $grNo],
                    $rowAssoc
                );
    
                \Log::info("Row {$rowNumber} inserted/updated (GR: {$grNo})");
            }
    
            DB::commit();
    
            \Log::info('Payment import completed successfully');
    
            return back()->with('message', 'Data imported successfully');
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            \Log::error('Import failed', [
                'error' => $e->getMessage()
            ]);
    
            return back()->withErrors('Import failed. Please check file format.');
        }
    }

    
    public function export()
    {
        $filename = 'grayquest_student_' . now()->format('Ymd_His') . '.csv';
    
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ];
    
        // ONLY required columns
        $columns = [
            'gr_no',
            'year',
            'student_name',
            'grade',
            'amount',
            'father_name',
            'mother_name',
            'father_mobile',
            'mother_mobile',
            'father_email',
            'mother_email',
            'student_address',
        ];
    
        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
    
            // CSV header
            fputcsv($file, $columns);
    
            \App\Models\GrayquestPaymentDetails::select($columns)
                ->chunk(500, function ($records) use ($file, $columns) {
                    foreach ($records as $row) {
                        $data = [];
                        foreach ($columns as $col) {
                            $data[] = $row->{$col};
                        }
                        fputcsv($file, $data);
                    }
                });
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    
    
    public function edit($id)
    {
        $student = GrayquestPaymentDetails::findOrFail($id);
        return view('backend.grayquest.edit', compact('student'));
    }
    
    public function generateStudentIDs(Request $request)
    {
        $grNo        = $request->gr_no ?? null;
        $fatherEmail = $request->father_email ?? null;
        $motherEmail = $request->mother_email ?? null;
        $amount      = $request->amount ?? 0;
    
        $student = null;
    
        // 1️⃣ Try to find student by GR No
        if ($grNo) {
            $student = GrayquestPaymentDetails::where('gr_no', $grNo)->first();
        }
    
        // 2️⃣ If not found by GR No, try father_email or mother_email
        if (!$student && ($fatherEmail || $motherEmail)) {
            $student = GrayquestPaymentDetails::where(function($q) use ($fatherEmail, $motherEmail) {
                if ($fatherEmail) {
                    $q->orWhere('father_email', $fatherEmail);
                }
                if ($motherEmail) {
                    $q->orWhere('mother_email', $motherEmail);
                }
            })->first();
        }
    
        
        // 4️⃣ Generate GrayQuest Student ID if not exists
        if (!$student->gq_student_id) {
            do {
                $student->gq_student_id = 'GQ_' . strtoupper(Str::random(10));
            } while (GrayquestPaymentDetails::where('gq_student_id', $student->gq_student_id)->exists());
        }
    
        // 5️⃣ Generate reference ID if not exists
        if (!$student->gq_reference_id) {
            $student->gq_reference_id = 'EM_' . time();
        }
    
        // 6️⃣ Generate 6-digit numeric application ID if not exists
        if (!$student->gq_application_id) {
            do {
                $student->gq_application_id = mt_rand(100000, 999999); // numeric 6 digits
            } while (GrayquestPaymentDetails::where('gq_application_id', $student->gq_application_id)->exists());
        }
    
        $student->gq_send_status = 1;
        $student->save();
    
        return response()->json([
            'success' => true,
            'student_id'        => $student->id, // internal DB ID
            'gq_student_id'     => $student->gq_student_id,
            'gq_application_id' => $student->gq_application_id,
            'gq_reference_id'   => $student->gq_reference_id
        ]);
    }
    
    
    public function paymentPage($applicationId)
    {
        $student = GrayquestPaymentDetails::where(
            'gq_application_id',
            $applicationId
        )->firstOrFail();
        
        
         // Split name
        $nameParts = explode(' ', $student->student_name);
    
        $firstName = $nameParts[0];
        $lastName  = $nameParts[1] ?? '';
            
        // dd($student);
    
        return view('frontend.grayquest_payment_view', [
            'student' => $student,
            'firstName' => $firstName,
            'lastName' => $lastName
        ]);
    }
    
    
    // public function sendMail(Request $request)
    // {
    //     Log::info('📩 GrayQuest sendMail called', $request->all());
    
    //     $studentId     = $request->gq_student_id;
    //     $applicationId = $request->gq_application_id;
    //     $referenceId   = $request->gq_reference_id;
    //     $amount        = $request->amount;
    //     $grNo          = $request->gr_no ?? null;
    
    //     Log::info('🔎 Incoming identifiers', [
    //         'gr_no' => $grNo,
    //         'gq_application_id' => $applicationId,
    //         'gq_student_id' => $studentId
    //     ]);
    
    //     // 🔍 Find student smartly
    //     $student = null;
    
    //     // 1️⃣ Prefer GR No
    //     if ($grNo) {
    //         $student = GrayquestPaymentDetails::where('gr_no', $grNo)->first();
    //         Log::info('🔍 Lookup via GR No', [
    //             'found' => (bool) $student
    //         ]);
    //     }
    
    //     // 2️⃣ Fallback to Application ID
    //     if (!$student && $applicationId) {
    //         $student = GrayquestPaymentDetails::where(
    //             'gq_application_id',
    //             $applicationId
    //         )->first();
    
    //         Log::info('🔍 Lookup via GQ Application ID', [
    //             'found' => (bool) $student
    //         ]);
    //     }
    
    //     // 3️⃣ Safety check
    //     if (!$student) {
    //         Log::warning('❌ Student not found', [
    //             'gr_no' => $grNo,
    //             'gq_application_id' => $applicationId
    //         ]);
    
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Student not found.'
    //         ], 404);
    //     }
    
    //     // 📧 Decide email
    //     $toEmail = $student->father_email ?? $student->mother_email;
    
    //     Log::info('📧 Email resolved', [
    //         'email' => $toEmail
    //     ]);
    
    //     if (!$toEmail) {
    //         Log::warning('❌ Parent email missing', [
    //             'student_id' => $student->id
    //         ]);
    
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Parent email not available.'
    //         ], 422);
    //     }
    
    //     // 🔗 Payment URL
    //     try {
    //         $paymentUrl = route(
    //             'grayquest.payment.page',
    //             ['application_id' => $applicationId]
    //         );
    
    //         Log::info('🔗 Payment URL generated', [
    //             'url' => $paymentUrl
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('❌ Payment route error', [
    //             'error' => $e->getMessage()
    //         ]);
    
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Payment URL generation failed.'
    //         ], 500);
    //     }
    
    //     // ✉️ Send Mail
    //     try {
    
    //         Log::info('✉️ Attempting to send GrayQuest mail');
    
    //         Mail::send(
    //             'frontend.grayquest_mail',
    //             [
    //                 'student_name'      => $student->student_name,
    //                 'gr_no'             => $student->gr_no,
    //                 'gq_student_id'     => $studentId,
    //                 'gq_application_id' => $applicationId,
    //                 'gq_reference_id'   => $referenceId,
    //                 'amount'            => $amount,
    //                 'payment_url'       => $paymentUrl
    //             ],
    //             function ($message) use ($toEmail) {
    //                 $message->to($toEmail)
    //                         ->subject('GrayQuest Portal – Start Process');
    //             }
    //         );
            
            
    //         // Mail::send(
    //         //     'frontend.grayquest_mail',
    //         //     [
    //         //         'student_name'      => $student->student_name,
    //         //         'gr_no'             => $student->gr_no,
    //         //         'gq_student_id'     => $studentId,
    //         //         'gq_application_id' => $applicationId,
    //         //         'gq_reference_id'   => $referenceId,
    //         //         'amount'            => $amount,
    //         //         'payment_url'       => $paymentUrl
    //         //     ],
    //         //     function ($message) use ($toEmail) {
            
    //         //         $message->to($toEmail)
    //         //                 ->cc('accounts@school.com')   // ✅ internal copy
    //         //                 ->subject('GrayQuest Portal – Start Process');
    //         //     }
    //         // );

    
    //         Log::info('✅ GrayQuest mail sent successfully', [
    //             'email' => $toEmail
    //         ]);
    
    //         return response()->json(['success' => true]);
    
    //     } catch (\Exception $e) {
    
    //         Log::error('❌ GrayQuest mail failed', [
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
    
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to send email.'
    //         ], 500);
    //     }
    // }
    
    
    
    public function sendMail(Request $request)
    {
        Log::info('📩 GrayQuest sendMail called', $request->all());
    
        $studentId     = $request->gq_student_id;
        $applicationId = $request->gq_application_id;
        $referenceId   = $request->gq_reference_id;
        $amount        = $request->amount;
        $grNo          = $request->gr_no ?? null;
    
        Log::info('🔎 Incoming identifiers', [
            'gr_no' => $grNo,
            'gq_application_id' => $applicationId,
            'gq_student_id' => $studentId
        ]);
    
        // 🔍 Find student smartly
        $student = null;
    
        // 1️⃣ Prefer GR No
        if ($grNo) {
            $student = GrayquestPaymentDetails::where('gr_no', $grNo)->first();
            Log::info('🔍 Lookup via GR No', ['found' => (bool) $student]);
        }
    
        // 2️⃣ Fallback to Application ID
        if (!$student && $applicationId) {
            $student = GrayquestPaymentDetails::where('gq_application_id', $applicationId)->first();
            Log::info('🔍 Lookup via GQ Application ID', ['found' => (bool) $student]);
        }
    
        // 3️⃣ Safety check
        if (!$student) {
            Log::warning('❌ Student not found', [
                'gr_no' => $grNo,
                'gq_application_id' => $applicationId
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }
    
        // 📧 Decide email
        $toEmail = $student->father_email ?? $student->mother_email;
    
        Log::info('📧 Email resolved', ['email' => $toEmail]);
    
        if (!$toEmail) {
            Log::warning('❌ Parent email missing', ['student_id' => $student->id]);
    
            return response()->json([
                'success' => false,
                'message' => 'Parent email not available.'
            ], 422);
        }
    
        // 🔗 Payment URL
        try {
            $paymentUrl = route('grayquest.payment.page', ['application_id' => $applicationId]);
            Log::info('🔗 Payment URL generated', ['url' => $paymentUrl]);
        } catch (\Exception $e) {
            Log::error('❌ Payment route error', ['error' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'Payment URL generation failed.'
            ], 500);
        }
    
        // ✉️ Send Parent Mail
        try {
    
            Log::info('✉️ Attempting to send GrayQuest mail');
    
            Mail::send(
                'frontend.grayquest_mail',
                [
                    'student_name'      => $student->student_name,
                    'gr_no'             => $student->gr_no,
                    'gq_student_id'     => $studentId,
                    'gq_application_id' => $applicationId,
                    'gq_reference_id'   => $referenceId,
                    'amount'            => $amount,
                    'payment_url'       => $paymentUrl
                ],
                function ($message) use ($toEmail) {
                    $message->to($toEmail)
                            ->subject('GrayQuest Portal – Start Process');
                }
            );
    
            Log::info('✅ GrayQuest mail sent successfully', ['email' => $toEmail]);
    
            // ✉️ Admin Mail (only after parent mail success)
            try {
                $adminEmail = 'admission@ecolemondiale.org';
    
                Mail::send(
                    'frontend.grayquest_admin_mail',
                    [
                        'student_name'      => $student->student_name,
                        'gr_no'             => $student->gr_no,
                        'gq_student_id'     => $studentId,
                        'gq_application_id' => $applicationId,
                        'gq_reference_id'   => $referenceId,
                        'amount'            => $amount,
                        'parent_email'      => $toEmail
                    ],
                    function ($message) use ($adminEmail, $student) {
                        $message->to($adminEmail)
                                ->subject('GrayQuest Link Sent - ' . $student->student_name);
                    }
                );
    
                Log::info('✅ Admin mail sent successfully', ['admin' => $adminEmail]);
    
            } catch (\Exception $e) {
                // Admin mail failure should not break the flow
                Log::error('❌ Admin mail failed', [
                    'student_id' => $student->id,
                    'error'      => $e->getMessage()
                ]);
            }
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
    
            Log::error('❌ GrayQuest mail failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.'
            ], 500);
        }
    }






    /* ----------------------------
     1️⃣ CREATE APPLICATION
    -----------------------------*/
    public function createApplication(Request $request)
    {
        $student = GrayquestPaymentDetails::findOrFail($request->student_id);
        // dd($student);
        
        
        // Split student name
        $nameParts = explode(' ', $student->student_name);
        $firstName = $nameParts[0];
        $lastName  = $nameParts[1] ?? '';

        // Generate Student ID only once
        if (!$student->gq_student_id) {
            do {
                $student->gq_student_id = $this->generateGrayquestStudentId();
            } while (
                GrayquestPaymentDetails::where('gq_student_id', $student->gq_student_id)->exists()
            );
        }

        $referenceId = 'ERP_' . time();

        $client = new Client([
            'base_uri' => rtrim(config('services.grayquest.base_url'), '/'),
            'timeout'  => 30,
        ]);

        $response = $client->post('/v1/applications/create', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(
                    config('services.grayquest.client_id') . ':' .
                    config('services.grayquest.client_secret')
                ),
                'GQ-API-Key' => config('services.grayquest.api_key'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'student_id' => $student->gq_student_id,
                'reference_id' => $referenceId,
                'customer_mobile' => $student->mobile,
                
                
                 // ADD THESE
                'student_first_name' => $firstName,
                'student_last_name'  => $lastName,
            
                'customer_first_name' => $student->father_name,
                'customer_last_name'  => '',

            
                'fee_headers' => [
                    'total_payable' => $student->amount,
                ],
            
                'notes' => [
                    'erp_name'       => 'Ecole Mondiale World School',
                    'student_name'  => $student->student_name,
                    'academic_year' => '2025-2026',
                    'platform'      => 'ERP Portal',
                    'src'           => 'WEB',
                ],
            
                'udf_details' => [
                    // 'udf_1' => $student->student_name ?? 'Student',
                    // 'udf_2' => $student->parent_name ?? 'Parent',
                    
                    'udf_1' => $firstName,                 // Student First Name
                    'udf_2' => $lastName,    
                    
                    'udf_3' => $student->grade ?? 'NA',
                    'udf_4' => $student->father_name ?? 'Parent',
                    'udf_5' => 'EMS Juhu',
                    'udf_6' => 'ERP',
                ],
            ]

        ]);

        $data = json_decode($response->getBody(), true);

        if (!empty($data['success'])) {
            $student->update([
                'gq_reference_id'   => $referenceId,
                'gq_application_id' => $data['data']['application_id'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /* ----------------------------
     2️⃣ CHECK STATUS (AFTER PAYMENT)
    -----------------------------*/
    public function checkStatus(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'application_id' => 'required',
            'reference_id' => 'required'
        ]);

        $client = new Client([
            'base_uri' => rtrim(config('services.grayquest.base_url'), '/'),
            'timeout' => 30
        ]);

        $response = $client->get('/v1/applications/check-status', [
            'query' => $request->only([
                'student_id',
                'application_id',
                'reference_id'
            ]),
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(
                    config('services.grayquest.client_id') . ':' .
                    config('services.grayquest.client_secret')
                ),
                'GQ-API-Key' => config('services.grayquest.api_key'),
            ]
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }

    /* ----------------------------
     3️⃣ SDK SUCCESS CALLBACK
    -----------------------------*/
    public function paymentSuccess(Request $request)
    {
        // Log incoming payload for debugging
        \Log::info('GrayQuest payment success payload:', $request->all());
    
        $data = $request->all();
    
        // Update payment status in DB
        GrayquestPaymentDetails::where('gq_application_id', $data['data']['application_id'] ?? null)
            ->update([
                'gq_payment_status' => 'SUCCESS',
                'gq_customer_code' => $data['data']['customer_code'] ?? null,
                'gq_amount'        => $data['data']['amount'] ?? null,
                'gq_type'          => $data['type'] ?? null
            ]);
    
        return response()->json(['success' => true]);
    }





    
}