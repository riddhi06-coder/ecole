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
                  <h4>Edit FAQs Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-faqs.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit FAQs </li>
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
                        <h4>FAQs Form</h4>
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
                                        action="{{ route('manage-faqs.update', $faq->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading </label>
                                            <input class="form-control" 
                                                id="banner_heading" 
                                                type="text" 
                                                name="banner_heading" 
                                                placeholder="Enter Banner Heading"
                                                value="{{ old('banner_heading', $faq->banner_heading) }}">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image"> Banner Image </label>
                                            <input class="form-control" 
                                                id="image" 
                                                type="file" 
                                                name="image" 
                                                onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                @if($faq->banner_image)
                                                    <img id="existingImage" 
                                                        src="{{ asset('uploads/admissions/' . $faq->banner_image ) }}" 
                                                        alt="Current Banner" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px; background:black;">
                                                @endif

                                                <!-- New Preview -->
                                                <img id="thumbnailPreview" 
                                                    src="#" 
                                                    alt="Preview" 
                                                    class="img-fluid rounded border d-none" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- FAQ Question -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="faq_qts">FAQ Question<span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="faq_qts" 
                                                type="text" 
                                                name="faq_qts" 
                                                placeholder="Enter FAQ Question" 
                                                required
                                                value="{{ old('faq_qts', $faq->faq_qts) }}">
                                            <div class="invalid-feedback">Please enter a FAQ Question.</div>
                                        </div>

                                        <!-- FAQ Answer -->
                                        <div class="col-md-12">
                                            <label for="faq_ans" class="form-label">FAQ Answer <span class="txt-danger">*</span></label>
                                            <textarea name="faq_ans" 
                                                    id="editor1" 
                                                    class="form-control" 
                                                    rows="4" 
                                                    required 
                                                    placeholder="Enter FAQ Answer">{{ old('faq_ans', $faq->faq_ans) }}</textarea>
                                            <div class="invalid-feedback">Please enter a FAQ Answer.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-faqs.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                const file = event.target.files[0];
                const preview = document.getElementById('thumbnailPreview');
                const existing = document.getElementById('existingImage');

                if (file) {
                    if (existing) existing.style.display = "none"; // Hide existing image
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove("d-none");
                }
            }
        </script>
</body>

</html>