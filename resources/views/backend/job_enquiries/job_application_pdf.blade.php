<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Application - {{ $application->name }}</title>
    <style>
        @page { margin: 40px 35px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.5;
        }

        /* ====== Headings ====== */
        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1f3c88;
            border-bottom: 2px solid #1f3c88;
            padding-bottom: 6px;
        }

        h4 {
            margin-top: 28px;
            background-color: #eef1f7;
            padding: 7px 10px;
            border-left: 5px solid #1f3c88;
            color: #1f3c88;
            font-size: 13px;
            letter-spacing: 0.3px;
        }

        /* ====== Tables ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8f9fc;
            font-weight: bold;
            width: 30%;
        }

        tr:nth-child(even) td {
            background-color: #fafbfe;
        }

        .small { font-size: 11px; color: #666; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* ====== Photo section ====== */
        .photo-container {
            text-align: right;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .photo {
            width: 120px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 3px;
        }

        .photo-label {
            font-size: 11px;
            margin-top: 5px;
            color: #555;
        }

        /* ====== Layout tweaks ====== */
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .header {
            background-color: #f2f5f8;
            padding: 20px;
            text-align: center;
        }
        .header img {
            width: 160px;
        }
        
    </style>
</head>
<body>
    
    
     <!-- Header -->
    <div class="header">
        <img src="data:image/png;base64,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"
         
        alt="Ã‰cole Mondiale Logo"
        style="max-width:140px; height:auto; display:block; margin-bottom:8px;">
    </div>
    

    {{-- ===== Main Heading ===== --}}
    <h2>Job Application Details</h2>

    {{-- ===== Applicant Photo ===== --}}
     @if(!empty($application->photo_path))
        <div class="photo-container">
            <img src="{{ asset(ltrim($application->photo_path, '/')) }}"
                 alt="Applicant Photo"
                 class="photo">
            <div class="photo-label">Applicant Photo</div>
        </div>
    @endif


    {{-- ===== Basic Details ===== --}}
    <h4>Basic Details</h4>
    <table>
        <tr><th>Application Type</th><td>{{ $application->apply == 1 ? 'Teaching' : 'Non-Teaching' }}</td></tr>
        <tr><th>Applicant Name</th><td>{{ $application->name ?? '-' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ $application->dob ? \Carbon\Carbon::parse($application->dob)->format('d M, Y') : '-' }}</td></tr>
        <tr><th>Gender</th><td>{{ ucfirst($application->gender ?? '-') }}</td></tr>
        <tr><th>Marital Status</th><td>{{ $application->marital_status ?? '-' }}</td></tr>
        <tr><th>Nationality</th><td>{{ $application->nationality_name ?? '-' }}</td></tr>
        <tr><th>Notice Period</th><td>{{ $application->notice_period ?? '-' }}</td></tr>
        <tr><th>Current Salary</th><td>{{ $application->current_salary ? indian_number_format($application->current_salary) : '-' }}</td></tr>
        <tr><th>Expected Salary</th><td>{{ $application->expected_salary ? indian_number_format($application->expected_salary) : '-' }}</td></tr>
        <tr><th>Position Applied</th><td>{{ $application->job_role ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $application->email ?? '-' }}</td></tr>
        <tr><th>Mobile</th><td>{{ $application->mobile_no ?? '-' }}</td></tr>
        <tr><th>Current Address</th><td>{{ $application->current_address ?? '-' }}</td></tr>
        <tr><th>Permanent Address</th><td>{{ $application->permanent_address ?? '-' }}</td></tr>
    </table>

    {{-- ===== Passport Details ===== --}}
    <h4>Passport Details</h4>
    <table>
        <tr><th>Skype ID</th><td>{{ $application->skype_id ?? '-' }}</td></tr>
        <tr><th>Passport No</th><td>{{ $application->passport_no ?? '-' }}</td></tr>
        <tr><th>Issue Place</th><td>{{ $application->passport_issue_place ?? '-' }}</td></tr>
        <tr><th>Issue Date</th><td>{{ $application->passport_issue_date ? \Carbon\Carbon::parse($application->passport_issue_date)->format('d M, Y') : '-' }}</td></tr>
        <tr><th>Expiry Date</th><td>{{ $application->passport_expiry_date ? \Carbon\Carbon::parse($application->passport_expiry_date)->format('d M, Y') : '-' }}</td></tr>
    </table>




    {{-- ===== Education ===== --}}
    <h4>Educational Details</h4>

    @php
        $educationRows = [];
    
        if (!empty($application->education)) {
    
            $edu = $application->education;
    
            // NEW FORMAT: array of objects
            if (isset($edu[0]) && is_array($edu[0])) {
                foreach ($edu as $row) {
                    $educationRows[] = [
                        'degree'      => $row['sp_subject'] ?? '-',
                        'institution' => $row['university'] ?? '-',
                        'start_date'  => $row['start_date'] ?? '-',
                        'end_date'    => $row['completion_date'] ?? '-',
                        'grade'       => $row['grade'] ?? '-',
                        'percentage'  => $row['percentage'] ?? '-',
                    ];
                }
            }
    
            // OLD FORMAT: object of arrays
            elseif (isset($edu['university']) && is_array($edu['university'])) {
                $count = count($edu['university']);
                for ($i = 0; $i < $count; $i++) {
                    $educationRows[] = [
                        'degree'      => $edu['sp_subject'][$i] ?? '-',
                        'institution' => $edu['university'][$i] ?? '-',
                        'start_date'  => $edu['start_date'][$i] ?? '-',
                        'end_date'    => $edu['completion_date'][$i] ?? '-',
                        'grade'       => $edu['grade'][$i] ?? '-',
                        'percentage'  => $edu['percentage'][$i] ?? '-',
                    ];
                }
            }
        }
    @endphp
    
    @if(!empty($educationRows))
    <table>
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
                <td>{{ $row['degree'] }}</td>
                <td>{{ $row['institution'] }}</td>
                <td>{{ $row['start_date'] }}</td>
                <td>{{ $row['end_date'] }}</td>
                <td>{{ $row['grade'] }}</td>
                <td>{{ $row['percentage'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="small">-</p>
    @endif




    {{-- ===== PD Courses Attended ===== --}}
    <h4>Professional Development Courses Attended</h4>

    @php
        $attendedRows = [];
    
        if (!empty($application->pd_courses_attended)) {
            $data = $application->pd_courses_attended;
    
            if (isset($data[0])) {
                foreach ($data as $row) {
                    $attendedRows[] = [
                        'attended' => $row['attended'] ?? '-',
                        'course'   => $row['course'] ?? '-',
                        'start'    => $row['start_date'] ?? '-',
                        'end'      => $row['completion_date'] ?? '-',
                        'location' => $row['location'] ?? '-',
                    ];
                }
            }
            elseif (isset($data['course'])) {
                $count = count($data['course']);
                for ($i = 0; $i < $count; $i++) {
                    $attendedRows[] = [
                        'attended' => $data['attended'][$i] ?? '-',
                        'course'   => $data['course'][$i] ?? '-',
                        'start'    => $data['start_date'][$i] ?? '-',
                        'end'      => $data['completion_date'][$i] ?? '-',
                        'location' => $data['location'][$i] ?? '-',
                    ];
                }
            }
        }
    @endphp
    
    @if(!empty($attendedRows))
    <table>
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
            @foreach($attendedRows as $row)
            <tr>
                <td>{{ $row['attended'] }}</td>
                <td>{{ $row['course'] }}</td>
                <td>{{ $row['start'] }}</td>
                <td>{{ $row['end'] }}</td>
                <td>{{ $row['location'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="small">-</p>
    @endif




    {{-- ===== PD Courses Conducted ===== --}}
    
    @php
        $conductedRows = [];
    
        if (!empty($application->pd_courses_conducted)) {
            $data = $application->pd_courses_conducted;
    
            /*
            |--------------------------------------------------------------------------
            | NEW FORMAT: Array of objects
            |--------------------------------------------------------------------------
            */
            if (isset($data[0]) && is_array($data[0])) {
                foreach ($data as $row) {
                    $conductedRows[] = [
                        'attended' => $row['attended'] ?? '-',
                        'course' => $row['course'] ?? '-',
                        'start_date' => $row['start_date'] ?? '-',
                        'completion_date' => $row['completion_date'] ?? '-',
                        'location' => $row['location'] ?? '-',
                    ];
                }
            }
    
            /*
            |--------------------------------------------------------------------------
            | OLD FORMAT: Object of arrays
            |--------------------------------------------------------------------------
            */
            elseif (isset($data['course']) && is_array($data['course'])) {
                $count = count($data['course']);
    
                for ($i = 0; $i < $count; $i++) {
                    $conductedRows[] = [
                        'attended' => $data['attended'][$i] ?? '-',
                        'course' => $data['course'][$i] ?? '-',
                        'start_date' => $data['start_date'][$i] ?? '-',
                        'completion_date' => $data['completion_date'][$i] ?? '-',
                        'location' => $data['location'][$i] ?? '-',
                    ];
                }
            }
        }
    @endphp
    
    <h4>Professional Development Courses Conducted</h4>
    
    @if(!empty($conductedRows))
        <table>
            <thead>
                <tr>
                    <th>Conducted</th>
                    <th>Course</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conductedRows as $row)
                    <tr>
                        <td>{{ $row['attended'] ?: '-' }}</td>
                        <td>{{ $row['course'] ?: '-' }}</td>
                        <td>{{ $row['start_date'] ?: '-' }}</td>
                        <td>{{ $row['completion_date'] ?: '-' }}</td>
                        <td>{{ $row['location'] ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="small">No PD courses conducted listed.</p>
    @endif




    {{-- ===== Publications / Research Papers / Documents ===== --}}
   <h4>Publications / Research Papers / Documents (in the last 5 years)</h4>

    @php
        $publicationRows = [];
    
        if (!empty($application->publications)) {
    
            $data = $application->publications;
    
            /*
            |--------------------------------------------------------------------------
            | NEW FORMAT: Array of objects
            |--------------------------------------------------------------------------
            */
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                foreach ($data as $row) {
                    $publicationRows[] = [
                        'title' => $row['title'] ?? '-',
                        'publish_in' => $row['publish_in'] ?? '-',
                        'publish_date' => $row['publish_date'] ?? '-',
                        'presented_at' => $row['presented_at'] ?? '-',
                        'presentation_date' => $row['presentation_date'] ?? '-',
                    ];
                }
            }
    
            /*
            |--------------------------------------------------------------------------
            | OLD FORMAT: stdClass (object of arrays)
            |--------------------------------------------------------------------------
            */
            else {
                // Convert stdClass → array
                $data = json_decode(json_encode($data), true);
    
                if (isset($data['title']) && is_array($data['title'])) {
                    $count = count($data['title']);
    
                    for ($i = 0; $i < $count; $i++) {
                        $publicationRows[] = [
                            'title' => $data['title'][$i] ?? '-',
                            'publish_in' => $data['publish_in'][$i] ?? '-',
                            'publish_date' => $data['publish_date'][$i] ?? '-',
                            'presented_at' => $data['presented_at'][$i] ?? '-',
                            'presentation_date' => $data['presentation_date'][$i] ?? '-',
                        ];
                    }
                }
            }
        }
    @endphp
    
    @if(!empty($publicationRows))
        <table>
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
                @foreach($publicationRows as $row)
                    <tr>
                        <td>{{ $row['title'] }}</td>
                        <td>{{ $row['publish_in'] }}</td>
                        <td>{{ $row['publish_date'] }}</td>
                        <td>{{ $row['presented_at'] }}</td>
                        <td>{{ $row['presentation_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="small">No publications or research papers listed.</p>
    @endif





    {{-- ===== Referees ===== --}}
    <h4>Confidential Referees</h4>

    @php
        $refereeRows = [];
    
        if (!empty($application->referees)) {
    
            $data = $application->referees;
    
            /*
            |--------------------------------------------------------------------------
            | NEW FORMAT: Array of objects
            |--------------------------------------------------------------------------
            */
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                foreach ($data as $row) {
                    $refereeRows[] = [
                        'name'        => $row['name'] ?? '-',
                        'designation' => $row['designation'] ?? '-',
                        'phone'       => $row['phone'] ?? '-',
                        'email'       => $row['email'] ?? '-',
                        'address'     => $row['address'] ?? '-',
                    ];
                }
            }
    
            /*
            |--------------------------------------------------------------------------
            | OLD FORMAT: stdClass (object of arrays)
            |--------------------------------------------------------------------------
            */
            else {
                // Convert stdClass → array
                $data = json_decode(json_encode($data), true);
    
                if (isset($data['name']) && is_array($data['name'])) {
                    $count = count($data['name']);
    
                    for ($i = 0; $i < $count; $i++) {
                        $refereeRows[] = [
                            'name'        => $data['name'][$i] ?? '-',
                            'designation' => $data['designation'][$i] ?? '-',
                            'phone'       => $data['phone'][$i] ?? '-',
                            'email'       => $data['email'][$i] ?? '-',
                            'address'     => $data['address'][$i] ?? '-',
                        ];
                    }
                }
            }
        }
    @endphp
    
    
    @if(!empty($refereeRows))
        <table>
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
                @foreach($refereeRows as $row)
                    <tr>
                        <td>{{ $row['name'] }}</td>
                        <td>{{ $row['designation'] }}</td>
                        <td>{{ $row['phone'] }}</td>
                        <td>{{ $row['email'] }}</td>
                        <td>{{ $row['address'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="small">No referees provided.</p>
    @endif



    <!-- ===== Employment Details ===== -->
    <h4 style="margin-top:30px;">Employment Details</h4>
    @php
        $employmentRows = [];
        
        if (!empty($application->employment)) {
        
            $data = $application->employment;
        
            // 🔥 Decode repeatedly until we get an array
            while (is_string($data)) {
                $decoded = json_decode($data, true);
        
                if (json_last_error() !== JSON_ERROR_NONE) {
                    break;
                }
        
                $data = $decoded;
            }
        
            if (!is_array($data)) {
                $data = [];
            }
        
            /*
            |--------------------------------------------------------------------------
            | FORMAT 1: Array of objects (OLD DATA)
            |--------------------------------------------------------------------------
            */
            if (isset($data[0]) && is_array($data[0])) {
                foreach ($data as $row) {
                    $employmentRows[] = [
                        'organization' => $row['organization'] ?? '-',
                        'designation'  => $row['desgination'] ?? '-',
                        'joining_date' => $row['joining_date'] ?? '-',
                        'leaving_date' => $row['leaving_date'] ?? '-',
                        'subject'      => $row['subject_taught'] ?? '-',
                        'curriculum'   => $row['curriculum'] ?? '-',
                        'additional'   => $row['add_responsibility'] ?? '-',
                        'reason'       => $row['reason_leaving'] ?? '-',
                    ];
                }
            }
        
            /*
            |--------------------------------------------------------------------------
            | FORMAT 2: Object of arrays (NEW DATA)
            |--------------------------------------------------------------------------
            */
            elseif (isset($data['school_organization']) && is_array($data['school_organization'])) {
                $count = count($data['school_organization']);
        
                for ($i = 0; $i < $count; $i++) {
                    $employmentRows[] = [
                        'organization' => $data['school_organization'][$i] ?? '-',
                        'designation'  => $data['designation'][$i] ?? '-',
                        'joining_date' => $data['date_joining'][$i] ?? '-',
                        'leaving_date' => $data['date_leaving'][$i] ?? '-',
                        'subject'      => $data['subject_taught'][$i] ?? '-',
                        'curriculum'   => $data['curriculum'][$i] ?? '-',
                        'additional'   => $data['additional_responsibility'][$i] ?? '-',
                        'reason'       => $data['reason_of_leaving'][$i] ?? '-',
                    ];
                }
            }
        }
        @endphp



    @if(!empty($employmentRows))
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
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
            @foreach($employmentRows as $row)
                <tr>
                    <td>{{ $row['organization'] }}</td>
                    <td>{{ $row['designation'] }}</td>
                    <td>{{ $row['joining_date'] }}</td>
                    <td>{{ $row['leaving_date'] }}</td>
                    <td>{{ $row['subject'] }}</td>
                    <td>{{ $row['curriculum'] }}</td>
                    <td>{{ $row['additional'] }}</td>
                    <td>{{ $row['reason'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>-</p>
    @endif




    <!-- ===== IT Skills & Interests ===== -->
    <h4 style="margin-top:30px;">IT Skills & Interests</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th>IT Skills</th>
            <td>{{ $application->it_skills ?? '-' }}</td>
        </tr>
        <tr>
            <th>Interests</th>
            <td>{{ $application->hobbies ?? '-' }}</td>
        </tr>
        <tr>
            <th>Language Skills</th>
            <td>{{ $application->language_skills ?? '-' }}</td>
        </tr>
        <tr>
            <th>Philosophy</th>
            <td>{{ $application->philosophy ?? '-' }}</td>
        </tr>
        <tr>
            <th>Other Information</th>
            <td>{{ $application->other_information ?? '-' }}</td>
        </tr>
        <tr>
            <th>Resume</th>
            <td>
                @if($application->resume_path && file_exists(public_path($application->resume_path)))
                    <a href="{{ asset($application->resume_path) }}" target="_blank">View Resume</a>
                @else
                    -
                @endif
            </td>
        </tr>

    </table>
    


    {{-- ===== Additional Info ===== --}}
    <h4>Additional Information</h4>
    <table>
        <tr><th>Experience (Years)</th><td>{{ $application->experience_years ?? '-' }}</td></tr>
        <tr><th>Experience (Months)</th><td>{{ $application->experience_months ?? '-' }}</td></tr>
        <tr><th>IT Skills</th><td>{{ $application->it_skills ?? '-' }}</td></tr>
        <tr><th>Hobbies / Interests</th><td>{{ $application->hobbies ?? '-' }}</td></tr>
        <tr><th>Language Skills</th><td>{{ $application->language_skills ?? '-' }}</td></tr>
        <tr><th>Philosophy</th><td>{{ $application->philosophy ?? '-' }}</td></tr>
        <tr><th>Other Information</th><td>{{ $application->other_information ?? '-' }}</td></tr>
    </table>
    
    
    
    <!-- ===== Other Details ===== -->
    <h4 style="margin-top:20px;">Other Details</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th>Experience in International Schools</th>
            <td>{{ $application->experience_international_schools ?? '-' }}</td>
        </tr>
        <tr>
            <th>Supervisor Concern</th>
            <td>{{ $application->supervisor_concern ?? '-' }}</td>
        </tr>
        <tr>
            <th>Direct Experience In</th>
            <td>{{ $application->direct_experience_in ?? '-' }}</td>
        </tr>
        <tr>
            <th>Current Employer</th>
            <td>{{ $application->current_employer ?? '-' }}</td>
        </tr>
        <tr>
            <th>Current Designation</th>
            <td>{{ $application->current_designation ?? '-' }}</td>
        </tr>
        <tr>
            <th>Years of Experience</th>
            <td>{{ $application->experience_years ?? '-' }}</td>
        </tr>
        <tr>
            <th>Months of Experience</th>
            <td>{{ $application->experience_months ?? '-' }}</td>
        </tr>
    </table>


    

    {{-- ===== Footer ===== --}}
    <p class="text-right small">Generated on {{ now()->format('d M Y, h:i A') }}</p>

</body>
</html>
