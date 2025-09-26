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
                  <h4>Edit Faculty & Staff Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-faculty-and-staff.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Faculty & Staff</li>
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
                        <h4>Faculty & Staff Form</h4>
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
                                        action="{{ route('manage-faculty-and-staff.update', $set_apart->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                @if($set_apart->banner_image)
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/about/' . $set_apart->banner_image) }}" 
                                                        alt="Banner Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $set_apart->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Existing Section Image Preview -->
                                            <div class="mt-2">
                                                @if($set_apart->section_image)
                                                    <img id="sectionImagePreview" src="{{ asset('uploads/about/' . $set_apart->section_image) }}" 
                                                        alt="Section Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="section_heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" 
                                                value="{{ old('section_heading', $set_apart->section_heading) }}" 
                                                placeholder="Enter Heading" required>
                                            <div class="invalid-feedback">Please enter heading.</div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="section_description">Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="section_description" rows="5" 
                                                    placeholder="Enter Description" required>{{ old('section_description', $set_apart->section_description) }}</textarea>
                                        </div>
                                        

                                        <hr class="my-3">

                                        <!-- Additional Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="extra_image">Additional Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="extra_image" type="file" name="extra_image" onchange="previewExtraImage(event)">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Preview -->
                                            <div class="mt-2">
                                                @if($set_apart->extra_image)
                                                    <img id="extraImagePreview" 
                                                        src="{{ asset('uploads/about/' . $set_apart->extra_image) }}" 
                                                        alt="Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="extraImagePreview" src="#" alt="Preview" 
                                                        class="img-fluid rounded border d-none" 
                                                        style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Additional Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="extra_description">Additional Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control" id="extra_description" name="extra_description" rows="5" placeholder="Enter description" required>{{ old('extra_description', $set_apart->extra_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-faculty-and-staff.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                const input = event.target;
                const preview = document.getElementById('thumbnailPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none'); // show preview
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = "#";
                    preview.classList.add('d-none'); // hide if no file
                }
            }

            function previewSectionImage(event) {
                let preview = document.getElementById('sectionImagePreview');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('d-none');
            }

            function previewExtraImage(event) {
                const input = event.target;
                const preview = document.getElementById('extraImagePreview');
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }    
        </script>
</body>

</html>