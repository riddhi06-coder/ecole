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
                  <h4>Student Details</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-addmission-enquiries.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Student Details</li>
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
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">

                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">

                                    <form class="row g-3 custom-input">
                                        @php
                                            $grades = [
                                                1 => 'Playschool', 2 => 'Nursery', 3 => 'Kindergarten 1', 4 => 'Kindergarten 2',
                                                5 => 'Grade 1', 6 => 'Grade 2', 7 => 'Grade 3', 8 => 'Grade 4', 9 => 'Grade 5',
                                                10 => 'Grade 6', 11 => 'Grade 7', 12 => 'Grade 8', 13 => 'Grade 9', 14 => 'Grade 10',
                                                15 => 'Grade 11', 16 => 'Grade 12', 17 => 'Not Applicable'
                                            ];

                                            $father = $admission->father_details ? json_decode($admission->father_details, true) : [];
                                            $mother = $admission->mother_details ? json_decode($admission->mother_details, true) : [];

                                            // ✅ Determine Form Type cleanly
                                            $formType = $admission->form_type == 1 ? 'Application for Admission' :
                                                        ($admission->form_type == 2 ? 'Schedule a Visit' :
                                                        ($admission->form_type == 3 ? 'Enquiry for Admission' : '-'));


                                            $passportType = $admission->passport_type == 1 ? 'Indian Passport' :
                                            ($admission->passport_type == 2 ? 'Foreign Passport' : 'NA');

                                            $foreignPassportType = $admission->foregin_passport_type == 1 ? 'OCI' :
                                            ($admission->foregin_passport_type == 2 ? 'PIO' :
                                            ($admission->foregin_passport_type == 3 ? 'Not Applicable' : '-'));

                                        @endphp

                                        <!-- Form Type -->
                                        <div class="col-md-6">
                                            <label class="form-label">Form Type</label>
                                            <input type="text" class="form-control" readonly value="{{ $formType }}">
                                        </div>

                                        <!-- Student Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Student Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->student_name ?? '-' }}">
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="col-md-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->dob ? \Carbon\Carbon::parse($admission->dob)->format('d M, Y') : '-' }}">
                                        </div>

                                        <!-- Address -->
                                        <div class="col-md-6">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->address ?? '-' }}">
                                        </div>

                                        <!-- City -->
                                        <div class="col-md-6">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->city ?? '-' }}">
                                        </div>

                                        <!-- Pincode -->
                                        <div class="col-md-6">
                                            <label class="form-label">Pincode</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->pincode ?? '-' }}">
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-6">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->country_name ?? '-' }}">
                                        </div>

                                        <!-- Nationality -->
                                        <div class="col-md-6">
                                            <label class="form-label">Nationality</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->nationality_name ?? '-' }}">
                                        </div>

                                        <!-- Present School -->
                                        <div class="col-md-6">
                                            <label class="form-label">Present School</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->present_school ?? '-' }}">
                                        </div>

                                        <!-- Year -->
                                        <div class="col-md-6">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->year ?? '-' }}">
                                        </div>


                                        <!-- Current Grade -->
                                        <div class="col-md-6">
                                            <label class="form-label">Current Grade</label>
                                            <input type="text" class="form-control" readonly value="{{ $grades[$admission->grade] ?? '-' }}">
                                        </div>

                                    
                                        <!-- Joining Grade -->
                                        <div class="col-md-6">
                                            <label class="form-label">Joining Grade</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->join_grade_name ?? '-' }}">
                                        </div>


                                        <hr class="mt-5">

                                        <!-- Father Details -->
                                        <h3 class="mt-3">Father Details</h3>

                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['name'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" readonly value="{{ isset($father['mobile_code']) ? '+' . $father['mobile_code'] . ' ' . $father['mobile'] : '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['email'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['occupation'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['designation'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Organization</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['organization'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Office Telephone</label>
                                            <input type="text" class="form-control" readonly value="{{ isset($father['offtel_code']) ? '+' . $father['offtel_code'] . ' ' . $father['offtel'] : '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Office Address</label>
                                            <input type="text" class="form-control" readonly value="{{ $father['offadd'] ?? '-' }}">
                                        </div>

                                        <hr class="mt-4">

                                        <!-- Mother Details -->
                                        <h3 class="mt-3">Mother Details</h3>

                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['name'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" readonly value="{{ isset($mother['mobile_code']) ? '+' . $mother['mobile_code'] . ' ' . $mother['mobile'] : '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['email'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['occupation'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['designation'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Organization</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['organization'] ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Office Telephone</label>
                                            <input type="text" class="form-control" readonly value="{{ isset($mother['offtel_code']) ? '+' . $mother['offtel_code'] . ' ' . $mother['offtel'] : '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Office Address</label>
                                            <input type="text" class="form-control" readonly value="{{ $mother['offadd'] ?? '-' }}">
                                        </div>

                                        <hr class="mt-4">

                                        <!-- Other Info -->
                                        <div class="col-md-6">
                                            <label class="form-label">Passport Type</label>
                                            <input type="text" class="form-control" readonly value="{{ $passportType }}">
                                        </div>



                                        <div class="col-md-6">
                                            <label class="form-label">Foreign Passport Type</label>
                                            <input type="text" class="form-control" readonly value="{{ $foreignPassportType }}">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label">Specific Learning Needs</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->specific_learning ?? '-' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Heard From</label>
                                            <input type="text" class="form-control" readonly value="{{ $admission->heard_from ?? '-' }}">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Wish to Know</label>
                                            <textarea class="form-control" readonly rows="3">{{ $admission->wish_you_know ?? '-' }}</textarea>
                                        </div>

                                        <!-- Back Button -->
                                        <div class="col-12 text-end mt-4">
                                            <a href="{{ route('manage-addmission-enquiries.index') }}" class="btn btn-secondary px-4">← Back to List</a>
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