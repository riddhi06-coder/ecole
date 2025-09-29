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
                  <h4>Add Merit Scholarship Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-merit-scholarships.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Merit Scholarship </li>
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
                        <h4>Merit Scholarship Form</h4>
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
                                        action="{{ route('manage-merit-scholarships.update', $scholarship->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                placeholder="Enter Banner Heading" 
                                                value="{{ old('banner_heading', $scholarship->banner_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image"> Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only jpg, jpeg, png, webp, svg files are allowed.</b></small>
                                            <div class="mt-2">
                                                <!-- Current image preview -->
                                                @if($scholarship->banner_image)
                                                    <img id="currentThumbnail" src="{{ asset('uploads/admissions/' . $scholarship->banner_image) }}" 
                                                        alt="Current Banner" class="img-fluid rounded border" 
                                                        style="max-height: 150px; background:black;">
                                                @endif
                                                <!-- New image preview -->
                                                <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- Section Heading -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" 
                                                placeholder="Enter Section Heading" 
                                                value="{{ old('section_heading', $scholarship->section_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Details <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="editor" class="form-control" rows="4" placeholder="Enter description" required>{{ old('description', $scholarship->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- Campus Tour -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="campus_tour">Campus Tour <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="campus_tour" type="text" name="campus_tour" 
                                                placeholder="Enter Campus Tour" 
                                                value="{{ old('campus_tour', $scholarship->campus_tour) }}" required>
                                            <div class="invalid-feedback">Please enter a Campus Tour.</div>
                                        </div>

                                        <!-- Admission Advisor -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="admission_advisor">Admission Advisor <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="admission_advisor" type="text" name="admission_advisor" 
                                                placeholder="Enter Admission Advisor" 
                                                value="{{ old('admission_advisor', $scholarship->admission_advisor) }}" required>
                                            <div class="invalid-feedback">Please enter an Admission Advisor.</div>
                                        </div>

                                        <!-- School Brochure Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="brochure">School Brochure <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="brochure" 
                                                type="file" 
                                                name="brochure" 
                                                accept=".pdf,.doc,.docx" 
                                                onchange="previewBrochure(event)">
                                            <div class="invalid-feedback">Please upload a brochure.</div>
                                            <small class="text-secondary"><b>Note: Only PDF and Word files are allowed. Max size 2MB.</b></small>

                                            <!-- Display current brochure -->
                                            <div class="mt-2" id="brochurePreview">
                                                @if($scholarship->brochure)
                                                    <a href="{{ asset('uploads/admissions/' . $scholarship->brochure) }}" target="_blank">View Current Brochure</a>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-merit-scholarships.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            ClassicEditor.create(document.querySelector('#editor1'))
                .catch(error => { console.error(error); });
        </script>
        
       
        <script>
            function previewThumbnail(event) {
                const input = event.target;
                const preview = document.getElementById('thumbnailPreview');
                const current = document.getElementById('currentThumbnail');

                if(input.files && input.files[0]){
                    const reader = new FileReader();
                    reader.onload = function(e){
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                        if(current) current.style.display = 'none'; // hide old image
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function previewBrochure(event){
                const input = event.target;
                const preview = document.getElementById('brochurePreview');
                if(input.files && input.files[0]){
                    preview.innerHTML = `<span>${input.files[0].name}</span>`;
                }
            }
        </script>


</body>

</html>