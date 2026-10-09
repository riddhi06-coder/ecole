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
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


use Carbon\Carbon;
use App\Models\User;
use Razorpay\Api\Api;
use App\Models\AdmissionDetails;
use App\Models\StudentPayemntDetails;



class StudentAdmissionController extends Controller
{

    /**
     * Single source of truth: EMI type -> DB columns.
     */
    private const EMI_MAP = [
        'EMI1' => ['amount' => 'emi_1',  'details' => 'emi1_details',       'failed' => 'emi1_failed_details'],
        'EMI2' => ['amount' => 'emi_2',  'details' => 'emi2_details',       'failed' => 'emi2_failed_details'],
        'EMI3' => ['amount' => 'emi_3',  'details' => 'emi3_details',       'failed' => 'emi3_failed_details'],
        'FULL' => ['amount' => 'amount', 'details' => 'fullamount_details', 'failed' => 'fullamount_failed_details'],
    ];

    private function isValidEmiType(?string $type): bool
    {
        return $type !== null && isset(self::EMI_MAP[$type]);
    }

    /**
     * Prefer an explicit emi_type if the frontend ever sends one; otherwise pick the
     * first UNPAID instalment whose amount matches. Equal EMI1/EMI2 no longer collide.
     */
    private function resolveEmiType(StudentPayemntDetails $student, float $amount, ?string $requested = null): ?string
    {
        if ($this->isValidEmiType($requested)) {
            return $requested;
        }

        foreach (self::EMI_MAP as $type => $cols) {
            if ($student->{$cols['amount']} !== null
                && (float) $student->{$cols['amount']} === $amount
                && empty($student->{$cols['details']})) {
                return $type;
            }
        }

        return null;
    }

    public function index()
    {
        $students = StudentPayemntDetails::orderBy('id', 'desc')->wherenull('deleted_by')->get();
        $years = StudentPayemntDetails::select('year')->distinct()->orderBy('year', 'asc')->pluck('year');
    
        return view('backend.student_admission.index', compact('students', 'years'));
    }

    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'import_file' => 'required|mimes:csv,txt,xlsx,xls',
    //     ]);
    
    //     $file = $request->file('import_file');
    //     $filePath = $file->getRealPath();
    //     $data = array_map('str_getcsv', file($filePath));
    
    //     if (empty($data)) {
    //         return back()->with('error', 'CSV file is empty');
    //     }
    
    //     // Remove header row
    //     $header = array_shift($data);
    
    //     $updatedCount = 0;
    //     $insertedCount = 0;
    //     $deletedCount = 0;
    
    //     // Track CSV GR+Grade keys to handle deletions
    //     $csvKeys = [];
    
    //     // Track duplicates in CSV
    //     $processedKeys = [];
    
    //     DB::beginTransaction();
    
    //     try {
    //         foreach ($data as $index => $row) {
    
    //             // Skip completely empty rows
    //             if (count(array_filter($row)) === 0) {
    //                 Log::info("Row {$index} skipped: empty row");
    //                 continue;
    //             }
    
    //             // Trim and normalize empty strings to null
    //             $row = array_map(function ($v) {
    //                 $v = trim($v);
    //                 return $v === '' ? null : $v;
    //             }, $row);
    
    //             // Pad row to 16 columns
    //             $row = array_pad($row, 16, null);
    
    //             $gr_no = $row[1];
    //             $grade = $row[4];
    
    //             if (!$gr_no || !$grade) {
    //                 Log::info("Row {$index} skipped: GR No or Grade missing");
    //                 continue;
    //             }
    
    //             // Skip duplicate GR+Grade in same CSV
    //             $key = $gr_no . '_' . $grade;
    //             if (in_array($key, $processedKeys)) {
    //                 Log::info("Row {$index} skipped: duplicate GR+Grade in CSV");
    //                 continue;
    //             }
    //             $processedKeys[] = $key;
    //             $csvKeys[] = $key;
    
    //             Log::info("Processing GR No: {$gr_no}, Grade: {$grade}");
    
    //             // Prepare row data
    //             $rowData = [
    //                 'year'            => $row[2] ?? null,
    //                 'student_name'    => $row[3] ?? null,
    //                 'grade'           => $grade,
    //                 'amount'          => $row[5] ?? null,
    //                 'emi_1'           => $row[6] ?? null,
    //                 'emi_2'           => $row[7] ?? null,
    //                 'emi_3'           => $row[8] ?? null,
    //                 'father_name'     => $row[9] ?? null,
    //                 'mother_name'     => $row[10] ?? null,
    //                 'father_mobile'   => $row[11] ?? null,
    //                 'mother_mobile'   => $row[12] ?? null,
    //                 'father_email'    => $row[13] ?? null,
    //                 'mother_email'    => $row[14] ?? null,
    //                 'student_address' => $row[15] ?? null,
    //             ];
    
