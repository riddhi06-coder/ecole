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
                  <h4>Add Alumni Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-about-alumni.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Alumni</li>
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
                        <h4>Alumni Form</h4>
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
                                        action="{{ route('manage-about-alumni.update', $alumni->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image </label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                @if($alumni->banner_image)
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/about/' . $alumni->banner_image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading </label>
                                            <input class="form-control" id="banner_heading" type="text" 
                                                name="banner_heading" placeholder="Enter Banner Heading"
                                                value="{{ old('banner_heading', $alumni->banner_heading) }}">
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
                                        </div>

                                        <!-- Alumni Email -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="alumni_email">Alumni Email </label>
                                            <input class="form-control" id="alumni_email" type="text" 
                                                name="alumni_email" placeholder="Enter Alumni Email"
                                                value="{{ old('alumni_email', $alumni->alumni_email) }}">
                                            <div class="invalid-feedback">Please enter Alumni Email.</div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Alumni Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="alumni_image">Alumni Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="alumni_image" type="file" name="alumni_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Section Image Preview -->
                                            <div class="mt-2">
                                                @if($alumni->alumni_image)
                                                    <img id="sectionImagePreview" src="{{ asset('uploads/about/' . $alumni->alumni_image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                    <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Alumni Name -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="alumni_name">Alumni Name <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="alumni_name" type="text" 
                                                name="alumni_name" placeholder="Enter Alumni Name" required
                                                value="{{ old('alumni_name', $alumni->alumni_name) }}">
                                            <div class="invalid-feedback">Please enter Alumni Name.</div>
                                        </div>

                                        <!-- Alumni Description -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="alumni_desc">Alumni Description <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="alumni_desc" type="text" 
                                                name="alumni_desc" placeholder="Enter Alumni Description" required
                                                value="{{ old('alumni_desc', $alumni->alumni_desc) }}">
                                            <div class="invalid-feedback">Please enter Alumni Description.</div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="section_description">Review <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="section_description" rows="5" placeholder="Enter Description" required>{{ old('section_description', $alumni->section_description) }}</textarea>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-about-alumni.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        </script>
</body>

</html>