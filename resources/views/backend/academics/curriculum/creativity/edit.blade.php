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
                  <h4>Add Creativity, Activity, Service Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-creativity-activity.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Creativity, Activity, Service</li>
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
                        <h4>Creativity, Activity, Service Form</h4>
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
                                        action="{{ route('manage-creativity-activity.update', $creativity->id ?? null) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @php
                                            $showFirstSection = isset($creativity) && $creativity->id == 1;
                                        @endphp

                                        @if($showFirstSection)
                                            <!-- Section Title -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                                <input class="form-control" id="banner_heading" type="text" 
                                                    name="banner_heading" placeholder="Enter Banner Heading" 
                                                    value="{{ old('banner_heading', $creativity->banner_heading ?? '') }}">
                                                <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                            </div>

                                            <!-- Thumbnail Image -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="image">Banner Image</label>
                                                <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                                <div class="invalid-feedback">Please upload a Banner image.</div>
                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                                <div class="mt-2">
                                                    @if(isset($creativity->banner_image))
                                                        <img id="thumbnailPreview" src="{{ asset('uploads/academics/' . $creativity->banner_image) }}" 
                                                            class="img-fluid rounded border" style="max-height:150px; background:black;">
                                                    @else
                                                        <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height:150px; background:black;">
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Section Heading -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_heading">Section Heading</label>
                                                <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading"
                                                    value="{{ old('section_heading', $creativity->section_heading ?? '') }}">
                                                <div class="invalid-feedback">Please enter a Section Heading.</div>
                                            </div>

                                            <!-- Section Image -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="section_image">Section Image</label>
                                                <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSectionImage(event)">
                                                <div class="invalid-feedback">Please upload a Section image.</div>
                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                                <div class="mt-2">
                                                    @if(isset($creativity->section_image))
                                                        <img id="sectionImagePreview" src="{{ asset('uploads/academics/' . $creativity->section_image) }}" 
                                                            class="img-fluid rounded border" style="max-height:150px; background:black;">
                                                    @else
                                                        <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height:150px; background:black;">
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Section Description -->
                                            <div class="col-md-12" id="simple_description_box">
                                                <label for="section_description" class="form-label">Section Description</label>
                                                <textarea name="section_description" id="section_description" class="form-control" rows="4" placeholder="Enter Section description">{{ old('section_description', $creativity->section_description ?? '') }}</textarea>
                                                <div class="invalid-feedback">Please enter a Section description.</div>
                                            </div>

                                            <hr class="mt-5">
                                        @endif

                                        <!-- Title -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="title" type="text" name="title" placeholder="Enter Title" required
                                                value="{{ old('title', $creativity->title ?? '') }}">
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- Detailed Page Dropdown -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="detailed_page">Is Detailed Page? <span class="txt-danger">*</span></label>
                                            <select class="form-select" id="detailed_page" name="detailed_page" required>
                                                <option value="">Select Option</option>
                                                <option value="no" {{ (old('detailed_page', $creativity->detailed_page ?? '') == 'no') ? 'selected' : '' }}>No</option>
                                                <option value="yes" {{ (old('detailed_page', $creativity->detailed_page ?? '') == 'yes') ? 'selected' : '' }}>Yes</option>
                                            </select>
                                            <div class="invalid-feedback">Please select an option.</div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12" id="simple_description_box">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="editor" class="form-control" rows="4" placeholder="Enter description">{{ old('description', $creativity->description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Detailed Page Sections -->
                                        <div class="col-12">
                                            <!-- Add More Button -->
                                            <div class="mb-3 text-end">
                                                <button type="button" id="addDetailedSection" class="btn btn-sm btn-success">
                                                    Add Detailed Page
                                                </button>
                                            </div>

                                            <!-- Template for new section (hidden) -->
                                            <div class="detailed_section_template" style="display:none;">
                                                <div class="detailed_section card p-3 mb-4 border position-relative">
                                                    <button type="button" class="btn btn-sm btn-danger remove-section" style="position:absolute; top:10px; right:10px;">&times;</button>

                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Event Name <span class="txt-danger">*</span></label>
                                                            <input type="text" name="event_name[]" class="form-control" placeholder="Enter Event Name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Detailed Page Banner Image</label>
                                                            <input type="file" name="banner_image[]" class="form-control banner-input" accept="image/*">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                            <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                                            <div class="mt-2">
                                                                <img class="img-fluid rounded border banner-preview" style="max-height:150px; display:none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label class="form-label">Detailed Description</label>
                                                        <textarea name="detailed_description[]" class="form-control" rows="4" placeholder="Enter detailed description"></textarea>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <h5># Gallery Images</h5>
                                                        <table class="table table-bordered gallery-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Image</th>
                                                                    <th>Preview</th>
                                                                    <th>
                                                                        <button type="button" class="btn btn-sm btn-success addGalleryRow">Add More</button>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="file" name="gallery_images[0][]" class="form-control gallery-input" accept="image/*">
                                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                                        <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>
                                                                    </td>
                                                                    <td><img class="img-preview" style="max-height:80px; display:none;"></td>
                                                                    <td><button type="button" class="btn btn-sm btn-danger removeRow">Remove</button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Existing sections -->
                                            <div id="detailedSectionContainer">
                                                @php
                                                    $sections = json_decode($creativity->detailed_sections, true) ?? [];
                                                    // Remove any null or empty sections
                                                    $sections = array_filter($sections, fn($s) => !empty($s['event_name']) || !empty($s['detailed_description']) || !empty($s['banner_image']));
                                                    $sections = array_values($sections); // Reindex starting from 0
                                                @endphp

                                                @foreach($sections as $index => $section)
                                                    <div class="detailed_section card p-3 mb-4 border position-relative">
                                                        <button type="button" class="btn btn-sm btn-danger remove-section" style="position:absolute; top:10px; right:10px;">&times;</button>

                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Event Name</label>
                                                                <input type="text" name="event_name[]" class="form-control" value="{{ $section['event_name'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Detailed Page Banner Image</label>
                                                                <input type="file" name="banner_image[{{ $index }}]" class="form-control banner-input" accept="image/*">
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                                <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>
                                                                @if(!empty($section['banner_image']))
                                                                    <div class="mt-2">
                                                                        <img class="img-fluid rounded border banner-preview" src="{{ asset('uploads/academics/' . $section['banner_image']) }}" style="max-height:150px;">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mt-3">
                                                            <label class="form-label">Detailed Description</label>
                                                             <textarea name="detailed_description[{{ $index }}]" class="form-control" rows="4">{{ $section['detailed_description'] ?? '' }}</textarea>
                                                        </div>

                                                        <div class="col-md-12 mt-3">
                                                            <h5># Gallery Images</h5>
                                                            <table class="table table-bordered gallery-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Image</th>
                                                                        <th>Preview</th>
                                                                        <th>
                                                                            <button type="button" class="btn btn-sm btn-success addGalleryRow">Add More</button>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $galleryImages = $section['gallery_images'] ?? [];
                                                                    @endphp

                                                                    @if(count($galleryImages))
                                                                        @foreach($galleryImages as $galleryIndex => $gallery)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="file" name="gallery_images[{{ $index }}][]" class="form-control gallery-input" multiple>
                                                                                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                                                    <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>
                                                                                    <!-- Keep existing image as old_gallery_images -->
                                                                                    <input type="hidden" name="old_gallery_images[{{ $index }}][]" value="{{ $gallery }}">
                                                                                </td>
                                                                                <td>
                                                                                    <img src="{{ asset('uploads/academics/' . $gallery) }}" class="img-fluid rounded border img-preview" style="max-height:80px;">
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                        <tr>
                                                                            <td>
                                                                                <input type="file" name="gallery_images[{{ $index }}][]" class="form-control gallery-input" multiple>
                                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                                                <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>
                                                                            </td>
                                                                            <td>
                                                                                <img class="img-preview" style="max-height:80px; display:none;">
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>




                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>


                                        <div class="col-12 text-end mt-4">
                                            <a href="{{ route('manage-creativity-activity.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Submit</button>
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
                const input = event.target;
                const preview = document.getElementById('sectionImagePreview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const detailedPageSelect = document.getElementById('detailed_page'); // dropdown yes/no
                const addDetailedBtn = document.getElementById('addDetailedSection');
                const container = document.getElementById('detailedSectionContainer');

                // Function to add a new detailed section
                function addDetailedSection() {
                    const template = document.querySelector('.detailed_section_template').cloneNode(true);
                    template.style.display = 'block';
                    template.classList.remove('detailed_section_template');

                    const sectionCount = container.querySelectorAll('.detailed_section').length;

                    // Update section input names
                    template.querySelector('input[name="event_name[]"]').name = `event_name[${sectionCount}]`;
                    template.querySelector('input[name="banner_image[]"]').name = `banner_image[${sectionCount}]`;
                    template.querySelector('textarea[name="detailed_description[]"]').name = `detailed_description[${sectionCount}]`;

                    // Update gallery input names
                    template.querySelectorAll('.gallery-input').forEach(input => {
                        input.name = `gallery_images[${sectionCount}][]`;
                        input.value = '';
                    });

                    // Reset previews
                    template.querySelectorAll('.banner-preview, .img-preview').forEach(img => {
                        img.src = '#';
                        img.style.display = 'none';
                    });

                    container.appendChild(template);
                }



                // Show Add More button if Yes is selected and add first section
                function handleDetailedPageChange() {
                    if (detailedPageSelect.value === 'yes') {
                        addDetailedBtn.style.display = 'inline-block';
                        if (container.querySelectorAll('.detailed_section').length === 0) {
                            addDetailedSection();
                        }
                    } else {
                        addDetailedBtn.style.display = 'none';
                        container.innerHTML = '';
                    }
                }

                // Dropdown change
                detailedPageSelect.addEventListener('change', handleDetailedPageChange);

                // Add More button click
                addDetailedBtn.addEventListener('click', addDetailedSection);

                // Remove entire detailed section
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-section')) {
                        const section = e.target.closest('.detailed_section');
                        section.remove();
                    }
                
                    // Add gallery row
                    if (e.target.classList.contains('addGalleryRow')) {
                        const galleryTable = e.target.closest('.gallery-table');
                        const tbody = galleryTable.querySelector('tbody');
                        const rowCount = tbody.querySelectorAll('tr').length;
                        const newRow = tbody.querySelector('tr').cloneNode(true);
                        newRow.querySelectorAll('input').forEach(input => input.value = '');
                        newRow.querySelector('img').style.display = 'none';
                        tbody.appendChild(newRow);
                    }
                });

                // Banner & gallery image previews
                document.addEventListener('change', function(e) {
                    // Banner image preview
                    if (e.target.classList.contains('banner-input')) {
                        // Get the parent .detailed_section of this input
                        const section = e.target.closest('.detailed_section');
                        if (!section) return;

                        // Find the preview img inside this section only
                        const preview = section.querySelector('.banner-preview');
                        if (!preview) return;

                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = evt => {
                                preview.src = evt.target.result;
                                preview.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = '#';
                            preview.style.display = 'none';
                        }
                    }

                    // Gallery image preview
                    if (e.target.classList.contains('gallery-input')) {
                        const row = e.target.closest('tr');
                        if (!row) return;

                        const preview = row.querySelector('.img-preview');
                        if (!preview) return;

                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = evt => {
                                preview.src = evt.target.result;
                                preview.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = '#';
                            preview.style.display = 'none';
                        }
                    }
                });

                // Initial check
                handleDetailedPageChange();
            });

            document.addEventListener('click', function(e){
                if(e.target.classList.contains('removeRow')){
                    const row = e.target.closest('tr');
                    
                    // Mark old_gallery_images as removed (if exists)
                    const oldInput = row.querySelector('input[type="hidden"]');
                    if(oldInput){
                        const removedInput = document.createElement('input');
                        removedInput.type = 'hidden';
                        removedInput.name = oldInput.name.replace('old_gallery_images', 'removed_gallery_images');
                        removedInput.value = oldInput.value;
                        row.closest('form').appendChild(removedInput);
                    }

                    // Remove row from table
                    row.remove();
                }
            });


        </script>

</body>

</html>