    //             // Find existing student
    //             $student = StudentPayemntDetails::where('gr_no', $gr_no)
    //                         ->where('grade', $grade)
    //                         ->first();
    
    //             if ($student) {
    //                 // Normalize DB values for comparison
    //                 $dbData = collect($student->only(array_keys($rowData)))
    //                     ->map(function ($v) {
    //                         if (is_numeric($v)) return (float)$v;
    //                         return $v === '' ? null : $v;
    //                     })->toArray();
    
    //                 // Normalize CSV values
    //                 $csvData = collect($rowData)
    //                     ->map(function ($v) {
    //                         if (is_numeric($v)) return (float)$v;
    //                         return $v === '' ? null : $v;
    //                     })->toArray();
    
    //                 $changes = array_diff_assoc($csvData, $dbData);
    
    //                 if (!empty($changes)) {
    //                     $student->update(array_merge($csvData, [
    //                         'inserted_by' => Auth::id(),
    //                         'inserted_at' => now(),
    //                     ]));
    //                     $updatedCount++;
    //                     Log::info("GR No {$gr_no}, Grade {$grade} updated.");
    //                 } else {
    //                     Log::info("GR No {$gr_no}, Grade {$grade} skipped: no changes detected.");
    //                 }
    //             } else {
    //                 // Insert new row
    //                 StudentPayemntDetails::create(array_merge($rowData, [
    //                     'gr_no'       => $gr_no,
    //                     'inserted_by' => Auth::id(),
    //                     'inserted_at' => now(),
    //                 ]));
    //                 $insertedCount++;
    //                 Log::info("GR No {$gr_no}, Grade {$grade} inserted as new row.");
    //             }
    //         }
    
    //         // Delete DB rows not present in CSV
    //         $allDbStudents = StudentPayemntDetails::all();
    //         foreach ($allDbStudents as $student) {
    //             $key = $student->gr_no . '_' . $student->grade;
    //             if (!in_array($key, $csvKeys)) {
    //                 $student->delete();
    //                 $deletedCount++;
    //                 Log::info("GR No {$student->gr_no}, Grade {$student->grade} deleted (not in CSV).");
    //             }
    //         }
    
    //         DB::commit();
    //         Log::info("CSV import completed: {$updatedCount} updated, {$insertedCount} inserted, {$deletedCount} deleted.");
    //         return back()->with('message', "CSV imported successfully! {$updatedCount} updated, {$insertedCount} inserted, {$deletedCount} deleted.");
    
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error("CSV import error: " . $e->getMessage());
    //         return back()->with('error', 'Error importing CSV: ' . $e->getMessage());
    //     }
    // }
    
    
    
