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
                  <h4>Edit Testimonials Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-testimonials.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Testimonials</li>
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
                        <h4>Testimonials Form</h4>
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
                                        action="{{ route('manage-testimonials.update', $testimonial->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Background Image</label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>
                                            
                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                @if($testimonial->image)
                                                    <img id="thumbnailPreview" 
                                                        src="{{ asset('uploads/home/'. $testimonial->image) }}" 
                                                        alt="Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px; background:black;">
                                                @else
                                                    <img id="thumbnailPreview" 
                                                        src="#" 
                                                        alt="Preview" 
                                                        class="img-fluid rounded border d-none" 
                                                        style="max-height: 150px; background:black;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Reviewer -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="reviewer">Reviewer <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="reviewer" type="text" name="reviewer" 
                                                value="{{ old('reviewer', $testimonial->reviewer) }}" 
                                                placeholder="Enter Reviewer" required>
                                            <div class="invalid-feedback">Please enter a Reviewer.</div>
                                        </div>

                                        <!-- Reviewer Details -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="reviewer_details">Reviewer Details <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="reviewer_details" type="text" name="reviewer_details" 
                                                value="{{ old('reviewer_details', $testimonial->reviewer_details) }}" 
                                                placeholder="Enter Reviewer Details" required>
                                            <div class="invalid-feedback">Please enter Reviewer Details.</div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="bulletin_description" id="bulletin_description" class="form-control" rows="4" 
                                                    placeholder="Enter Description" required>{{ old('bulletin_description', $testimonial->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Description.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-testimonials.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        </script>

        <script>
            function previewResultsImage(event) {
                const input = event.target;
                const preview = document.getElementById('resultsPreview');

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



        <!--Gallery Image Preview & Add More Option-->
        <script>
            $(document).ready(function () {
                let rowId = 0;

                // Add a new gallery image row
                $('#addGalleryRow').click(function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="file" onchange="previewGalleryImage(this, ${rowId})" accept=".png, .jpg, .jpeg, .webp" name="gallery_image[]" id="gallery_image_${rowId}" class="form-control" placeholder="Upload Gallery Image">
                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                <br>
                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                            </td>
                            <td>
                                <div id="gallery-preview-container-${rowId}"></div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                            </td>
                        </tr>`;
                    $('#galleryTable tbody').append(newRow);
                });

                // Remove a gallery image row
                $(document).on('click', '.removeGalleryRow', function () {
                    $(this).closest('tr').remove();
                });
            });

            // Preview function for gallery images
            function previewGalleryImage(input, rowId) {
                const file = input.files[0];
                const previewContainer = document.getElementById(`gallery-preview-container-${rowId}`);

                // Clear previous preview
                previewContainer.innerHTML = '';

                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Create an image element for preview
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '120px';
                            img.style.maxHeight = '100px';
                            img.style.objectFit = 'cover';

                            previewContainer.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.innerHTML = '<p>Unsupported file type</p>';
                    }
                }
            }
        </script>

</body>

</html>