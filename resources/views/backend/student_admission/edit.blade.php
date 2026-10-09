<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Student Fees Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-student-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Student Fees Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Student Fees Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                   <form class="row g-3 needs-validation custom-input"
                                        novalidate
                                        action="{{ route('manage-student-details.update', $student->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        
                                        {{-- OVERALL STATUS --}}
                                        <h6 class="mb-2 fw-semibold">Fee Summary</h6>
                                        
                                        <table class="table table-sm text-center"
                                               style="border:2px solid #adb5bd; border-collapse: collapse;">
                                            <thead style="background:#f1f3f5;">
                                                <tr>
                                                    <th style="border:1px solid #dee2e6;">Status</th>
                                                    <th style="border:1px solid #dee2e6;">Total Fees (₹)</th>
                                                    <th style="border:1px solid #dee2e6;">Paid (₹)</th>
                                                    <th style="border:1px solid #dee2e6;">Balance (₹)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="border:1px solid #dee2e6; font-weight:600;">
                                                        {{ ucfirst(str_replace('_', ' ', $student->status)) }}
                                                    </td>
                                                    <td style="border:1px solid #dee2e6;">
                                                        {{ number_format($student->amount, 2) }}
                                                    </td>
                                                    <td style="border:1px solid #dee2e6;">
                                                        {{ number_format($student->amount_paid, 2) }}
                                                    </td>
                                                    <td style="border:1px solid #dee2e6; font-weight:600;">
                                                        {{ number_format($student->amount - $student->amount_paid, 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>



                                        <br><br><hr class="mt-5"><br>
                                        
                                        
                                        <div class="mb-3">
                                            <div style="background:#e2e6ea; color:#212529; padding:0.5rem 1rem; border-radius:0.25rem;">
                                                <h5 class="mb-0 fw-bold">Student Personal Details (Editable)</h5>
                                            </div>
                                        </div>

                                    
                                        <!-- YEAR -->
                                        <div class="col-md-4">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-control" name="year"
                                                   value="{{ old('year', $student->year) }}" required>
                                        </div>
                                    
                                        <!-- STUDENT NAME -->
                                        <div class="col-md-4">
                                            <label class="form-label">Student Name</label>
                                            <input type="text" class="form-control" name="student_name"
                                                   value="{{ old('student_name', $student->student_name) }}" required>
                                        </div>
                                    
                                        <!-- GRADE -->
                                        <div class="col-md-4">
                                            <label class="form-label">Grade</label>
                                            <input type="text" class="form-control" name="grade"
                                                   value="{{ old('grade', $student->grade) }}" required>
                                        </div>
                                    
                                        <!-- GR NO -->
                                        <div class="col-md-4">
                                            <label class="form-label">GR No</label>
                                            <input type="text" class="form-control" name="gr_no"
                                                   value="{{ old('gr_no', $student->gr_no) }}" required>
                                        </div>
                                    
                                        <!-- AMOUNT -->
                                        <div class="col-md-4">
                                            <label class="form-label">Amount</label>
                                            <input type="number" class="form-control" name="amount"
                                                   value="{{ old('amount', $student->amount) }}" required>
                                        </div>
                                    
                                        <!-- EMI 1 -->
                                        <div class="col-md-4">
                                            <label class="form-label">EMI 1</label>
                                            <input type="number" class="form-control" name="emi_1"
                                                   value="{{ old('emi_1', $student->emi_1) }}">
                                        </div>
                                    
                                        <!-- EMI 2 -->
                                        <div class="col-md-4">
                                            <label class="form-label">EMI 2</label>
                                            <input type="number" class="form-control" name="emi_2"
                                                   value="{{ old('emi_2', $student->emi_2) }}">
                                        </div>
                                    
                                        <!-- EMI 3 -->
                                        <div class="col-md-4">
                                            <label class="form-label">EMI 3</label>
                                            <input type="number" class="form-control" name="emi_3"
                                                   value="{{ old('emi_3', $student->emi_3) }}">
                                        </div>
                                    
                                        <!-- PARENT DETAILS -->
                                        <div class="col-md-4">
                                            <label class="form-label">Father Name</label>
                                            <input type="text" class="form-control" name="father_name"
                                                   value="{{ old('father_name', $student->father_name) }}" required>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <label class="form-label">Mother Name</label>
                                            <input type="text" class="form-control" name="mother_name"
                                                   value="{{ old('mother_name', $student->mother_name) }}" required>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <label class="form-label">Father Mobile</label>
                                            <input type="text" class="form-control" name="father_mobile"
                                                   value="{{ old('father_mobile', $student->father_mobile) }}" required>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <label class="form-label">Mother Mobile</label>
                                            <input type="text" class="form-control" name="mother_mobile"
                                                   value="{{ old('mother_mobile', $student->mother_mobile) }}" required>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Father Email</label>
                                            <input type="email" class="form-control" name="father_email"
                                                   value="{{ old('father_email', $student->father_email) }}" required>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Mother Email</label>
                                            <input type="email" class="form-control" name="mother_email"
                                                   value="{{ old('mother_email', $student->mother_email) }}" required>
                                        </div>
                                    
                                        <!-- ADDRESS -->
                                        <div class="col-md-12">
                                            <label class="form-label">Student Address</label>
                                            <textarea class="form-control" name="student_address" rows="3" required>{{ old('student_address', $student->student_address) }}</textarea>
                                        </div>



                                     
                                        <!-- ==================== PAYMENT DETAILS (READONLY FIELDS) ==================== -->
                                        
                                        
                                        @php
                                            $payments = [];
                                        
                                            if ($student->emi1_details) {
                                                $payments[] = json_decode($student->emi1_details, true);
                                            }
                                            if ($student->emi2_details) {
                                                $payments[] = json_decode($student->emi2_details, true);
                                            }
                                            if ($student->emi3_details) {
                                                $payments[] = json_decode($student->emi3_details, true);
                                            }
                                            if ($student->fullamount_details) {
                                                $payments[] = json_decode($student->fullamount_details, true);
                                            }
                                        @endphp



                                        @if(
                                            $student->emi1_details ||
                                            $student->emi2_details ||
                                            $student->emi3_details ||
                                            $student->fullamount_details
                                        )

                                        
                                           <br><br><hr><br>

                                            <div class="col-12 mt-5">
                                                <div style="background:#d6d9dc; color:#212529; padding:0.5rem 1rem; border-radius:0.25rem; margin-bottom:1rem;">
                                                    <h5 class="mb-0 fw-bold">Student Payment Details (Read-Only)</h5>
                                                </div>

                                            
                                                @foreach($payments as $index => $pay)
                                                
                                                
                                            
                                                    @php
                                                        $feeBreakup = $pay['fee_breakup'] ?? [];
                                                    @endphp
                                            
                                                    <div class="border rounded p-3 mb-4">
                                            
                                                        <h6 class="fw-bold text-success mb-3">
                                                            Payment Type: {{ $pay['emi_type'] ?? 'Payment' }} 
                                                        </h6>
                                            
                                                        <div class="row g-3 mt-2">
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Invoice Number</label>
                                                                <input class="form-control" value="{{ $pay['invoice_number'] ?? 'N/A' }}" readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Payment Reference</label>
                                                                <input class="form-control" value="{{ $student->payment_reference_id }}" readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Paid At</label>
                                                                <input class="form-control"
                                                                    value="{{ isset($pay['paid_at']) ? \Carbon\Carbon::parse($pay['paid_at'])->format('d/m/Y H:i') : 'N/A' }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Base Amount (₹)</label>
                                                                <input class="form-control"
                                                                    value="₹ {{ number_format($pay['amount'] ?? 0, 2) }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Convenience Charges (₹)</label>
                                                                <input class="form-control"
                                                                    value="₹ {{ number_format($feeBreakup['convenience_charges'] ?? 0, 2) }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">GST on Charges (₹)</label>
                                                                <input class="form-control"
                                                                    value="₹ {{ number_format($feeBreakup['gst_on_charges'] ?? 0, 2) }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Total Paid (₹)</label>
                                                                <input class="form-control"
                                                                    value="₹ {{ number_format($feeBreakup['total_paid'] ?? 0, 2) }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Razorpay Payment ID</label>
                                                                <input class="form-control"
                                                                    value="{{ $pay['razorpay_payment_id'] ?? 'N/A' }}"
                                                                    readonly>
                                                            </div>
                                            
                                                            <div class="col-md-4">
                                                                <label class="form-label">Payment Status</label>
                                                                <input class="form-control text-success" value="Captured" readonly>
                                                            </div>
                                            
                                                        </div>
                                                    </div>
                                            
                                                @endforeach
                                            
                                               
                                            </div>

                                        @endif




                                    
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-student-details.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary px-4" type="submit">Update</button>
                                        </div>
                                    
                                    </form>



                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>
       
       @include('components.backend.main-js')
       
      
</body>

</html>