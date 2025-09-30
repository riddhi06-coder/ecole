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
                  <h4>Edit IB Visual and Performing Arts Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-ib-visual.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit IB Visual and Performing Arts</li>
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
                        <h4>IB Visual and Performing Arts Form</h4>
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
                                        action="{{ route('manage-ib-visual.update', $performing->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Use PUT for update -->

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading </label>
                                            <input class="form-control" id="banner_heading" type="text" 
                                                name="banner_heading" 
                                                placeholder="Enter Banner Heading"
                                                value="{{ old('banner_heading', $performing->banner_heading) }}">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_image"> Banner Image </label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" 
                                                    src="{{ $performing->banner_image ? asset('uploads/campus-life/' . $performing->banner_image) : '#' }}" 
                                                    alt="Banner Preview" 
                                                    class="img-fluid rounded border" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading </label>
                                            <input class="form-control" id="section_heading" type="text" 
                                                name="section_heading" 
                                                placeholder="Enter Section Heading"
                                                value="{{ old('section_heading', $performing->section_heading) }}">
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image"> Section Image </label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSection(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                <img id="sectionPreview" 
                                                    src="{{ $performing->section_image ? asset('uploads/campus-life/' . $performing->section_image) : '#' }}" 
                                                    alt="Section Preview" 
                                                    class="img-fluid rounded border" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- Title -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="title">Title<span class="txt-danger">*</span></label>
                                            <input class="form-control" id="title" type="text" name="title" placeholder="Enter Title" 
                                                value="{{ old('title', $performing->title) }}" required>
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- Description Textarea -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="editor" class="form-control" rows="4" required placeholder="Enter description">{{ old('description', $performing->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-ib-visual.index') }}" class="btn btn-danger px-4">Cancel</a>
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

            // Preview Section Image
            function previewSection(event) {
                var output = document.getElementById('sectionPreview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.classList.remove('d-none');
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // Free memory
                }
            }
        </script>
</body>

</html>