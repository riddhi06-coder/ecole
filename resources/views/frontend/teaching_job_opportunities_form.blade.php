<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-career-breadcrumb-sec" style="background-image: url('{{ asset('uploads/careers/'.$teaching_job_opportunities_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Careers<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{ route('frontend.career_opportunities') }}">Career Opportunities<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>
        
        <section class="apply-for-admission-one-sec">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-12">
                <div class="apply-for-admission-content-sec">
                <p>Fill up the application form below. The mandatory fields are marked with an *</p>
                </div>
            </div>
            </div>
        </div>
        </section>
        <form action="{{ route('teaching.store') }}" 
              method="POST" 
              id="applyAdmissionForm"
              enctype="multipart/form-data">
            @csrf
            <section class="apply-for-admission-form-sec">
                <div class="container">
                    <div class="apply-for-admission-student-details-sec">
                    <h4 class="afas-details-title">1. Personal Details</h4>
                    <div class="row g-3">
                                                            <input type="hidden" id="utm" name="utm">

                        <div class=" col-md-6">			    	
                            <input readonly class="form-control"
                                   name="apply"
                                   type="text"
                                   value="Teaching Job Opportunities">
    	                <span class="text-danger"></span>
    			    </div>
                        <!-- Student Name & DOB -->
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Name *" required>
                        </div>
    
                        <!-- Country & City -->
                        <div class="col-md-6">
                        <select class="form-select" name="position_applied" required>
                            <option value="" selected disabled>Position Applied for*</option>
    
                            @foreach($teaching_job_opportunities_form_banner as $job)
                                <option value="{{ $job->id }}">{{ $job->job_roles }}</option>
                            @endforeach
                        </select>
    
                        </div>
    
                       <div class="col-md-6">
                            <select class="form-select" name="gender" required>
                                <option value="" selected disabled>Select Gender *</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>	
                            </select>
                        </div>
    
                       
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="dob" placeholder="Date of birth *" onfocus="this.type='date'" onblur="if(!this.value)this.type='text'" required>
                        </div>
                        <div class="col-md-6">
                              <select class="form-select" id="nationality" name="nationality" required>
                                                <option value="" selected disabled>Nationality</option>
                                                @foreach($nationality as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nationality }}</option>
                                                @endforeach
                                            </select>                    </div>
                                       <div class="col-md-6">
                        <select class="form-select" name="marital_status" required>
                            <option value="" selected disabled>Marital Status *</option>
                            <option value="Unmarried">Unmarried</option>
                            <option value="Married">Married</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
    
                         <div class="col-md-6">			    	
    			     	<input type="text" class="form-control" name="childs_name" placeholder="Children's Name" autocomplete="childs_name" value="">
    			     	<span class="text-danger"></span>
    			    </div>
                        <div class="col-12">
                        <input type="text" class="form-control" name="current_address" placeholder="Current Address *" required>
                        </div>
                       
                        <div class="col-6">
                        <input type="text" class="form-control" name="childs_age" placeholder="Children's Age (In Years)">
                        </div>
                       <div class="col-md-6">
                            <input type="text" 
                                   class="form-control" 
                                   name="zipcode" 
                                   placeholder="Zipcode *" 
                                   minlength="6" 
                                   maxlength="8" 
                                   pattern="[A-Za-z0-9]{6,8}" 
                                   required>
                        </div>

                       <div class="col-md-6">
                                <input type="tel" class="form-control" name="landline_no" placeholder="Landline No." minlength="6" maxlength="12">
                            </div>
                            
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="mobile_no" placeholder="Mobile No*." minlength="10" maxlength="15" required>
                            </div>

                        <div class="col-md-12">
                        <input type="text" class="form-control" name="permanent_address" placeholder="Permanent Address" >
                        </div>
                        
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="availability_date" placeholder="Earliest Date of Availability *" onfocus="this.type='date'" onblur="if(!this.value)this.type='text'" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Email Id *" required>
                        </div>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="notice_period" placeholder="Notice Period (In Days)*" required>
                        </div>
                        <div class="col-md-6">
                        <input type="text" class="form-control"  name="skype_id" placeholder="Skype Id" >
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" name="criminal_offence" required>
                                <option value="" selected disabled>Have you ever been convicted of a criminal offence?*</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
    
                        
                        <div class="form-group col-md-6">
                            <label for="photo_upload">Upload Photograph *</label>
                        
                            <input type="file" 
                                   name="photo_upload" 
                                   id="photo_upload" 
                                   class="form-control" 
                                   accept="image/*" 
                                   required>
                        
                            <span class="error-photo-upload text-danger"></span>
                        </div>

                        
                    </div>
                    </div>
                    <div class="apply-for-admission-parent-details-sec">
                    <h4 class="afas-details-title">2. Passport Details</h4>
                    <div class="row g-3">
                        <div class="form-group col-md-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="passport_no" 
                                placeholder="Passport No." 
                                minlength="6"
                                maxlength="15"
                                pattern="[A-Za-z0-9]+"
                                value=""
                            >
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="passport_issue_place" placeholder="Passport Issue Place" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="col-12 col-md-12 control-label">Passport Issue Date</label>
                            <input type="date" class="form-control" name="passport_issue_date" placeholder="Passport Issue Date">
                            <span class="text-danger passport-issue-error"></span>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="col-12 col-md-12 control-label">Passport Expiry Date</label>
                            <input type="date" class="form-control" name="passport_expiry_date" placeholder="Passport Expiry Date">
                            <span class="text-danger passport-expiry-error"></span>
                        </div>

                    </div>
                    </div>

                    <div class="other-information-sec">
                        <h4 class="afas-details-title">3. Educational Details</h4>
                        <p>Starting with the educational course completed last</p>
                    
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                <tr class="text-center small fw-semibold">
                                    <th>Name of School / College / University *</th>
                                    <th>Board / Degree / Diploma *</th>
                                    <th>Specialist Subject Area/s</th>
                                    <th>Start Date *</th>
                                    <th>Completion Date *</th>
                                    <th>Grade *</th>
                                    <th>Percentage</th>
                                    <th></th>
                                </tr>
                                </thead>
                    
                                <tbody class="table-body">
                                <tr class="main-clone-tr">
                    
                                    <td>
                                        <input type="text" class="form-control" name="edu[university][]" placeholder="(e.g. Mumbai University)" required>
                                        <small class="error-text text-danger"></small>
                                    </td>
                    
                                    <td>
                                        <input type="text" class="form-control" name="edu[board][]" placeholder="(e.g. HSC)" required>
                                        <small class="error-text text-danger"></small>
                                    </td>
                    
                                    <td>
                                        <input type="text" class="form-control" name="edu[sp_subject][]" placeholder="(e.g. Economics)">
                                        <small class="error-text text-danger"></small>
                                    </td>
                    
                                    <td>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="edu[start_date][]"
                                                   class="form-control edu-start"
                                                   placeholder="Start Date *"
                                                   onfocus="this.type='date'"
                                                   onblur="if(!this.value)this.type='text'"
                                                   required>
                                        </div>
                                       <small class="edu-start-error text-danger"></small>
                    
                                    </td>
                    
                                    <td>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="edu[completion_date][]"
                                                   class="form-control edu-end"
                                                   placeholder="Completion Date *"
                                                   onfocus="this.type='date'"
                                                   onblur="if(!this.value)this.type='text'"
                                                   required>
                                        </div>
                                                                     <small class="edu-end-error text-danger"></small>
                    
                    
                                    </td>
                    
                                    <td>
                                        <input type="text" class="form-control" name="edu[grade][]" placeholder="Grade" required>
                                        <small class="error-text text-danger"></small>
                                    </td>
                    
                                    <td>
                                        <input type="text" class="form-control" name="edu[percentage][]" placeholder="Percentage">
                                        <small class="error-text text-danger"></small>
                                    </td>
                    
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                    
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="other-information-sec">
                    <h4 class="afas-details-title">4. List the professional development courses attended by you, if any</h4>
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle pctbl">
                        <thead class="table-light">
                        <tr class="text-center small fw-semibold">
                            <th>Attended</th>
                            <th>Course Description</th>
                            <th>Start Date</th>
                            <th>Completion Date</th>
                            <th>Location</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <tr class="main-clone-tr">
                            <td>
                            <input type="text" class="form-control" name="pd_courses_attended[attended][]" placeholder="">
                            </td>
                            <td>
                            <input type="text" class="form-control" name="pd_courses_attended[course][]" placeholder="">
                            </td>
                            <td>
                                            <div class="input-group">
                                                <input type="date" 
                                                       name="pd_courses_attended[start_date][]" 
                                                       class="form-control pd-start" 
                                                       placeholder="Start Date">
                                            </div>
                                            <span class="text-danger pd-start-error"></span>
                                        </td>

                           <td>
                                <div class="input-group">
                                    <input type="date" 
                                           name="pd_courses_attended[completion_date][]" 
                                           class="form-control pd-end" 
                                           placeholder="Completion Date">
                                </div>
                                <span class="text-danger pd-end-error"></span>
                            </td>

                            </td>
                            <td>
                            <input type="text" class="form-control" name="pd_courses_attended[location][]" placeholder="Location">
                            </td>
                            <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                <i class="fa fa-plus"></i>
                            </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    <div class="other-information-sec">
                    <h4 class="afas-details-title">5. List the professional development course description conducted by you, if any</h4>
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle pctbl">
                        <thead class="table-light">
                        <tr class="text-center small fw-semibold">
                            <th>Conducted</th>
                            <th>Course Description</th>
                            <th>Start Date</th>
                            <th>Completion Date</th>
                            <th>Location</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <tr class="main-clone-tr">
                            <td><input type="text" class="form-control" name="pd_courses_conducted[attended][]" placeholder=""></td>
                            <td><input type="text" class="form-control" name="pd_courses_conducted[course][]" placeholder=""></td>
                            <td>
                                <div class="input-group">
                                    <input type="date" 
                                           name="pd_courses_conducted[start_date][]" 
                                           class="form-control conducted-start" 
                                           placeholder="Start Date">
                                </div>
                                <span class="text-danger conducted-start-error"></span>
                            </td>

                            <td>
                                <div class="input-group">
                                    <input type="date" 
                                           name="pd_courses_conducted[completion_date][]" 
                                           class="form-control conducted-end" 
                                           placeholder="Completion Date">
                                </div>
                                <span class="text-danger conducted-end-error"></span>
                            </td>

                            <td><input type="text" class="form-control" name="pd_courses_conducted[location][]" placeholder="Location"></td>
                            <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                <i class="fa fa-plus"></i>
                            </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    
                    <div class="other-information-sec">
                    <h4 class="afas-details-title">6. Publications/Research Papers/Documents produced (in the last 5 years)</h4>
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle prtbl">
                        <thead class="table-light">
                        <tr class="text-center small fw-semibold">
                            <th>Title</th>
                            <th>Published in</th>
                            <th>Date of Publishing</th>
                            <th>Presented at</th>
                            <th>Date of Presentation</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <tr class="main-clone-tr">
                            <td><input type="text" class="form-control" name="prd[title][]" placeholder=""></td>
                            <td><input type="text" class="form-control" name="prd[publish_in][]" placeholder=""></td>
                            <td>
                            <div class="input-group">
                                <input type="date" name="prd[publish_date][]" class="form-control start-date" placeholder="Publish Date">
                                <!--<span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>-->
                            </div>
                            </td>
                            <td><input type="text" class="form-control" name="prd[presented_at][]" placeholder=""></td>
                            <td>
                            <div class="input-group">
                                <input type="date" name="prd[presentation_date][]" class="form-control end-date" placeholder="Presentation Date">
                                <!--<span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>-->
                            </div>
                            </td>
                            <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                <i class="fa fa-plus"></i>
                            </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
                     <div class="other-information-sec">
                    <h4 class="afas-details-title">7. Other Details</h4>
                    <div class="row g-3">
                
                        <!-- Experience at International Schools -->
                        <div class="col-md-6">
                            <select class="form-select" name="experience_international_schools" required>
                                <option value="" selected disabled>Experience at International Schools *</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                
                        <!-- Supervisor Concern -->
                        <div class="col-md-6">
                            <select class="form-select" name="supervisor_concern" required>
                                <option value="" selected disabled>
                                    Has any Supervisor ever raised concerns regarding you working with children ? *
                                </option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                
                        <!-- Direct Experience In -->
                        <div class="col-md-6">
                            <select class="form-select" name="direct_experience_in">
                                <option value="" selected disabled>Direct Experience In</option>
                                <option value="IBPYP">IBPYP</option>
                                <option value="IBMYP">IBMYP</option>
                                <option value="IBDP">IBDP</option>
                                <option value="IGCSE">IGCSE</option>
                                <option value="A Level">A Level</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                
                        <!-- Current Employer -->
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="current_employer"
                                placeholder="Current Employer (e.g. School/Organization Name)">
                        </div>
                
                        <!-- Experience (Years) -->
                        <div class="col-md-3">
                            <label class="col-12 col-md-12 control-label">Experience</label>
                            <select class="form-select" name="experience_years">
                                <option value="" selected disabled>Select Years</option>
                                @for($i=1; $i<=35; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                <option value="35+">35+</option>
                            </select>
                        </div>
                
                        <!-- Experience (Months) -->
                        <div class="col-md-3">
                            <label class="col-12 col-md-12 control-label"></label>
                            <select class="form-select" name="experience_months">
                                <option value="" selected disabled>Select Months</option>
                                @for($i=1; $i<=11; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                
                        <!-- Current Designation -->
                        <div class="form-group col-md-6">
                            <label class="col-12 col-md-12 control-label"></label>
                            <input type="text" class="form-control" name="current_designation"
                                placeholder="Current Designation">
                        </div>
                    </div>
                </div>
                                
                                
                    <div class="other-information-sec">
                    <h4 class="afas-details-title">8. Employment Details (List the most recent first)</h4>
                    <div class="row g-3 employment-block">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[school_organization][]" placeholder="School/Organization *" required>
                        </div>
                
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[designation][]" placeholder="Designation *" required>
                        </div>
                
                        <div class="form-row col-12">
                            <div class="form-group">
                                <input type="checkbox" class="current-working-cls" name="employment[current_working][]" value="1">
                                <label>I'm still working here</label>
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            <label class="col-12 control-label">Date of Joining *</label>
                            <input type="date" name="employment[date_joining][]" class="form-control" required>
                        </div>
                
                        <div class="col-md-6 leaving-date-field">
                            <label class="col-12 control-label">Date of Leaving</label>
                            <input type="date" name="employment[date_leaving][]" class="form-control">
                        </div>
                
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[subject_taught][]" placeholder="Subject Taught">
                        </div>
                
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[curriculum][]" placeholder="Curriculum *(e.g. IB / IGCSE / ICSE)" required>
                        </div>
                
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[additional_responsibility][]" placeholder="Additional Responsibility">
                        </div>
                
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="employment[reason_of_leaving][]" placeholder="Reason of Leaving">
                        </div>
                    </div>
                </div>
    
                    
                <div class="other-information-sec">
                    <h4 class="afas-details-title">9. IT Skills & Interests</h4>
                    <div class="row g-3">
                
                        <!-- IT Skills -->
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="it_skills" placeholder="IT Skills">
                        </div>
                
                        <!-- Hobbies / Interests -->
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="hobbies" placeholder="Interests">
                        </div>
                
                        <!-- Language Skills -->
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="language_skills" rows="3"
                                placeholder="Language Skills * (e.g. English, French)" required="required"
                                oninvalid="scroll_to_validator(this)"></textarea>
                        </div>
                
                    </div>
                </div>
    
                    
                <div class="other-information-sec">
                    <h4 class="afas-details-title">10. Emoluments (Current and Expected Salary)</h4>
                    <div class="row g-3">
                
                        <!-- Current Salary -->
                        <div class="col-md-6">
                            <label for="current_salary" class="col-12 col-md-12 control-label">
                                Current (Monthly) Salary in INR *
                            </label>
                            <input type="number" class="form-control" id="current_salary" name="current_salary"
                                placeholder="e.g. 20000" required>
                        </div>
                
                        <!-- Expected Salary -->
                        <div class="col-md-6">
                            <label for="expected_salary" class="col-12 col-md-12 control-label">
                                Expected (Monthly) Salary in INR *
                            </label>
                            <input type="number" class="form-control" id="expected_salary" name="expected_salary"
                                placeholder="e.g. 25000" required>
                        </div>
                
                    </div>
                </div>
    
                    
               <div class="other-information-sec">
                    <h4 class="afas-details-title">11. Confidential Referees who Supervised you (minimum of three)</h4>
                    <div class="table-responsive">
                        <!-- ðŸ”¹ Give unique ID to this table -->
                        <table id="refereesTable" class="table table-hover table-bordered align-middle ertbl">
                            <thead class="table-light">
                                <tr class="text-center small fw-semibold">
                                    <th>Reference Name *</th>
                                    <th>Designation *</th>
                                    <th>Phone *</th>
                                    <th>Email *</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                <tr class="main-clone-tr">
                                    <td>
                                        <input type="text" class="form-control required-fields" name="referees[name][]" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control required-fields" name="referees[designation][]" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="referees[phone][]" maxlength="16" placeholder="Enter 10-15 digits" required>
                                        <span class="mobile-error text-danger small" style="display:none;"></span>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control required-fields" name="referees[email][]" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="referees[address][]" placeholder="">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
                    <div class="row g-3">
                        <div class="col-md-6">
                            <textarea class="form-control" name="philosophy" rows="3"
                                placeholder="Describe your Philosophy of Education Maximum 500 characters" maxlength="500"></textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" name="other_information" placeholder="Any other information, if required" rows="3"></textarea>
                        </div>
                    </div>
                </div>
    
                    
                <div class="other-information-sec">
                    <h4 class="afas-details-title">Upload Resume *</h4>
                    <div class="row">
                
                        <div class="form-group col-md-12">
                            <label class="w-100">Upload Resume *</label>
                
                            <input type="file"
                                   name="resume"
                                   id="resume"
                                   class="form-control"
                                   accept=".pdf,.doc,.docx"
                                   required
                                   oninvalid="this.setCustomValidity('Please upload a valid resume')"
                                   oninput="this.setCustomValidity('')">
                
                            <span class="error-photo-upload text-danger"></span>
                
                            <p class="text-muted small mb-0">
                                Accepted: <strong>.pdf, .doc, .docx</strong> (Max: 5MB)
                            </p>
                        </div>
                
                        <div class="form-group col-md-12 mt-3">
                            <input type="checkbox"
                                   name="agree_for_terms_condition"
                                   id="agree_for_terms_condition"
                                   value="1"
                                   required>
                
                            <label for="agree_for_terms_condition">
                                I hereby declare that the above statement is true to the best of my knowledge and belief.
                            </label>
                
                            <span class="text-danger"></span>
                        </div>
                
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mt-3 text-left" style="margin-bottom: 10px;">
                        <div class="d-inline-block">
                            <div class="g-recaptcha"
                                 data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        </div>
                    </div>
                
                    <div class="col-12 text-left">
                        <span id="captchaError" class="error-text" style="color:red;"></span>
                    </div>
                </div>
                    
                <div class="teaching-form-btn-sec">
                    <div class="teaching-job-opp-btn-sec">
                        <!-- âœ… Submit Button -->
                        <button type="submit" class="btn-ecol btn">Submit</button>
                    </div>
                    <div class="teaching-job-opp-btn-sec">
                        <!-- âœ… Clear All / Reset Button -->
                        <button type="reset" class="btn-ecol btn">Clear All</button>
                    </div>
                </div>
    
                    
    
    
                </div>
            </section>
        </form>
    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
 <!----- Form Validations ---->
 <script>
$(document).ready(function() {
    // Prevent negative values and special chars like e, +, -
    $("input[name='current_salary'], input[name='expected_salary']").on("input keydown", function (e) {
        // Block negative signs, exponential input, and plus/minus
        if (e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E') {
            e.preventDefault();
        }

        // Prevent negative or non-numeric input
        const value = $(this).val();
        if (value < 0) {
            $(this).val('');
        }
    });

    // Extra safety: prevent pasting negative numbers
    $("input[name='current_salary'], input[name='expected_salary']").on("paste", function(e) {
        const pasteData = e.originalEvent.clipboardData.getData('text');
        if (pasteData.includes('-') || isNaN(pasteData) || parseFloat(pasteData) < 0) {
            e.preventDefault();
        }
    });
});
</script>


<script>
$(document).ready(function () {

    /* ---------------------------------------------------
       REMOVE OLD ERRORS ON INPUT
    --------------------------------------------------- */
    $(document).on("input change", "input, select, textarea", function () {
        $(this).removeClass("is-invalid");
        $(this).next(".error-message").remove();

        // Clear file-upload custom error
        if ($(this).attr("type") === "file") {
            $(this).closest(".form-group").find(".error-photo-upload").text("");
        }
    });


    /* ---------------------------------------------------
       ONLY LETTERS FOR ALL NAME FIELDS
    --------------------------------------------------- */
    $(document).on("input", "input[name*='name']", function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });


    /* ---------------------------------------------------
       DIGITS ONLY FOR PHONE
    --------------------------------------------------- */
    $(document).on("input", "input[type='tel']", function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    /* ---------------------------------------------------
       ZIPCODE ALPHANUMERIC ONLY
    --------------------------------------------------- */
    $(document).on("input", "input[name='zipcode']", function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
    });

 // ðŸ•“ Hide or show "Date of Leaving"
    $(document).on("change", ".current-working-cls", function () {
        var $checkbox = $(this);
        var $block = $checkbox.closest(".employment-block");
        var $leavingField = $block.find(".leaving-date-field");

        if ($checkbox.is(":checked")) {
            $leavingField.hide();
            $leavingField.find("input").prop("required", false).val("");
        } else {
            $leavingField.show();
            $leavingField.find("input").prop("required", true);
        }
    });
    /* ---------------------------------------------------
       SALARY VALIDATION â€“ NO NEGATIVE, NO e,+,-
    --------------------------------------------------- */
    $("input[name='current_salary'], input[name='expected_salary']").on("input keydown", function (e) {

        if (["-", "+", "e", "E"].includes(e.key)) {
            e.preventDefault();
        }

        if ($(this).val() < 0) {
            $(this).val('');
        }
    });

    $("input[name='current_salary'], input[name='expected_salary']").on("paste", function (e) {
        const pasteData = e.originalEvent.clipboardData.getData('text');
        if (pasteData.includes('-') || isNaN(pasteData) || pasteData < 0) {
            e.preventDefault();
        }
    });


    /* ---------------------------------------------------
       PASSPORT ISSUE / EXPIRY DATE VALIDATION
    --------------------------------------------------- */
    $(document).on("change", "input[name='passport_issue_date'], input[name='passport_expiry_date']", function () {

        let issueDate = $("input[name='passport_issue_date']").val();
        let expiryDate = $("input[name='passport_expiry_date']").val();

        $(".passport-issue-error").text("");
        $(".passport-expiry-error").text("");

        if (issueDate && expiryDate) {
            let iDate = new Date(issueDate);
            let eDate = new Date(expiryDate);

            if (eDate <= iDate) {
                $(".passport-expiry-error").text("Expiry date must be greater than Issue date.");
                $("input[name='passport_expiry_date']").val('');
            }
        }
    });


    /* ---------------------------------------------------
       DATE VALIDATION â€” EDUCATION (ALL ROWS)
    --------------------------------------------------- */
  /* ---------------------------------------------------
   DATE VALIDATION â€” EDUCATION (ALL ROWS)
--------------------------------------------------- */
/* ---------------------------------------------------
    DATE VALIDATION — EDUCATION (ALL ROWS)
--------------------------------------------------- */
$(document).on("change", "input[name='edu[start_date][]'], input[name='edu[completion_date][]']", function () {

    let row = $(this).closest("tr");

    let startDate  = row.find("input[name='edu[start_date][]']").val();
    let endDate    = row.find("input[name='edu[completion_date][]']").val();

    // Clear previous errors
    row.find(".edu-start-error").text("");
    row.find(".edu-end-error").text("");

    if (startDate && endDate) {

        let sDate = new Date(startDate);
        let eDate = new Date(endDate);

        // Same validation logic as passport
        if (eDate <= sDate) {
            row.find(".edu-end-error").text("Completion Date must be greater than Start Date.");
            row.find("input[name='edu[completion_date][]']").val("");
        }
    }
});



    /* ---------------------------------------------------
       PROFESSIONAL DEVELOPMENT â€“ ATTENDED
    --------------------------------------------------- */
    $(document).on("change", 
        "input[name='pd_courses_attended[start_date][]'], input[name='pd_courses_attended[completion_date][]']", 
        function () {

        let row = $(this).closest("tr");
        let start = row.find("input[name='pd_courses_attended[start_date][]']").val();
        let end = row.find("input[name='pd_courses_attended[completion_date][]']").val();

        row.find(".pd-start-error").text("");
        row.find(".pd-end-error").text("");

        if (start && end) {
            if (new Date(end) <= new Date(start)) {
                row.find(".pd-end-error").text("Completion Date must be after Start Date.");
                row.find("input[name='pd_courses_attended[completion_date][]']").val('');
            }
        }
    });


    /* ---------------------------------------------------
       PROFESSIONAL DEVELOPMENT â€“ CONDUCTED
    --------------------------------------------------- */
    $(document).on("change", 
        "input[name='pd_courses_conducted[start_date][]'], input[name='pd_courses_conducted[completion_date][]']", 
        function () {

        let row = $(this).closest("tr");
        let start = row.find("input[name='pd_courses_conducted[start_date][]']").val();
        let end = row.find("input[name='pd_courses_conducted[completion_date][]']").val();

        row.find(".conducted-start-error").text("");
        row.find(".conducted-end-error").text("");

        if (start && end) {
            if (new Date(end) <= new Date(start)) {
                row.find(".conducted-end-error").text("Completion Date must be after Start Date.");
                row.find("input[name='pd_courses_conducted[completion_date][]']").val('');
            }
        }
    });


    /* ---------------------------------------------------
       SUBMIT BUTTON VALIDATION
    --------------------------------------------------- */
    // $(".btn-ecol:first").on("click", function (e) {
    //     e.preventDefault();

    //     let isValid = true;

    //     $(".error-message").remove();
    //     $(".is-invalid").removeClass("is-invalid");
    //     $(".error-photo-upload").text("");

    //     $("#applyAdmissionForm").find("input[required], select[required], textarea[required]").each(function () {

    //         let field = $(this);
    //         let value = field.val()?.trim() || "";
    //         let type = field.attr("type");
    //         let nameAttr = field.attr("name");


    //         // REQUIRED
    //         if (!value) {
    //             showError(field, "This field is required");
    //             isValid = false;
    //         }

    //         // EMAIL VALIDATION
    //         else if (type === "email" && !validateEmail(value)) {
    //             showError(field, "Enter a valid email");
    //             isValid = false;
    //         }

    //         // MOBILE
    //         else if (nameAttr === "mobile_no") {
    //             if (value.length < 10 || value.length > 15 || !/^\d+$/.test(value)) {
    //                 showError(field, "Mobile number must be 10â€“15 digits");
    //                 isValid = false;
    //             }
    //         }

    //         // PASSPORT NUMBER
    //         else if (nameAttr === "passport_no" && value !== "") {
    //             if (!/^[A-Za-z0-9]+$/.test(value) || value.length < 6 || value.length > 15) {
    //                 showError(field, "Passport No. must be 6â€“15 letters/numbers only");
    //                 isValid = false;
    //             }
    //         }

    //         // RESUME UPLOAD
    //         else if (type === "file" && field.attr("id") === "resume") {

    //             const file = field[0].files[0];

    //             if (!file) {
    //                 showError(field, "Please upload your resume");
    //                 isValid = false;
    //             } else {
    //                 const ext = file.name.split(".").pop().toLowerCase();
    //                 const allowed = ["pdf", "doc", "docx"];

    //                 if (!allowed.includes(ext)) {
    //                     showError(field, "Allowed file types: PDF, DOC, DOCX");
    //                     isValid = false;
    //                 }

    //                 if (file.size > 5 * 1024 * 1024) {
    //                     showError(field, "File size must be below 5MB");
    //                     isValid = false;
    //                 }
    //             }
    //         }
    //     });

    //     if (isValid) {
    //         $("#applyAdmissionForm").submit();
    //     }
    // });
    
    
    $(".btn-ecol:first").on("click", function (e) {
        e.preventDefault();
    
        let isValid = true;
    
        $(".error-message").remove();
        $(".is-invalid").removeClass("is-invalid");
        $(".error-photo-upload").text("");
    
        const submitBtn = $(this);
    
        // VALIDATION
        $("#applyAdmissionForm").find("input[required], select[required], textarea[required]").each(function () {
    
            let field = $(this);
            let value = field.val()?.trim() || "";
            let type = field.attr("type");
            let nameAttr = field.attr("name");
    
            if (!value) {
                showError(field, "This field is required");
                isValid = false;
            } else if (type === "email" && !validateEmail(value)) {
                showError(field, "Enter a valid email");
                isValid = false;
            } else if (nameAttr === "mobile_no") {
                if (value.length < 10 || value.length > 15 || !/^\d+$/.test(value)) {
                    showError(field, "Mobile number must be 10–15 digits");
                    isValid = false;
                }
            } else if (nameAttr === "passport_no" && value !== "") {
                if (!/^[A-Za-z0-9]+$/.test(value) || value.length < 6 || value.length > 15) {
                    showError(field, "Passport No. must be 6–15 letters/numbers only");
                    isValid = false;
                }
            } else if (type === "file" && field.attr("id") === "resume") {
                const file = field[0].files[0];
                if (!file) {
                    showError(field, "Please upload your resume");
                    isValid = false;
                } else {
                    const ext = file.name.split(".").pop().toLowerCase();
                    const allowed = ["pdf", "doc", "docx"];
                    if (!allowed.includes(ext)) {
                        showError(field, "Allowed file types: PDF, DOC, DOCX");
                        isValid = false;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        showError(field, "File size must be below 5MB");
                        isValid = false;
                    }
                }
            }
            
            // 🔐 reCAPTCHA validation
            if (grecaptcha.getResponse() === "") {
                $("#captchaError").text("Please verify that you are not a robot.");
                isValid = false;
            
                $("html, body").animate({
                    scrollTop: $(".g-recaptcha").offset().top - 150
                }, 500);
            } else {
                $("#captchaError").text("");
            }

        });
    
        // 3 REFEREE CHECK
        var refereeCount = $("#refereesTable tbody tr").length;
        if (refereeCount < 3) {
            e.preventDefault();
            alert("Please enter at least 3 referees.");
            $("html, body").animate({
                scrollTop: $("#refereesTable").offset().top - 150
            }, 500);
            return false;
        }
    
        if (isValid) {
            // Disable button and show submitting message
            submitBtn.prop("disabled", true);
            submitBtn.text("Submitting...");
            
            // Submit the form
            $("#applyAdmissionForm").submit();
        }
    }); 



    /* ---------------------------------------------------
       3 REFEREE CHECK
    --------------------------------------------------- */
    $("#applyAdmissionForm").on("submit", function (e) {
        var refereeCount = $("#refereesTable tbody tr").length;

        if (refereeCount < 3) {
            e.preventDefault();
            alert("Please enter at least 3 referees.");
            $("html, body").animate({
                scrollTop: $("#refereesTable").offset().top - 150
            }, 500);
            return false;
        }
    });


    /* ---------------------------------------------------
       SHOW FILE NAME FOR RESUME
    --------------------------------------------------- */
    $("#resume").on("change", function () {
        const fileName = this.files.length ? this.files[0].name : "Choose your resume";
        $("#resume-file-name").text(fileName);
    });

        
        

    /* ---------------------------------------------------
       FUNCTIONS
    --------------------------------------------------- */

    function showError(field, message) {

        field.addClass("is-invalid");

        if (field.attr("type") === "file") {
            field.closest(".form-group").find(".error-photo-upload").text(message);
        } else {
            field.after('<div class="error-message text-danger small mt-1">' + message + '</div>');
        }
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

});
</script>


    <script>
        function addmore(btn) {
            let row = $(btn).closest('tr').clone();
            row.find('input').val('');
            row.find('.add-more').removeClass('btn-primary').addClass('btn-danger')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');
            $('.table-body').append(row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }
    </script>
  
    <script>
        function addmore(btn) {
            let row = $(btn).closest('tr').clone();
            row.find('input').val('');
            row.find('.add-more')
                .removeClass('btn-primary').addClass('btn-danger')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');
            $('.pctbl .table-body').append(row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }
    </script>
    
    <script>
        function addmore(btn) {
            var $tableBody = $(btn).closest('table').find('.table-body');
            var $row = $(btn).closest('tr').clone();

            // Clear all input values in cloned row
            $row.find('input').val('');

            // Change "+" button to "-" button
            $row.find('.add-more')
                .removeClass('btn-primary add-more')
                .addClass('btn-danger remove-row')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');

            // Append cloned row to the table
            $tableBody.append($row);
        }

        function removeRow(btn) {
            $(btn).closest('tr').remove();
        }
    </script>


    <script>
        function addmore(btn) {
            var $tableBody = $(btn).closest('table').find('.table-body');
            var $row = $(btn).closest('tr').clone();

            // Clear all input values
            $row.find('input').val('');

            // Change "+" button to "-" button
            $row.find('.add-more')
                .removeClass('btn-primary add-more')
                .addClass('btn-danger remove-row')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');

            // Append cloned row to the table
            $tableBody.append($row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }

    </script>
    
<script>
function addmore(btn) {
    var $table = $(btn).closest('table');
    var $tableBody = $table.find('.table-body');
    var $row = $(btn).closest('tr').clone();

    // ðŸ”¹ Clear input values in cloned row
    $row.find('input').val('');

    // ðŸ”¹ Convert "+" button to "-" (remove button)
    $row.find('.add-more')
        .removeClass('btn-primary add-more')
        .addClass('btn-danger remove-row')
        .html('<i class="fa fa-minus"></i>')
        .attr('onclick', 'removeRow(this)');

    // ðŸ”¹ Append new row
    $tableBody.append($row);
}

function removeRow(btn) {
    $(btn).closest('tr').remove();
}

// âœ… Ensure minimum 3 referees before form submit
$(document).ready(function() {
    $("#applyAdmissionForm").on("submit", function(e) {
        var refereeCount = $("#refereesTable tbody tr").length;

        if (refereeCount < 3) {
            e.preventDefault();
            alert("Please enter at least 3 referees before submitting the form.");
            $("html, body").animate({
                scrollTop: $("#refereesTable").offset().top - 150
            }, 500);
            return false;
        }
    });
});
</script>

<script>
document.getElementById('photo_upload').addEventListener('change', function() {
  const fileName = this.files.length ? this.files[0].name : 'Upload Photograph (accepted files: .jpg, .jpeg, .gif, .png below 1Mb) *';
  document.getElementById('file-name').textContent = fileName;
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const params = new URLSearchParams(window.location.search);

    const utm_source   = params.get("utm_source")   || "";
    const utm_medium   = params.get("utm_medium")   || "";
    const utm_campaign = params.get("utm_campaign") || "";
    const utm_term     = params.get("utm_term")     || "";
    const utm_content  = params.get("utm_content")  || "";

    let utmString = 
        "utm_source=" + utm_source +
        "&utm_medium=" + utm_medium +
        "&utm_campaign=" + utm_campaign +
        "&utm_term=" + utm_term +
        "&utm_content=" + utm_content;

    document.getElementById("utm").value = utmString;

});
</script>
</body>
</html>