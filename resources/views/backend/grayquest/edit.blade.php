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
                    <a href="{{ route('manage-grayquest-student.index') }}">Home</a>
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
                                        action="{{ route('manage-grayquest-student.update', $student->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        
                                        <div class="mb-3">
                                            <div class="bg-primary text-white px-3 py-2 rounded-top">
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
                                        <!--<div class="col-md-4">-->
                                        <!--    <label class="form-label">EMI 1</label>-->
                                        <!--    <input type="number" class="form-control" name="emi_1"-->
                                        <!--           value="{{ old('emi_1', $student->emi_1) }}">-->
                                        <!--</div>-->
                                    
                                        <!-- EMI 2 -->
                                        <!--<div class="col-md-4">-->
                                        <!--    <label class="form-label">EMI 2</label>-->
                                        <!--    <input type="number" class="form-control" name="emi_2"-->
                                        <!--           value="{{ old('emi_2', $student->emi_2) }}">-->
                                        <!--</div>-->
                                    
                                        <!-- EMI 3 -->
                                        <!--<div class="col-md-4">-->
                                        <!--    <label class="form-label">EMI 3</label>-->
                                        <!--    <input type="number" class="form-control" name="emi_3"-->
                                        <!--           value="{{ old('emi_3', $student->emi_3) }}">-->
                                        <!--</div>-->
                                    
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
                                        {{-- ==================== GRAYQUEST DETAILS (READ ONLY) ==================== --}}
                                        @if($student->gq_student_id || $student->gq_application_id)
                                        
                                            <br><hr><br>
                                        
                                            <div class="col-12">
                                                <div class="bg-primary text-white px-3 py-2 rounded-top">
                                                    <h5 class="mb-0 fw-bold">GrayQuest EMI Details (Read-Only)</h5>
                                                </div>
                                            </div>
                                        
                                            <!-- GQ STUDENT ID -->
                                            <div class="col-md-4">
                                                <label class="form-label">GQ Student ID</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_student_id ?? 'N/A' }}" readonly>
                                            </div>
                                        
                                            <!-- GQ APPLICATION ID -->
                                            <div class="col-md-4">
                                                <label class="form-label">GQ Application ID</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_application_id ?? 'N/A' }}" readonly>
                                            </div>
                                        
                                            <!-- GQ REFERENCE ID -->
                                            <div class="col-md-4">
                                                <label class="form-label">GQ Reference ID</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_reference_id ?? 'N/A' }}" readonly>
                                            </div>
                                        
                                            <!-- EMI STATUS -->
                                            <div class="col-md-4">
                                                <label class="form-label">EMI Status</label>
                                                <input type="text"
                                                       class="form-control fw-bold
                                                       @if($student->gq_emi_status === 'LOAN_LIVE') text-success
                                                       @elseif(in_array($student->gq_emi_status, ['REJECTED','INSTITUTE_REJECT'])) text-danger
                                                       @else text-warning
                                                       @endif"
                                                       value="{{ $student->gq_emi_status ?? 'N/A' }}"
                                                       readonly>
                                            </div>
                                        
                                            <!-- LAST EVENT -->
                                            <div class="col-md-4">
                                                <label class="form-label">Last GrayQuest Event</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_last_event ?? 'N/A' }}" readonly>
                                            </div>
                                        
                                            <!-- SEND STATUS -->
                                            <div class="col-md-4">
                                                <label class="form-label">Mail Status</label>
                                                <input type="text"
                                                       class="form-control fw-bold {{ $student->gq_send_status == 1 ? 'text-success' : 'text-secondary' }}"
                                                       value="{{ $student->gq_send_status == 1 ? 'Sent' : 'Pending' }}"
                                                       readonly>
                                            </div>
                                        
                                            <!-- DISBURSED AT -->
                                            <div class="col-md-4">
                                                <label class="form-label">Disbursed At</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_disbursed_at
                                                            ? \Carbon\Carbon::parse($student->gq_disbursed_at)->format('d/m/Y H:i')
                                                            : 'Not Disbursed' }}"
                                                       readonly>
                                            </div>
                                        
                                            <!-- GQ AMOUNT -->
                                            <div class="col-md-4">
                                                <label class="form-label">GrayQuest Amount (₹)</label>
                                                <input type="text" class="form-control"
                                                       value="₹ {{ number_format($student->gq_amount ?? 0, 2) }}"
                                                       readonly>
                                            </div>
                                        
                                            <!-- CUSTOMER CODE -->
                                            <div class="col-md-4">
                                                <label class="form-label">Customer Code</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $student->gq_customer_code ?? 'N/A' }}"
                                                       readonly>
                                            </div>
                                        
                                        @endif




                                    
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-grayquest-student.index') }}" class="btn btn-danger px-4">Cancel</a>
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