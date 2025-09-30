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
                  <h4>Edit Media Centre Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-media-center.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Media Centre </li>
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
                        <h4>Media Centre Form</h4>
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
                                        action="{{ route('manage-media-center.update', $media->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        {{-- Conditional Section: Only show if this is NOT the first record --}}
                                        @if($media->id == 1)
                                            <!-- Section Title -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="banner_heading">Banner Heading </label>
                                                <input class="form-control" 
                                                    id="banner_heading" 
                                                    type="text" 
                                                    name="banner_heading" 
                                                    value="{{ old('banner_heading', $media->banner_heading) }}" 
                                                    placeholder="Enter Banner Heading">
                                                <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                            </div>

                                            <!-- Thumbnail Image -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="banner_image"> Banner Image </label>
                                                <input class="form-control" 
                                                    id="banner_image" 
                                                    type="file" 
                                                    name="banner_image" 
                                                    onchange="previewThumbnail(event)">
                                                <div class="invalid-feedback">Please upload a Banner image.</div>

                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                                @if($media->banner_image)
                                                    <div class="mt-2">
                                                        <img id="thumbnailPreview" 
                                                            src="{{ asset('uploads/campus-life/'.$media->banner_image) }}" 
                                                            alt="Banner Image" 
                                                            class="img-fluid rounded border" 
                                                            style="max-height: 150px;">
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Section Heading -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_heading">Section Heading </label>
                                                <input class="form-control" 
                                                    id="section_heading" 
                                                    type="text" 
                                                    name="section_heading" 
                                                    value="{{ old('section_heading', $media->section_heading) }}" 
                                                    placeholder="Enter Section Heading">
                                                <div class="invalid-feedback">Please enter a Section Heading.</div>
                                            </div>

                                            <!-- Section Image -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_image"> Section Image </label>
                                                <input class="form-control" 
                                                    id="section_image" 
                                                    type="file" 
                                                    name="section_image" 
                                                    onchange="previewSection(event)">
                                                <div class="invalid-feedback">Please upload a Section image.</div>

                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                                @if($media->section_image)
                                                    <div class="mt-2">
                                                        <img id="sectionPreview" 
                                                            src="{{ asset('uploads/campus-life/'.$media->section_image) }}" 
                                                            alt="Section Image" 
                                                            class="img-fluid rounded border" 
                                                            style="max-height: 150px;">
                                                    </div>
                                                @endif
                                            </div>

                                            <hr class="mt-5">
                                        @endif

                                        <!-- Title -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="title">Title<span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="title" 
                                                type="text" 
                                                name="title" 
                                                value="{{ old('title', $media->title) }}" 
                                                placeholder="Enter Title" required>
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- URL -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="url"> URL</label>
                                            <input class="form-control" 
                                                id="url" 
                                                type="text" 
                                                name="url" 
                                                value="{{ old('url', $media->url) }}" 
                                                placeholder="Enter URL">
                                            <div class="invalid-feedback">Please enter a URL.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="image"> Image </label>
                                            <input class="form-control" 
                                                id="image" 
                                                type="file" 
                                                name="image" 
                                                onchange="previewImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>

                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            @if($media->image)
                                                <div class="mt-2">
                                                    <img id="Preview" 
                                                        src="{{ asset('uploads/campus-life/'.$media->image) }}" 
                                                        alt="Section Image" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Description Textarea -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description </label>
                                            <textarea name="description" 
                                                    id="editor" 
                                                    class="form-control" 
                                                    rows="4" 
                                                    placeholder="Enter description">{{ old('description', $media->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-media-center.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            ClassicEditor.create(document.querySelector('#policy1'))
                .catch(error => { console.error(error); });
        </script>
      
       
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


            function previewSection(event) {
                const input = event.target;
                const preview = document.getElementById('sectionPreview');

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

            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('Preview');

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
        </script>
</body>

</html>