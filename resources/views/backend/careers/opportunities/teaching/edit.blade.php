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
                  <h4>Edit Teaching Job Opportunities Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-teaching-jobs.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Teaching Job Opportunities</li>
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
                        <h4>Teaching Job Opportunities Form</h4>
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
                                        action="{{ route('manage-teaching-jobs.update', $teaching->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="banner_heading" 
                                                type="text" 
                                                name="banner_heading" 
                                                value="{{ old('banner_heading', $teaching->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" 
                                                required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="image" 
                                                type="file" 
                                                name="image" 
                                                onchange="previewThumbnail(event)">
                                            <small class="text-secondary d-block"><b>Note:</b> File size should be less than 2MB.</small>
                                            <small class="text-secondary d-block"><b>Allowed formats:</b> .jpg, .jpeg, .png, .webp, .svg</small>

                                            <!-- Current Image -->
                                            @if(!empty($teaching->banner_image) && file_exists(public_path('uploads/careers/' . $teaching->banner_image)))
                                                <div class="mt-2">
                                                    <p class="mb-1 text-muted">Current Banner Image:</p>
                                                    <img src="{{ asset('uploads/careers/' . $teaching->banner_image) }}" 
                                                        alt="Current Banner" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px; background:black;">
                                                </div>
                                            @endif

                                            <!-- New Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="section_heading" 
                                                type="text" 
                                                name="section_heading" 
                                                value="{{ old('section_heading', $teaching->section_heading) }}" 
                                                placeholder="Enter Section Heading" 
                                                required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="section_image" 
                                                type="file" 
                                                name="section_image" 
                                                onchange="previewSectionImage(event)">
                                            <small class="text-secondary d-block"><b>Note:</b> File size should be less than 2MB.</small>
                                            <small class="text-secondary d-block"><b>Allowed formats:</b> .jpg, .jpeg, .png, .webp, .svg</small>

                                            <!-- Current Image -->
                                            @if(!empty($teaching->section_image) && file_exists(public_path('uploads/careers/' . $teaching->section_image)))
                                                <div class="mt-2">
                                                    <p class="mb-1 text-muted">Current Section Image:</p>
                                                    <img src="{{ asset('uploads/careers/' . $teaching->section_image) }}" 
                                                        alt="Current Section" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px; background:black;">
                                                </div>
                                            @endif

                                            <!-- New Preview -->
                                            <div class="mt-2">
                                                <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" 
                                                    id="editor" 
                                                    class="form-control" 
                                                    rows="4" 
                                                    placeholder="Enter description" 
                                                    required>{{ old('description', $teaching->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-teaching-jobs.index') }}" class="btn btn-danger px-4">Cancel</a>
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