    public function import(Request $request)
    {
    $request->validate([
        'import_file' => 'required|mimes:csv,txt',
    ]);

    $file = $request->file('import_file');
    $filePath = $file->getRealPath();

    $data = array_map('str_getcsv', file($filePath));

    if (empty($data)) {
        return back()->with('error', 'CSV file is empty');
    }

    // ✅ Expected Header (same as export)
    $expectedHeader = [
        'GR No', 'Year', 'Student Name', 'Grade', 'Amount',
        'EMI 1', 'EMI 2', 'EMI 3', 'Father Name', 'Mother Name',
        'Father Mobile', 'Mother Mobile', 'Father Email', 'Mother Email', 'Student Address'
    ];

    // ✅ Remove header
    $header = array_map('trim', array_shift($data));

    if ($header !== $expectedHeader) {
        return back()->with('error', 'CSV format does not match export format.');
    }

    $updatedCount = 0;
    $insertedCount = 0;
    $deletedCount = 0;

    $csvKeys = [];
    $processedKeys = [];

    DB::beginTransaction();

    try {

        foreach ($data as $index => $row) {

            // ✅ Skip empty rows
            if (count(array_filter($row)) === 0) {
                continue;
            }

            // ✅ Clean values
            $row = array_map(function ($v) {
                $v = trim($v);
                return $v === '' ? null : $v;
            }, $row);

            // ✅ Match column count (15 columns)
            $row = array_pad($row, 15, null);

            // ✅ Correct mapping (MATCHES EXPORT)
            $gr_no = $row[0];
            $year  = $row[1];
            $student_name = $row[2];
            $grade = $row[3];

            if (!$gr_no || !$grade) {
                continue;
            }

            // ✅ Prevent duplicate in same CSV
            $key = $gr_no . '_' . $grade;

            if (in_array($key, $processedKeys)) {
                continue;
            }

            $processedKeys[] = $key;
            $csvKeys[] = $key;

            // ✅ Prepare data
            $rowData = [
                'year'            => $year,
                'student_name'    => $student_name,
                'grade'           => $grade,
                'amount'          => $row[4],
                'emi_1'           => $row[5],
                'emi_2'           => $row[6],
                'emi_3'           => $row[7],
                'father_name'     => $row[8],
                'mother_name'     => $row[9],
                'father_mobile'   => $row[10],
                'mother_mobile'   => $row[11],
                'father_email'    => $row[12],
                'mother_email'    => $row[13],
                'student_address' => $row[14],
            ];

            // ✅ Check existing record
            $student = StudentPayemntDetails::where('gr_no', $gr_no)
                        ->where('grade', $grade)
                        ->first();

            if ($student) {

                // Normalize DB values
                $dbData = collect($student->only(array_keys($rowData)))
                    ->map(function ($v) {
                        if (is_numeric($v)) return (float)$v;
                        return $v === '' ? null : $v;
                    })->toArray();

                // Normalize CSV values
                $csvData = collect($rowData)
                    ->map(function ($v) {
                        if (is_numeric($v)) return (float)$v;
                        return $v === '' ? null : $v;
                    })->toArray();

                $changes = array_diff_assoc($csvData, $dbData);

                if (!empty($changes)) {
                    $student->update(array_merge($csvData, [
                        'inserted_by' => Auth::id(),
                        'inserted_at' => now(),
                    ]));
                    $updatedCount++;
                }

            } else {

                // ✅ Insert new record
                StudentPayemntDetails::create(array_merge($rowData, [
                    'gr_no'       => $gr_no,
                    'inserted_by' => Auth::id(),
                    'inserted_at' => now(),
                ]));

                $insertedCount++;
            }
        }

        // ✅ SAFE DELETE (only if CSV has data)
        if (!empty($csvKeys)) {

            StudentPayemntDetails::chunk(500, function ($students) use ($csvKeys, &$deletedCount) {
                foreach ($students as $student) {
                    $key = $student->gr_no . '_' . $student->grade;

                    if (!in_array($key, $csvKeys)) {
                        $student->delete();
                        $deletedCount++;
                    }
                }
            });
        }

        DB::commit();

        return back()->with(
            'message',
            "CSV Imported Successfully! {$updatedCount} Updated, {$insertedCount} Inserted, {$deletedCount} Deleted."
        );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', 'Error importing CSV: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
        $student = StudentPayemntDetails::findOrFail($id);
        return view('backend.student_admission.edit', compact('student'));
    }
    
    
    public function exportCsv()
    {
        $fileName = 'students_payments_' . date('Y-m-d_H-i-s') . '.csv';
        $students = StudentPayemntDetails::all();
    
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
    
        $columns = [
             'GR No', 'Year', 'Student Name', 'Grade', 'Amount',
            'EMI 1', 'EMI 2', 'EMI 3', 'Father Name', 'Mother Name',
            'Father Mobile', 'Mother Mobile', 'Father Email', 'Mother Email', 'Student Address'
        ];
    
        $callback = function() use ($students, $columns) {
            $file = fopen('php://output', 'w');
    
            // Write header
            fputcsv($file, $columns);
    
            // Write rows
            foreach ($students as $student) {
                fputcsv($file, [
                    // $student->id,
                    $student->gr_no,
                    $student->year,
                    $student->student_name,
                    $student->grade,
                    $student->amount,
                    $student->emi_1,
                    $student->emi_2,
                    $student->emi_3,
                    $student->father_name,
                    $student->mother_name,
                    $student->father_mobile,
                    $student->mother_mobile,
                    $student->father_email,
                    $student->mother_email,
                    $student->student_address,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }


    public function update(Request $request, $id)
    {
        // Find the student
        $student = StudentPayemntDetails::findOrFail($id);
    
        // Validate request
        $validated = $request->validate(
        [
            'year' => 'required|string|max:10',
            'student_name' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'gr_no' => 'required|string|max:50',
    
            'amount' => 'required|numeric|min:1',
    
            // EMI amounts (optional, validated only if present)
            // 'emi_1' => 'nullable|numeric|min:0',
            // 'emi_2' => 'nullable|numeric|min:0',
            // 'emi_3' => 'nullable|numeric|min:0',
    
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
    
            'father_mobile' => 'required|digits_between:10,15',
            'mother_mobile' => 'required|digits_between:10,15',
    
            'father_email' => 'required|email:rfc,dns|max:255',
            'mother_email' => 'required|email:rfc,dns|max:255',
    
            'student_address' => 'required|string|min:5',
        ],
        [
            // Year
            'year.required' => 'Academic year is required.',
            'year.max' => 'Academic year cannot exceed 10 characters.',
    
            // Student
            'student_name.required' => 'Student name is required.',
            'student_name.max' => 'Student name cannot exceed 255 characters.',
    
            'grade.required' => 'Grade is required.',
            'gr_no.required' => 'GR number is required.',
    
            // Amount
            'amount.required' => 'Total fee amount is required.',
            'amount.numeric' => 'Total fee must be a valid number.',
            'amount.min' => 'Total fee must be greater than zero.',
    
            // EMI
            // 'emi_1.numeric' => 'EMI 1 must be a valid number.',
            // 'emi_2.numeric' => 'EMI 2 must be a valid number.',
            // 'emi_3.numeric' => 'EMI 3 must be a valid number.',
    
            // Parents
            'father_name.required' => 'Father’s name is required.',
            'mother_name.required' => 'Mother’s name is required.',
    
            'father_mobile.required' => 'Father’s mobile number is required.',
            'father_mobile.digits_between' => 'Father’s mobile number must be between 10 and 15 digits.',
    
            'mother_mobile.required' => 'Mother’s mobile number is required.',
            'mother_mobile.digits_between' => 'Mother’s mobile number must be between 10 and 15 digits.',
    
            // Emails
            'father_email.required' => 'Father’s email address is required.',
            'father_email.email' => 'Please enter a valid father’s email address.',
    
            'mother_email.required' => 'Mother’s email address is required.',
            'mother_email.email' => 'Please enter a valid mother’s email address.',
    
            // Address
            'student_address.required' => 'Student address is required.',
            'student_address.min' => 'Student address must be at least 5 characters long.',
        ]
    );

    
        // Add modified tracking info
        $validated['modified_by'] = auth()->id(); // assumes you are using Laravel auth
        $validated['modified_at'] = now();       // current timestamp
    
        // Update student record
        $student->update($validated);
        
        
        $student->refresh();

        $paid = 0;
        foreach (['emi1_details','emi2_details','emi3_details','fullamount_details'] as $col) {
            if (!empty($student->$col)) {
                $d = json_decode($student->$col, true);
                $paid += (float) ($d['amount'] ?? 0);
            }
        }
        
        $total = (float) $student->amount;
        $fully = $total > 0 && $paid >= $total;
        
        $student->update([
            'amount_paid' => $paid,
            'status'      => $fully ? 'paid' : ($paid > 0 ? 'partial_paid' : 'pending'),
            'pay_status'  => $fully ? 1 : 0,
        ]);
            
        // Redirect back with success message
        return redirect()->route('manage-student-details.index')
                         ->with('message', 'Student details updated successfully!');
    }

    
    // public function sendPaymentMail(Request $request)
    // {
        
       
    //     \Log::info('sendPaymentMail called', $request->all());
    
    //     $request->validate([
    //         'student_id' => 'required|exists:student_payment_details,id',
    //         'amount'     => 'required|numeric|min:1'
    //     ]);
    
    //     $student = StudentPayemntDetails::findOrFail($request->student_id);
        
    //     \Log::info('Student fetched', [
    //         'id' => $student->id,
    //         'name' => $student->student_name,
    //         'amounts' => [
    //             'emi_1' => $student->emi_1,
    //             'emi_2' => $student->emi_2,
    //             'emi_3' => $student->emi_3,
    //             'full'  => $student->amount
    //         ]
    //     ]);
    
    //     // Detect EMI type based on selected amount
    //     if ($request->amount == $student->emi_1) {
    //         $emiType = 'EMI1';
    //     } elseif ($request->amount == $student->emi_2) {
    //         $emiType = 'EMI2';
    //     } elseif ($request->amount == $student->emi_3) {
    //         $emiType = 'EMI3';
    //     } else {
    //         $emiType = 'FULL';
    //     }
        
    //     // dd($emiType);
        
    //     \Log::info('Detected EMI type', ['emiType' => $emiType, 'selectedAmount' => $request->amount]);
    
    //     // Create payment reference if not exists
    //     if (empty($student->payment_reference_id)) {
    //         $student->payment_reference_id = 'PAY_' . strtoupper(Str::random(10));
    //         $student->save();
    //         \Log::info('Created new payment reference', ['payment_reference_id' => $student->payment_reference_id]);
    //     }
    
    //     $selectedAmount = $request->amount;
    
    //     // Send email with selected EMI amount & type
    //     Mail::send('backend.student_admission.ecole_fees_pay_mail', [
    //         'student' => $student,
    //         'paymentRef' => $student->payment_reference_id,
    //         'emiType' => $emiType,
    //         'selectedAmount' => $selectedAmount
    //     ], function ($mail) use ($student) {
    //         $emails = array_filter([$student->father_email, $student->mother_email]);
    //         if (!empty($emails)) {
    //             $mail->to($emails)
    //                  ->subject('Ecole Mondiale Fees Payment Link');
    //         }
    //     });
        
        
    //     \Log::info('Email sent', [
    //         'student_id' => $student->id,
    //         'emiType' => $emiType,
    //         'selectedAmount' => $selectedAmount,
    //         'payment_reference' => $student->payment_reference_id
    //     ]);
    
    //     return response()->json([
    //         'status' => true,
    //         'emiType' => $emiType,
    //         'selectedAmount' => $selectedAmount
    //     ]);
    // }
    
    
    public function sendPaymentMail(Request $request)
    {
        \Log::info('sendPaymentMail called', $request->all());
    
        $request->validate([
            'student_id' => 'required|exists:student_payment_details,id',
            'amount'     => 'required|numeric|min:1',
            'emi_type'   => 'nullable|in:EMI1,EMI2,EMI3,FULL',   // optional, used if the frontend sends it
        ]);
    
        $student        = StudentPayemntDetails::findOrFail($request->student_id);
        $selectedAmount = (float) $request->amount;
    
        \Log::info('Student fetched', [
            'id' => $student->id,
            'name' => $student->student_name,
            'amounts' => [
                'emi_1' => $student->emi_1,
                'emi_2' => $student->emi_2,
                'emi_3' => $student->emi_3,
                'full'  => $student->amount
            ]
        ]);
    
        // 🚫 Block if the whole fee is already settled
        if ($student->pay_status == 1 || $student->status === 'paid' || !empty($student->fullamount_details)) {
            return response()->json([
                'status'  => false,
                'message' => 'Payment already completed for this student.',
            ]);
        }
    
        // ✅ Resolve EMI type: first UNPAID instalment whose amount matches
        //    (EMI1 paid + EMI2 same amount -> correctly resolves to EMI2)
        $emiType = $this->resolveEmiType($student, $selectedAmount, $request->emi_type);
    
        if (!$emiType) {
            return response()->json([
                'status'  => false,
                'message' => 'Amount does not match any unpaid instalment for this student.',
            ]);
        }
    
        // 🚫 Already-paid guard (matters when emi_type was passed explicitly)
        if (!empty($student->{self::EMI_MAP[$emiType]['details']})) {
            return response()->json([
                'status'  => false,
                'message' => "{$emiType} has already been paid.",
            ]);
        }
    
        \Log::info('Resolved EMI type', ['emiType' => $emiType, 'selectedAmount' => $selectedAmount]);
    
        // ✅ Store the decision — checkout / capture / failure read this, they never re-derive it
        $student->update([
            'emi_type'             => $emiType,
            'selected_amount'      => $selectedAmount,
            'payment_reference_id' => $student->payment_reference_id ?: 'PAY_' . strtoupper(Str::random(10)),
        ]);
        $student->refresh();
    
        \Log::info('Payment link prepared', [
            'student_id'      => $student->id,
            'emi_type'        => $emiType,
            'selected_amount' => $selectedAmount,
            'reference'       => $student->payment_reference_id,
        ]);
    
        $parentEmails   = array_filter([$student->father_email, $student->mother_email]);
        $parentMailSent = false;
    
        // ================= Parent Mail =================
        if (!empty($parentEmails)) {
            try {
                Mail::send('backend.student_admission.ecole_fees_pay_mail', [
                    'student'        => $student,
                    'paymentRef'     => $student->payment_reference_id,
                    'emiType'        => $emiType,
                    'selectedAmount' => $selectedAmount
                ], function ($mail) use ($parentEmails) {
                    $mail->to($parentEmails)
                         ->subject('Ecole Mondiale Fees Payment Link');
                });
    
                $parentMailSent = true;
    
                \Log::info('Parent email sent', [
                    'student_id' => $student->id,
                    'emails'     => $parentEmails
                ]);
            } catch (\Exception $e) {
                \Log::error('Parent email failed', [
                    'student_id' => $student->id,
                    'error'      => $e->getMessage()
                ]);
            }
        } else {
            \Log::warning('No parent emails found', ['student_id' => $student->id]);
        }
    
        // ================= Admin Mail (only after parent mail success) =================
        if ($parentMailSent) {
            try {
                $adminEmail = 'admission@ecolemondiale.org';
    
                Mail::send('backend.student_admission.ecole_fees_pay_admin_mail', [
                    'student'        => $student,
                    'paymentRef'     => $student->payment_reference_id,
                    'emiType'        => $emiType,
                    'selectedAmount' => $selectedAmount,
                    'parentEmails'   => $parentEmails
                ], function ($mail) use ($adminEmail, $student) {
                    $mail->to($adminEmail)
                         ->subject('Payment Link Sent - ' . $student->student_name);
                });
    
                \Log::info('Admin email sent', [
                    'student_id' => $student->id,
                    'admin'      => $adminEmail
                ]);
            } catch (\Exception $e) {
                // Admin mail failure should not break the flow
                \Log::error('Admin email failed', [
                    'student_id' => $student->id,
                    'error'      => $e->getMessage()
                ]);
            }
        }
    
        return response()->json([
            'status'         => $parentMailSent,
            'message'        => $parentMailSent ? 'Payment link sent successfully.' : 'Failed to send payment link.',
            'emiType'        => $emiType,
            'selectedAmount' => $selectedAmount
        ]);
    }


    public function razorpayCheckout(Request $request, $reference)
    {
        $payment = StudentPayemntDetails::where('payment_reference_id', $reference)->firstOrFail();
        
        
        /**
         * 🚫 BLOCK PAYMENT IF ALREADY COMPLETED
         */
        if ($payment->pay_status == 1 || $payment->status === 'paid') {
            return redirect()->route('payment.success.page')
                ->with('info', 'Payment already completed.');
        }
        
        /**
         * 🚫 BLOCK IF FULL AMOUNT ALREADY PAID (extra safety)
         */
        if (!empty($payment->fullamount_details)) {
            return redirect()->route('payment.success.page')
                ->with('info', 'Full payment already received.');
        }
    
        // ✅ Stored amount first; ?amount= only as fallback for links sent before this fix
        $orderAmount = (float) ($payment->selected_amount ?: $request->query('amount', 0));
    
        if ($orderAmount < 1) {
            return redirect()->route('payment.failed.page', ['reference' => $reference])
                ->with('error', 'Amount must be at least ₹1');
        }
    
        // ✅ Use stored EMI type; for older links resolve from the first unpaid matching instalment
        $emiType = $this->isValidEmiType($payment->emi_type)
            ? $payment->emi_type
            : $this->resolveEmiType($payment, $orderAmount);
    
        if (!$emiType) {
            return redirect()->route('payment.failed.page', ['reference' => $reference])
                ->with('error', 'This payment link is no longer valid. Please request a new link from the school.');
        }
    
        /**
         * 🚫 BLOCK IF THIS INSTALMENT IS ALREADY PAID (stale / re-used link)
         */
        if (!empty($payment->{self::EMI_MAP[$emiType]['details']})) {
            return redirect()->route('payment.success.page')
                ->with('info', "{$emiType} has already been paid.");
        }
    
        $api = new \Razorpay\Api\Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    
        $order = $api->order->create([
            'receipt' => $payment->payment_reference_id,
            'amount' => (int) round($orderAmount * 100),
            'currency' => 'INR',
            'payment_capture' => 0
        ]);
    
        $payment->update([
            'razorpay_order_id' => $order['id'],
            'selected_amount' => $orderAmount,
            'emi_type' => $emiType,
        ]);
    
        // 🔥 THIS IS THE KEY FIX
        $payment->refresh();
    
        return view(
            'backend.student_admission.razorpay_checkout',
            compact('payment', 'orderAmount')
        );
    }

    
    public function captureRazorpayPayment(Request $request)
    {
        Log::info('Razorpay capture hit', $request->all());
    
        $request->validate([
            'payment_reference_id' => 'required',
            'razorpay_payment_id'  => 'required',
            'razorpay_order_id'    => 'required',
            'razorpay_signature'   => 'required',
        ]);
    
        try {
            $payment = StudentPayemntDetails::where('payment_reference_id', $request->payment_reference_id)
                ->firstOrFail();
    
            // ✅ Use the EMI type stored at initiation — never re-derive from amount alone
            $selectedAmount = (float) $payment->selected_amount;
    
            $emiType = $this->isValidEmiType($payment->emi_type)
                ? $payment->emi_type
                : $this->resolveEmiType($payment, $selectedAmount);
    
            if (!$emiType) {
                throw new \Exception('Cannot determine EMI type for this payment');
            }
    
            $emiColumn = self::EMI_MAP[$emiType]['details'];
    
            // 🚫 Never overwrite an instalment that is already recorded as paid
            if (!empty($payment->$emiColumn)) {
                throw new \Exception("{$emiType} has already been recorded as paid");
            }
            
            $payment->update([
                'emi_type' => $emiType
            ]);

            Log::info('Starting Razorpay payment capture', [
                'reference' => $payment->payment_reference_id,
                'payment_id' => $request->razorpay_payment_id,
                'emi_type' => $emiType
            ]);
    
            $api = new \Razorpay\Api\Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );
    
            // Verify signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);
    
            $razorpayPayment = $api->payment->fetch($request->razorpay_payment_id);

            if ($razorpayPayment->order_id !== $request->razorpay_order_id) {   // ← request, not DB
                throw new \Exception('Order ID mismatch');
            }

            $payment->razorpay_order_id = $razorpayPayment->order_id;
            $payment->save();
            
            // Capture payment if authorized
            if ($razorpayPayment->status === 'authorized') {
                $captureAmount = (int) round($payment->selected_amount * 100); // Paise as integer
                Log::info('Capturing EMI amount', [
                    'emi_type' => $emiType,
                    'amount' => $captureAmount
                ]);
    
                $razorpayPayment = $razorpayPayment->capture([
                    'amount' => $captureAmount
                ]);
            }
    
            if ($razorpayPayment->status !== 'captured') {
                throw new \Exception('Payment not captured');
            }
    
            Log::info('Razorpay payment captured successfully', [
                'razorpay_data' => $razorpayPayment->toArray()
            ]);
    
            // Correct amount calculation
            $amount = $razorpayPayment->amount / 100; // total captured amount in INR
            $fee    = $razorpayPayment->fee ?? 0;    // in paise
            $tax    = $razorpayPayment->tax ?? 0;    // in paise
            
            $feeBreakup = [
                'base_amount' => $payment->selected_amount,          // ₹200,000
                'convenience_charges' => ($fee - $tax) / 100,       // fee before GST
                'gst_on_charges' => $tax / 100,                     // GST on fee
                'total_paid' => $amount,                            // total captured
            ];
    
    
            $invoiceNumber = 'INV-' . $emiType . '-' . time();
    
            $emiData = [
                'razorpay_payment_id' => $razorpayPayment->id,
                'razorpay_order_id'   => $payment->razorpay_order_id,
                'emi_type'            => $emiType,
                'amount'              => $payment->selected_amount,
                'fee_breakup'         => $feeBreakup,
                'invoice_number'      => $invoiceNumber,
                'paid_at'             => now(),
            ];
    
            // $emiColumn already resolved above from EMI_MAP
            $payment->$emiColumn = json_encode($emiData);
    
            // Total paid
            $totalPaid = 0;
            foreach (['emi1_details', 'emi2_details', 'emi3_details', 'fullamount_details'] as $col) {
                if (!empty($payment->$col)) {
                    $data = json_decode($payment->$col, true);
                    $totalPaid += $data['amount'] ?? 0;
                }
            }
    
            $isFullyPaid = $totalPaid >= $payment->amount;
    
            $payment->update([
                'amount_paid' => $totalPaid,
                'status' => $isFullyPaid ? 'paid' : 'partial_paid',
                'pay_status' => $isFullyPaid ? 1 : 0,
                'payment_date' => now(),
            ]);
    
            // PDF
            $pdf = Pdf::loadView('frontend.payment_invoice_pdf', [
                'payment' => $payment,
                'feeBreakup' => $feeBreakup,
                'emiType' => $emiType,
                'invoiceNumber' => $invoiceNumber,
            ]);
    
            $fileName = 'Payment_Receipt_' . $invoiceNumber . '.pdf';
            $filePath = public_path('invoices/' . $fileName);
    
            if (!file_exists(public_path('invoices'))) {
                mkdir(public_path('invoices'), 0755, true);
            }
    
            $pdf->save($filePath);
    
            // Send emails (use $payment instead of $student)
            $emails = array_filter([$payment->father_email, $payment->mother_email]);
    
            if ($emails) {
                Mail::send('frontend.payment_confirmation_mail', compact('payment', 'feeBreakup', 'emiType', 'invoiceNumber'), function ($mail) use ($emails, $filePath) {
                    $mail->to($emails)
                         ->subject('Payment Confirmation - Ecole Mondiale World School')
                         ->attach($filePath);
                });
    
                Mail::send('frontend.payment_admin_confirmation_mail', compact('payment', 'feeBreakup', 'emiType', 'invoiceNumber'), function ($mail) use ($filePath) {
                    $mail->to('admission@ecolemondiale.org')
                         ->subject('New EMI Payment Received')
                         ->attach($filePath);
                });
            }
    
            Log::info('Payment success stored', [
                'reference' => $payment->payment_reference_id,
                'emi_type' => $emiType,
                'amount' => $amount
            ]);
    
            return response()->json([
                'success' => true,
                'redirect_url' => route('payment.success.page')
            ]);
    
        } catch (\Exception $e) {
            Log::error('Razorpay payment capture failed', [
                'error' => $e->getMessage()
            ]);
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    
    public function paymentFailed($reference)
    {
        try {
    
            $payment = StudentPayemntDetails::where(
                'payment_reference_id',
                $reference
            )->firstOrFail();
    
            $payload = request()->all();
    
            Log::warning('Payment failed callback hit', [
                'reference'        => $reference,
                'db_emi_type'      => $payment->emi_type,
                'selected_amount'  => $payment->selected_amount,
                'emi_amounts'      => [
                    'emi1' => $payment->emi_1,
                    'emi2' => $payment->emi_2,
                    'emi3' => $payment->emi_3,
                    'full' => $payment->amount,
                ],
                'payload' => $payload,
            ]);
    
            /* ============================
               RESOLVE EMI TYPE
               (stored type first; fallback = first unpaid matching instalment)
            ============================ */
            $emiType = $this->isValidEmiType($payment->emi_type)
                ? $payment->emi_type
                : $this->resolveEmiType($payment, (float) $payment->selected_amount);
    
            Log::info('Resolved EMI type on failure', [
                'emi_type' => $emiType
            ]);
    
            /* ============================
               PREPARE FAILED JSON
            ============================ */
            $failedData = [
                'emi_type'            => $emiType,
                'selected_amount'     => $payment->selected_amount,
                'razorpay_order_id'   => $payment->razorpay_order_id,
                'razorpay_payment_id' => $payload['razorpay_payment_id'] ?? null,
                'reason'              => $payload,
                'failed_at'           => Carbon::now()->toDateTimeString(),
            ];
    
            /* ============================
               STORE IN CORRECT COLUMN
            ============================ */
            $failedCol = null;
    
            if ($emiType) {
                $failedCol = self::EMI_MAP[$emiType]['failed'];
                $payment->$failedCol = json_encode($failedData);
            } else {
                Log::error('Payment failed but EMI type could not be resolved', [
                    'reference' => $reference
                ]);
            }
    
            /* ============================
               UPDATE MASTER STATUS
            ============================ */
            $payment->status = $payment->amount_paid > 0
                ? 'partial_paid'
                : 'pending';
    
            $payment->pay_status = $payment->amount_paid > 0 ? 2 : 0;
    
     
            $payment->save();
    
            Log::warning('Failure stored successfully', [
                'stored_in' => $failedCol
            ]);
    
            return view(
                'backend.student_admission.payment_failed',
                compact('payment')
            );
    
        } catch (\Exception $e) {
    
            Log::error('Payment failed handler crashed', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
            ]);
    
            return redirect()
                ->route('payment.failed.page', ['reference' => $reference])
                ->with('error', 'Payment failed. Please try again.');
        }
    }
    

    
    public function updateEmi(Request $request)
    {

        $value = str_replace([',', '₹'], '', $request->value);
        $value = trim($value);
        
        
        // 1️⃣ Check if value is empty/null
        if ($value === '') {
            return response()->json([
                'status' => false,
                'msg' => 'EMI amount cannot be empty'
            ]);
        }
    
    
        if ($value !== '' && !ctype_digit($value)) {
            return response()->json([
                'status' => false,
                'msg' => 'Invalid number'
            ]);
        }
    
        $student = StudentPayemntDetails::find($request->id);
    
        if (!$student) {
            return response()->json(['status' => false, 'msg' => 'Student not found']);
        }
    
        // Convert all to integer
        $emi1 = (int) str_replace(',', '', $student->emi_1 ?? 0);
        $emi2 = (int) str_replace(',', '', $student->emi_2 ?? 0);
        $emi3 = (int) str_replace(',', '', $student->emi_3 ?? 0);
    
        $amount = (int) str_replace(',', '', $student->amount ?? 0);
    
        // Temporarily replace updated field
        if ($request->field === 'emi_1') $emi1 = (int)$value;
        if ($request->field === 'emi_2') $emi2 = (int)$value;
        if ($request->field === 'emi_3') $emi3 = (int)$value;
    
        $total = $emi1 + $emi2 + $emi3;
    
        // Condition 1: Greater than amount
        if ($total > $amount) {
            return response()->json([
                'status' => false,
                'msg' => 'Total EMI cannot be greater than Amount'
            ]);
        }
    
        // CHECK HOW MANY EMIs EXIST
        $emiCount = 0;
        if ($student->emi_1 !== null) $emiCount++;
        if ($student->emi_2 !== null) $emiCount++;
        if ($student->emi_3 !== null) $emiCount++;
    
        // LESS VALIDATION RULES
        $applyLessValidation = false;
    
        // If 2 EMIs → only EMI2 should trigger the "less than" validation
        if ($emiCount == 2 && $request->field === 'emi_2') {
            $applyLessValidation = true;
        }
    
        // If 3 EMIs → only EMI3 should trigger the "less than" validation
        if ($emiCount == 3 && $request->field === 'emi_3') {
            $applyLessValidation = true;
        }
    
        // Apply "less than amount" only when needed
        if ($applyLessValidation && $total < $amount) {
            return response()->json([
                'status' => false,
                'msg' => 'Total EMI cannot be less than Amount'
            ]);
        }
    
        // Save the valid EMI
        $student->{$request->field} = $value;
        $student->save();
    
        return response()->json([
            'status' => true,
            'value' => indian_number_format($value)
        ]);
    }








    
}