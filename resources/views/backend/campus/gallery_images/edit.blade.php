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
                  <h4>Edit Gallery Images Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-gallery-images.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Gallery Images</li>
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
                        <h4>Gallery Images Form</h4>
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
                                        id="galleryForm"
                                        action="{{ route('manage-gallery-images.update', $gallery_images->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image</label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                @if($gallery_images->banner_image)
                                                    <img id="thumbnailPreview" 
                                                        src="{{ asset('uploads/campus-life/' . $gallery_images->banner_image) }}" 
                                                        alt="Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading</label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $gallery_images->banner_heading) }}" 
                                                placeholder="Enter Banner Heading">
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Event Name -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="event_name">Event Name <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="event_name" type="text" name="event_name" 
                                                value="{{ old('event_name', $gallery_images->event_name) }}" 
                                                placeholder="Enter Event Name" required>
                                            <div class="invalid-feedback">Please enter Event Name.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail_image">Thumbnail Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail_image" type="file" name="thumbnail_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Section Image Preview -->
                                            <div class="mt-2">
                                                @if($gallery_images->thumbnail_image)
                                                    <img id="sectionImagePreview" 
                                                        src="{{ asset('uploads/campus-life/' . $gallery_images->thumbnail_image) }}" 
                                                        alt="Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Gallery Image Upload -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0"><strong>Gallery Images</strong></h5>
                                                <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                            </div>

                                            <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Image: <span class="text-danger">*</span></th>
                                                        <th>Preview</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $galleryImages = $gallery_images->gallery_images ? json_decode($gallery_images->gallery_images, true) : [];
                                                    @endphp

                                                    @forelse($galleryImages as $key => $image)
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, {{ $key }})" 
                                                                    accept=".png, .jpg, .jpeg, .webp" 
                                                                    name="gallery_image[]" 
                                                                    id="gallery_image_{{ $key }}" 
                                                                    class="form-control" 
                                                                    placeholder="Upload Gallery Image">
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            </td>
                                                            <td>
                                                                <div id="gallery-preview-container-{{ $key }}">
                                                                    <img src="{{ asset('uploads/campus-life/gallery/' . $image) }}" 
                                                                        class="img-fluid rounded border" 
                                                                        style="max-height: 100px;">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger removeGalleryRow" 
                                                                        data-filename="{{ $image }}">Remove</button>
                                                            </td>
                                                        </tr>

                                                    @empty
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, 0)" 
                                                                    accept=".png, .jpg, .jpeg, .webp" 
                                                                    name="gallery_image[]" 
                                                                    id="gallery_image_0" 
                                                                    class="form-control" 
                                                                    placeholder="Upload Gallery Image" required>
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            </td>
                                                            <td>
                                                                <div id="gallery-preview-container-0"></div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-gallery-images.index') }}" class="btn btn-danger px-4">Cancel</a>
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



        <!--Gallery Image Preview & Add More Option-->
        <script>
            $(document).ready(function () {
                // Get last used key from Blade or default to 0
                let rowId = {{ !empty($galleryImages) ? max(array_keys($galleryImages)) + 1 : 0 }};

                // Add a new gallery image row
                $('#addGalleryRow').click(function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="file" onchange="previewGalleryImage(this, ${rowId})" 
                                    accept=".png, .jpg, .jpeg, .webp" 
                                    name="gallery_image[]" 
                                    id="gallery_image_${rowId}" 
                                    class="form-control" 
                                    placeholder="Upload Gallery Image">
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
                    const row = $(this).closest('tr');
                    const filename = $(this).data('filename'); // get the filename from button

                    if (filename) {
                        // Append a hidden input with the removed filename
                        const removedInput = $('<input>').attr({
                            type: 'hidden',
                            name: 'removed_gallery_images[]',
                            value: filename
                        });
                        $('#galleryForm').append(removedInput);
                    }

                    row.remove();
                });


            });


            // Preview function for gallery images
            function previewGalleryImage(input, rowId) {
                const file = input.files[0];
                const previewContainer = document.getElementById(`gallery-preview-container-${rowId}`);

                if (!previewContainer) return; // safety check

                previewContainer.innerHTML = '';

                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (validImageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '120px';
                            img.style.maxHeight = '100px';
                            img.style.objectFit = 'cover';
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.innerHTML = '<p>Unsupported file type</p>';
                    }
                }
            }

        </script>

</body>

</html>