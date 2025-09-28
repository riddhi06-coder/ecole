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
                  <h4>Edit Accreditation and associations Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-accredation-association.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Accreditation and associations</li>
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
                        <h4>Accreditation and associations Form</h4>
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
                                        action="{{ route('manage-accredation-association.update', $accredation->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading</label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $accredation->banner_heading) }}" 
                                                placeholder="Enter Banner Heading">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner">Banner Image</label>
                                            <input class="form-control" id="banner" type="file" name="banner" onchange="previewbanner(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="invalid-feedback">Please upload a Banner Image.</div>

                                            <!-- Preview (existing or new) -->
                                            <div class="mt-2">
                                                <img id="bannerPreview" 
                                                    src="{{ $accredation->banner_image ? asset('uploads/about/'.$accredation->banner_image) : '#' }}" 
                                                    alt="Banner" 
                                                    class="img-fluid rounded border" 
                                                    style="max-height: 150px; {{ $accredation->banner_image ? '' : 'display:none;' }}">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading</label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" 
                                                value="{{ old('section_heading', $accredation->section_heading) }}" 
                                                placeholder="Enter Section Heading">
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="section_desc">Section Description</label>
                                            <textarea class="form-control" id="section_desc" name="section_desc" rows="4" placeholder="Enter Section Description">{{ old('section_desc', $accredation->section_desc) }}</textarea>
                                            <div class="invalid-feedback">Please enter Section Description.</div>
                                        </div>

                                        <hr>

                                        <!-- Organization Name -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="org_name">Organization Name</label>
                                            <input class="form-control" id="org_name" type="text" name="org_name" 
                                                value="{{ old('org_name', $accredation->org_name) }}" 
                                                placeholder="Enter Organization Name" required>
                                            <div class="invalid-feedback">Please enter Organization Name.</div>
                                        </div>

                                        <!-- Organization Image -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="org_image">Organization Image</label>
                                            <input class="form-control" id="org_image" type="file" name="org_image" onchange="previewThumbnail(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="invalid-feedback">Please upload an Organization Image.</div>

                                            <!-- Existing Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" 
                                                    src="{{ $accredation->org_image ? asset('uploads/about/'.$accredation->org_image) : '#' }}" 
                                                    alt="Organization" 
                                                    class="img-fluid rounded border" 
                                                    style="max-height: 150px; {{ $accredation->org_image ? '' : 'display:none;' }}">
                                            </div>
                                        </div>

                                        <!-- Organization Description -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="org_desc">Organization Description</label>
                                            <textarea class="form-control" id="org_desc" name="org_desc" rows="4" placeholder="Enter Organization Description">{{ old('org_desc', $accredation->org_desc) }}</textarea>
                                            <div class="invalid-feedback">Please enter Organization Description.</div>
                                        </div>

                                        <!-- Gallery Images -->
                                        <div class="table-container mt-5">
                                            <h5 class="mb-4"><strong>Gallery Images</strong></h5>
                                            <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Uploaded Gallery Image:</th>
                                                        <th>Preview</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $galleryImages = $accredation->gallery_images ? json_decode($accredation->gallery_images, true) : [];
                                                    @endphp

                                                    @forelse($galleryImages as $index => $image)
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, {{ $index }})"
                                                                    accept=".png,.jpg,.jpeg,.webp" 
                                                                    name="gallery_image[]" 
                                                                    id="gallery_image_{{ $index }}" 
                                                                    class="form-control">
                                                                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                    <br>
                                                                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                                     <input type="hidden" name="existing_gallery[]" value="{{ $image }}">
                                                            </td>
                                                            <td>
                                                                <div id="gallery-preview-container-{{ $index }}">
                                                                    <img src="{{ asset('uploads/about/'.$image) }}" 
                                                                        alt="Gallery" style="max-height:80px;" class="img-fluid rounded border">

                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if($loop->first)
                                                                    <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, 0)"
                                                                    accept=".png,.jpg,.jpeg,.webp" 
                                                                    name="gallery_image[]" 
                                                                    id="gallery_image_0" 
                                                                    class="form-control">
                                                                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                    <br>
                                                                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            </td>
                                                            <td><div id="gallery-preview-container-0"></div></td>
                                                            <td><button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-accredation-association.index') }}" class="btn btn-danger px-4">Cancel</a>
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


       <!----- Image Preview --->
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

            function previewbanner(event) {
                const input = event.target;
                const preview = document.getElementById('bannerPreview');

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

            function previewThumbnail1(event) {
                const input = event.target;
                const preview = document.getElementById('thumbnail1Preview');

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



        <!--- Gallery Image Upload js ----->
        <script>
            $(document).ready(function () {
                let rowId = {{ count($galleryImages) ?? 0 }}; // Start after existing images

                // Add a new gallery image row
                $(document).on('click', '#addGalleryRow', function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="file" onchange="previewGalleryImage(this, ${rowId})" accept=".png, .jpg, .jpeg, .webp" name="gallery_image[]" id="gallery_image_${rowId}" class="form-control">
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
                    // Remove the hidden input in the same row
                    $(this).closest('tr').find('input[type="hidden"]').remove();
                    // Remove the row
                    $(this).closest('tr').remove();
                });

            });

            // Gallery preview function
            function previewGalleryImage(input, rowId) {
                const previewContainer = document.getElementById(`gallery-preview-container-${rowId}`);
                previewContainer.innerHTML = ''; // Clear previous preview

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                    if (!validTypes.includes(file.type)) {
                        previewContainer.innerHTML = '<p>Unsupported file type</p>';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '120px';
                        img.style.maxHeight = '100px';
                        img.style.objectFit = 'cover';
                        img.classList.add('img-fluid', 'rounded', 'border');

                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }

        </script>


</body>

</html>