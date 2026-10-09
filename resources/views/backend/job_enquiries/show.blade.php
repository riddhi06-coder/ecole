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
                  <h4>Job Application Details</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-job-enquiries.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Job Application Details</li>
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
                        <h4>Job Application Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">

                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    
                           
                                    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                               
                                        <a href="{{ route('job-application.pdf', $application->id) }}"
                                           class="btn btn-primary btn-sm"
                                           target="_blank">
                                            <i class="fa fa-file-pdf me-1"></i> Download PDF
                                        </a>
                                    </div>
                                
                                                    

                                    <form class="row g-3 custom-input">

                                        <h4>#Basic Details</h4>
                                        
                                        <!-- Basic Details -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Application Type</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->apply == 1 ? 'Teaching' : 'Non-Teaching' }}">
                                        </div>
                                    
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Applicant Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->name ?? '-' }}">
                                        </div>
                                        

                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->dob ? \Carbon\Carbon::parse($application->dob)->format('d M, Y') : '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" readonly value="{{ ucfirst($application->gender) ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Marital Status</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->marital_status ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Nationality</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->nationality_name ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Notice Period</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->notice_period ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Current Salary</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->current_salary ? indian_number_format($application->current_salary) : '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Expected Salary</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->expected_salary ? indian_number_format($application->expected_salary) : '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Position Applied</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->job_role ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->email ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->mobile_no ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Current Address</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->current_address ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Permanent Address</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->permanent_address ?? '-' }}">
                                        </div>
                                    
                                    
                                    
                                        <div class="mt-5"></div><hr>
                                        <h4>#Passport Details</h4>
                                        
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Skype ID</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->skype_id ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Passport No</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->passport_no ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Passport Issue Place</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->passport_issue_place ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Passport Issue Date</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->passport_issue_date ? \Carbon\Carbon::parse($application->passport_issue_date)->format('d M, Y') : '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Passport Expiry Date</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->passport_expiry_date ? \Carbon\Carbon::parse($application->passport_expiry_date)->format('d M, Y') : '-' }}">
                                        </div>
                                    
                                        
                                        
                                        <div class="mt-5"></div><hr>
                                        <h4>#Educational Details</h4>
                                        
                                        @php
                                            $educationRows = [];
                                        
                                            if (!empty($application->education)) {
                                        
                                                // Handle double encoded JSON
                                                $decoded = json_decode($application->education, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                                        $educationRows[] = [
                                                            'sp_subject'      => $row['sp_subject'] ?? '-',
                                                            'university'      => $row['university'] ?? '-',
                                                            'start_date'      => $row['start_date'] ?? '-',
                                                            'completion_date' => $row['completion_date'] ?? '-',
                                                            'grade'           => $row['grade'] ?? '-',
                                                            'percentage'      => $row['percentage'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['university']) && is_array($decoded['university'])) {
                                                    $total = count($decoded['university']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                                        $educationRows[] = [
                                                            'sp_subject'      => $decoded['sp_subject'][$i] ?? '-',
                                                            'university'      => $decoded['university'][$i] ?? '-',
                                                            'start_date'      => $decoded['start_date'][$i] ?? '-',
                                                            'completion_date' => $decoded['completion_date'][$i] ?? '-',
                                                            'grade'           => $decoded['grade'][$i] ?? '-',
                                                            'percentage'      => $decoded['percentage'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp

                                        
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Education</label>
                                            @if(!empty($educationRows))
                                                <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Degree</th>
                                                        <th>Institution</th>
                                                        <th>Start Date</th>
                                                        <th>Completion Date</th>
                                                        <th>Grade</th>
                                                        <th>Percentage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($educationRows as $row)
                                                        <tr>
                                                            <td>{{ $row['sp_subject'] }}</td>
                                                            <td>{{ $row['university'] }}</td>
                                                            <td>{{ $row['start_date'] }}</td>
                                                            <td>{{ $row['completion_date'] }}</td>
                                                            <td>{{ $row['grade'] }}</td>
                                                            <td>{{ $row['percentage'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                                <span>-</span>
                                            @endif

                                        </div>

                                        
                                        
                                        <div class="mt-5"></div><hr>
                                        <h4>#PD Courses Attended Details</h4>
                                        
                                        <!-- PD Courses Attended -->
                                        <!-- PD Courses Attended -->
                                        @php
                                            $coursesRows = [];
                                        
                                            if (!empty($application->pd_courses_attended)) {
                                        
                                                // Handle double-encoded JSON
                                                $decoded = json_decode($application->pd_courses_attended, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                                        $coursesRows[] = [
                                                            'attended'        => $row['attended'] ?? '-',
                                                            'course'          => $row['course'] ?? '-',
                                                            'start_date'      => $row['start_date'] ?? '-',
                                                            'completion_date' => $row['completion_date'] ?? '-',
                                                            'location'        => $row['location'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['course']) && is_array($decoded['course'])) {
                                                    $total = count($decoded['course']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                                        $coursesRows[] = [
                                                            'attended'        => $decoded['attended'][$i] ?? '-',
                                                            'course'          => $decoded['course'][$i] ?? '-',
                                                            'start_date'      => $decoded['start_date'][$i] ?? '-',
                                                            'completion_date' => $decoded['completion_date'][$i] ?? '-',
                                                            'location'        => $decoded['location'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp

                                        
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Professional Development Courses Attended</label>
                                        
                                            @if(!empty($coursesRows))
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Attended</th>
                                                            <th>Course</th>
                                                            <th>Start Date</th>
                                                            <th>Completion Date</th>
                                                            <th>Location</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($coursesRows as $row)
                                                            <tr>
                                                                <td>{{ $row['attended'] }}</td>
                                                                <td>{{ $row['course'] }}</td>
                                                                <td>{{ $row['start_date'] }}</td>
                                                                <td>{{ $row['completion_date'] }}</td>
                                                                <td>{{ $row['location'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>


                                        
                                        
                                        <div class="mt-5"></div><hr>
                                        <h4>#PD Courses Conducted Details</h4>
                                        
                                        <!-- PD Courses Conducted -->
          
                                        @php
                                            $coursesConductedRows = [];
                                        
                                            if (!empty($application->pd_courses_conducted)) {
                                        
                                                // Handle double-encoded JSON
                                                $decoded = json_decode($application->pd_courses_conducted, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                        
                                                        // Skip fully empty rows (IMPORTANT FIX)
                                                        if (
                                                            empty($row['attended']) &&
                                                            empty($row['course']) &&
                                                            empty($row['start_date']) &&
                                                            empty($row['completion_date']) &&
                                                            empty($row['location'])
                                                        ) {
                                                            continue;
                                                        }
                                        
                                                        $coursesConductedRows[] = [
                                                            'attended'        => $row['attended'] ?? '-',
                                                            'course'          => $row['course'] ?? '-',
                                                            'start_date'      => $row['start_date'] ?? '-',
                                                            'completion_date' => $row['completion_date'] ?? '-',
                                                            'location'        => $row['location'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['course']) && is_array($decoded['course'])) {
                                        
                                                    $total = count($decoded['course']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                        
                                                        // Skip fully empty rows
                                                        if (
                                                            empty($decoded['attended'][$i]) &&
                                                            empty($decoded['course'][$i]) &&
                                                            empty($decoded['start_date'][$i]) &&
                                                            empty($decoded['completion_date'][$i]) &&
                                                            empty($decoded['location'][$i])
                                                        ) {
                                                            continue;
                                                        }
                                        
                                                        $coursesConductedRows[] = [
                                                            'attended'        => $decoded['attended'][$i] ?? '-',
                                                            'course'          => $decoded['course'][$i] ?? '-',
                                                            'start_date'      => $decoded['start_date'][$i] ?? '-',
                                                            'completion_date' => $decoded['completion_date'][$i] ?? '-',
                                                            'location'        => $decoded['location'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp
                                        
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Professional Development Courses Conducted</label>
                                        
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Attended</th>
                                                        <th>Course</th>
                                                        <th>Start Date</th>
                                                        <th>Completion Date</th>
                                                        <th>Location</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    @if(!empty($coursesConductedRows))
                                                        @foreach($coursesConductedRows as $row)
                                                            <tr>
                                                                <td>{{ $row['attended'] ?? '-' }}</td>
                                                                <td>{{ $row['course'] ?? '-' }}</td>
                                                                <td>{{ $row['start_date'] ?? '-' }}</td>
                                                                <td>{{ $row['completion_date'] ?? '-' }}</td>
                                                                <td>{{ $row['location'] ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        {{-- Show empty row --}}
                                                        <tr>
                                                            <td colspan="5" class="text-center">-</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>



                                        
                                        
                                        <div class="mt-5"></div><hr>
                                        <h4>#Publications/Research Papers/Documents produced (in the last 5 years) Details</h4>
                                        
                                        <!-- Publications -->
                                        
                                        
                                        @php
                                            $publicationRows = [];
                                        
                                            if (!empty($application->publications)) {
                                        
                                                $decoded = json_decode($application->publications, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                                        $publicationRows[] = [
                                                            'title'             => $row['title'] ?? '-',
                                                            'publish_in'        => $row['publish_in'] ?? '-',
                                                            'publish_date'      => $row['publish_date'] ?? '-',
                                                            'presented_at'      => $row['presented_at'] ?? '-',
                                                            'presentation_date' => $row['presentation_date'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['title']) && is_array($decoded['title'])) {
                                                    $total = count($decoded['title']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                                        $publicationRows[] = [
                                                            'title'             => $decoded['title'][$i] ?? '-',
                                                            'publish_in'        => $decoded['publish_in'][$i] ?? '-',
                                                            'publish_date'      => $decoded['publish_date'][$i] ?? '-',
                                                            'presented_at'      => $decoded['presented_at'][$i] ?? '-',
                                                            'presentation_date' => $decoded['presentation_date'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp


                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Publications</label>
                                        
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Publish In</th>
                                                        <th>Publish Date</th>
                                                        <th>Presented At</th>
                                                        <th>Presentation Date</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    @if(!empty($publicationRows))
                                                        @foreach($publicationRows as $row)
                                                            <tr>
                                                                <td>{{ $row['title'] }}</td>
                                                                <td>{{ $row['publish_in'] }}</td>
                                                                <td>{{ $row['publish_date'] }}</td>
                                                                <td>{{ $row['presented_at'] }}</td>
                                                                <td>{{ $row['presentation_date'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5" class="text-center">-</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>


                                        
                                        
                                        <div class="mt-5"></div><hr>
                                        <h4>#Confidential Referees Details</h4>
                                        
                                        <!-- Referees -->
                                        @php
                                            $refereeRows = [];
                                        
                                            if (!empty($application->referees)) {
                                        
                                                $decoded = json_decode($application->referees, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                                        $refereeRows[] = [
                                                            'name'        => $row['name'] ?? '-',
                                                            'designation' => $row['designation'] ?? '-',
                                                            'phone'       => $row['phone'] ?? '-',
                                                            'email'       => $row['email'] ?? '-',
                                                            'address'     => $row['address'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['name']) && is_array($decoded['name'])) {
                                                    $total = count($decoded['name']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                                        $refereeRows[] = [
                                                            'name'        => $decoded['name'][$i] ?? '-',
                                                            'designation' => $decoded['designation'][$i] ?? '-',
                                                            'phone'       => $decoded['phone'][$i] ?? '-',
                                                            'email'       => $decoded['email'][$i] ?? '-',
                                                            'address'     => $decoded['address'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp
                                        
                                                                                
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Referees</label>
                                        
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    @if(!empty($refereeRows))
                                                        @foreach($refereeRows as $row)
                                                            <tr>
                                                                <td>{{ $row['name'] }}</td>
                                                                <td>{{ $row['designation'] }}</td>
                                                                <td>{{ $row['phone'] }}</td>
                                                                <td>{{ $row['email'] }}</td>
                                                                <td>{{ $row['address'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5" class="text-center">-</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>




                                        <div class="mt-5"></div><hr>
                                        <h4>#Other Details</h4>
                                        
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Experience in International Schools</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->experience_international_schools ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label">Supervisor Concern</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->supervisor_concern ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Direct Experience In</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->direct_experience_in ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Current Employer</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->current_employer ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Current Designation</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->current_designation ?? '-' }}">
                                        </div>

                                
                                        <div class="col-md-6">
                                            <label class="form-label">Years of Experience</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->experience_years ?? '-' }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Months of Experience</label>
                                            <input type="text" class="form-control" readonly value="{{ $application->experience_months ?? '-' }}">
                                        </div>
                                    
                                    
                                    
                                        <div class="mt-5"></div><hr>
                                        <h4>#Employment Details</h4>
                                        
                                        
                                        @php
                                            $employmentRows = [];
                                        
                                            if (!empty($application->employment)) {
                                        
                                                $decoded = json_decode($application->employment, true);
                                                if (is_string($decoded)) {
                                                    $decoded = json_decode($decoded, true);
                                                }
                                        
                                                // ===============================
                                                // NEW FORMAT: Array of objects
                                                // ===============================
                                                if (isset($decoded[0]) && is_array($decoded[0])) {
                                                    foreach ($decoded as $row) {
                                                        $employmentRows[] = [
                                                            'organization'              => $row['organization'] ?? '-',
                                                            'designation'               => $row['desgination'] ?? ($row['designation'] ?? '-'),
                                                            'joining_date'              => $row['joining_date'] ?? '-',
                                                            'leaving_date'              => !empty($row['leaving_date']) ? $row['leaving_date'] : '-',
                                                            'subject_taught'             => $row['subject_taught'] ?? '-',
                                                            'curriculum'                => $row['curriculum'] ?? '-',
                                                            'additional_responsibility' => $row['add_responsibility'] ?? '-',
                                                            'reason_of_leaving'          => $row['reason_leaving'] ?? '-',
                                                        ];
                                                    }
                                                }
                                        
                                                // ===============================
                                                // OLD FORMAT: Object of arrays
                                                // ===============================
                                                elseif (isset($decoded['school_organization']) && is_array($decoded['school_organization'])) {
                                                    $total = count($decoded['school_organization']);
                                        
                                                    for ($i = 0; $i < $total; $i++) {
                                                        $employmentRows[] = [
                                                            'organization'              => $decoded['school_organization'][$i] ?? '-',
                                                            'designation'               => $decoded['designation'][$i] ?? '-',
                                                            'joining_date'              => $decoded['date_joining'][$i] ?? '-',
                                                            'leaving_date'              => $decoded['date_leaving'][$i] ?? '-',
                                                            'subject_taught'             => $decoded['subject_taught'][$i] ?? '-',
                                                            'curriculum'                => $decoded['curriculum'][$i] ?? '-',
                                                            'additional_responsibility' => $decoded['additional_responsibility'][$i] ?? '-',
                                                            'reason_of_leaving'          => $decoded['reason_of_leaving'][$i] ?? '-',
                                                        ];
                                                    }
                                                }
                                            }
                                        @endphp

                                        
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">Employment Details</label>
                                        
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>School / Organization</th>
                                                        <th>Designation</th>
                                                        <th>Date of Joining</th>
                                                        <th>Date of Leaving</th>
                                                        <th>Subject Taught</th>
                                                        <th>Curriculum</th>
                                                        <th>Additional Responsibility</th>
                                                        <th>Reason of Leaving</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    @if(!empty($employmentRows))
                                                        @foreach($employmentRows as $row)
                                                            <tr>
                                                                <td>{{ $row['organization'] }}</td>
                                                                <td>{{ $row['designation'] }}</td>
                                                                <td>{{ $row['joining_date'] }}</td>
                                                                <td>{{ $row['leaving_date'] }}</td>
                                                                <td>{{ $row['subject_taught'] }}</td>
                                                                <td>{{ $row['curriculum'] }}</td>
                                                                <td>{{ $row['additional_responsibility'] }}</td>
                                                                <td>{{ $row['reason_of_leaving'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8" class="text-center">-</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                           
                                    
                                    
                                        <div class="mt-5"></div><hr>
                                        <h4>#IT Skills & Interests Details</h4>
                                        
                                        <div class="col-md-12 mt-5">
                                            <label class="form-label">IT Skills</label>
                                            <textarea class="form-control" readonly rows="3">{{ $application->it_skills ?? '-' }}</textarea>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Interests</label>
                                            <textarea class="form-control" readonly rows="3">{{ $application->hobbies ?? '-' }}</textarea>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Language Skills</label>
                                            <textarea class="form-control" readonly rows="3">{{ $application->language_skills ?? '-' }}</textarea>
                                        </div>
                                    
                                    
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Philosophy</label>
                                            <textarea class="form-control" readonly rows="3">{{ $application->philosophy ?? '-' }}</textarea>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="form-label">Other Information</label>
                                            <textarea class="form-control" readonly rows="3">{{ $application->other_information ?? '-' }}</textarea>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label">Resume</label>
                                            @if($application->resume_path)
                                                <div class="d-flex flex-column align-items-start">
                                                    {{-- Clickable link --}}
                                                    <a href="{{ asset($application->resume_path) }}" target="_blank" class="mb-2 text-primary">
                                                        <i class="fa fa-file-pdf-o"></i> View Resume
                                                    </a>
                                        
                                                    {{-- Preview (iframe or icon depending on file type) --}}
                                                    @php
                                                        $fileExtension = pathinfo($application->resume_path, PATHINFO_EXTENSION);
                                                    @endphp
                                        
                                                    @if(in_array(strtolower($fileExtension), ['pdf']))
                                                        <iframe src="{{ asset($application->resume_path) }}" width="100%" height="200" style="border:1px solid #ddd; border-radius:5px;"></iframe>
                                                    @else
                                                        <img src="{{ asset($application->resume_path) }}" alt="Resume Preview" class="img-thumbnail" width="150">
                                                    @endif
                                                </div>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>

                                        
                                                                                
                                        {{-- Photo --}}
                                        <div class="col-md-6">
                                            <label class="form-label d-block">Photo</label>
                                        
                                            @if(!empty($application->photo_path))
                                                <img src="{{ asset(ltrim($application->photo_path, '/')) }}"
                                                     alt="Applicant Photo"
                                                     class="img-thumbnail"
                                                     style="max-width: 200px; height: auto;">
                                            @else
                                                <p>-</p>
                                            @endif
                                        </div>

                                    
                                    
                                        <!-- Back Button -->
                                        <div class="col-12 text-end mt-4">
                                            <a href="{{ route('manage-job-enquiries.index') }}" class="btn btn-secondary px-4">← Back to List</a>
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