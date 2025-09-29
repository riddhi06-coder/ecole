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
                  <h4>Add Fee Structure Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-fee-structure.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Fee Structure </li>
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
                        <h4>Fee Structure Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                        <form class="row g-3 needs-validation custom-input" novalidate 
                                            action="{{ route('manage-fee-structure.update', $fee->id) }}" 
                                            method="POST" 
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            @if(!$firstRecord || $fee->id == $firstRecord->id)
                                                <!-- Banner Heading -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="banner_heading">Banner Heading </label>
                                                    <input class="form-control" id="banner_heading" type="text" 
                                                        name="banner_heading" 
                                                        placeholder="Enter Banner Heading"
                                                        value="{{ old('banner_heading', $fee->banner_heading) }}">
                                                    <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                                </div>

                                                <!-- Banner Image -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="thumbnail">Banner Image </label>
                                                    <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                                    <div class="invalid-feedback">Please upload a Banner image.</div>
                                                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                    <br>
                                                    <small class="text-secondary"><b>Note: Only jpg, jpeg, png, webp files are allowed.</b></small>

                                                    <!-- Existing Banner Image -->
                                                    <div class="mt-2">
                                                        <img id="thumbnailPreview" 
                                                            src="{{ $fee->banner_image ? asset('uploads/admissions/'.$fee->banner_image) : '#' }}" 
                                                            alt="Preview" 
                                                            class="img-fluid rounded border" 
                                                            style="max-height:150px; {{ $fee->banner_image ? '' : 'display:none;' }}">
                                                    </div>
                                                </div>

                                                <!-- Section Heading -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="section_heading">Section Heading </label>
                                                    <input class="form-control" id="section_heading" type="text" 
                                                        name="section_heading" 
                                                        placeholder="Enter Section Heading"
                                                        value="{{ old('section_heading', $fee->section_heading) }}">
                                                    <div class="invalid-feedback">Please enter a Section Heading.</div>
                                                </div>

                                                <!-- Section Description -->
                                                <div class="col-md-12">
                                                    <label for="section_description" class="form-label">Section Description </label>
                                                    <textarea name="section_description" id="section_description" class="form-control" rows="4" 
                                                            placeholder="Enter Section description">{{ old('section_description', $fee->section_description) }}</textarea>
                                                    <div class="invalid-feedback">Please enter a Section description.</div>
                                                </div>

                                                <hr class="mt-5">

                                                <!-- Campus Tour -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="campus_tour">Campus Tour </label>
                                                    <input class="form-control" id="campus_tour" type="text" name="campus_tour" 
                                                        placeholder="Enter Campus Tour" value="{{ old('campus_tour', $fee->campus_tour) }}">
                                                    <div class="invalid-feedback">Please enter a Campus Tour.</div>
                                                </div>

                                                <!-- Admission Advisor -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="admission_advisor">Admission Advisor </label>
                                                    <input class="form-control" id="admission_advisor" type="text" name="admission_advisor" 
                                                        placeholder="Enter Admission Advisor" value="{{ old('admission_advisor', $fee->admission_advisor) }}">
                                                    <div class="invalid-feedback">Please enter an Admission Advisor.</div>
                                                </div>

                                                <!-- School Brochure -->
                                                <div class="col-md-6">
                                                    <label class="form-label" for="brochure">School Brochure </label>
                                                    <input class="form-control" id="brochure" type="file" name="brochure" accept=".pdf,.doc,.docx" onchange="previewBrochure(event)">
                                                    <div class="invalid-feedback">Please upload a brochure.</div>
                                                    <small class="text-secondary"><b>Note: Only PDF and Word files. Max size 2MB.</b></small>

                                                    @if($fee->brochure)
                                                        <div class="mt-2" id="brochurePreview">
                                                            <a href="{{ asset('uploads/admissions/'.$fee->brochure) }}" target="_blank">View Current Brochure</a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <hr class="mt-5">
                                            @endif

                                            <!-- Fee Type -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="fee_type">Fee Type <span class="txt-danger">*</span></label>
                                                <input class="form-control" id="fee_type" type="text" name="fee_type" 
                                                    placeholder="Enter Fee Type" required value="{{ old('fee_type', $fee->fee_type) }}">
                                                <div class="invalid-feedback">Please enter a Fee Type.</div>
                                            </div>

                                            <!-- Fees Description -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="fee_desc">Fees Description </label>
                                                <input class="form-control" id="fee_desc" type="text" name="fee_desc" 
                                                    placeholder="Enter Fees Description" value="{{ old('fee_desc', $fee->fee_desc) }}">
                                                <div class="invalid-feedback">Please enter a Fees Description.</div>
                                            </div>

                                            <!-- Fee Details -->
                                            <div class="col-md-12">
                                                <label for="fees_details" class="form-label">Fee Details <span class="txt-danger">*</span></label>
                                                <textarea name="fees_details" id="editor" class="form-control" rows="4" 
                                                        placeholder="Enter Fee Details" required>{{ old('fees_details', $fee->fees_details) }}</textarea>
                                                <div class="invalid-feedback">Please enter Fee Details.</div>
                                            </div>

                                            <!-- Actions -->
                                            <div class="col-12 text-end">
                                                <a href="{{ route('manage-fee-structure.index') }}" class="btn btn-danger px-4">Cancel</a>
                                                <button class="btn btn-primary" type="submit">Update</button>
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


        <script>
            function previewThumbnail(event) {
                const reader = new FileReader();
                const output = document.getElementById('thumbnailPreview');
                reader.onload = function(){
                    output.src = reader.result;
                    output.style.display = 'block'; // make sure preview is visible
                };
                if(event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }
        </script>


        <script>
            function previewBrochure(event) {
                const input = event.target;
                const previewDiv = document.getElementById('brochurePreview');
                previewDiv.innerHTML = ''; // Clear previous preview

                if (input.files && input.files[0]) {
                    const file = input.files[0];

                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert("File size must not exceed 2MB.");
                        input.value = ""; // Clear input
                        return;
                    }

                    // Validate file type
                    const allowedTypes = [
                        'application/pdf', 
                        'application/msword', 
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];
                    if (!allowedTypes.includes(file.type)) {
                        alert("Only PDF and Word files are allowed.");
                        input.value = ""; // Clear input
                        return;
                    }

                    // Show selected file name
                    const fileName = document.createElement('p');
                    fileName.textContent = "Selected file: " + file.name;
                    previewDiv.appendChild(fileName);
                }
            }
        </script>
</body>

</html>