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
                                        action="{{ route('manage-creativity-activity.store') }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading</label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Banner Image</label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" 
                                                    class="img-fluid rounded border d-none" style="max-height:150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading</label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading">
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image</label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="sectionImagePreview" src="#" alt="Preview" 
                                                    class="img-fluid rounded border d-none" style="max-height:150px; background:black;">
                                            </div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- Title -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="title" type="text" name="title" placeholder="Enter Title" required>
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- Detailed Page Dropdown -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="detailed_page">Is Detailed Page? <span class="txt-danger">*</span></label>
                                            <select class="form-select" id="detailed_page" name="detailed_page" required>
                                                <option value="">Select Option</option>
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                            <div class="invalid-feedback">Please select an option.</div>
                                        </div>

                                        <!-- Description (Shown when NO) -->
                                        <div class="col-md-12" id="simple_description_box">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="editor" class="form-control" rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Detailed Page Section Wrapper -->
                                        <div class="col-12">
                                            <!-- Add More Button (Shown only when Detailed Page = Yes) -->
                                            <div class="mb-3 text-end">
                                                <button type="button" id="addDetailedSection" class="btn btn-sm btn-success" style="display:none;">
                                                    Add Detailed Page 
                                                </button>
                                            </div>

                                            <!-- Template: Detailed Page Section (Hidden initially, cloned for each new section) -->
                                            <div class="detailed_section_template" style="display:none;">
                                                <div class="detailed_section card p-3 mb-4 border">

                                                    <!-- Remove Button -->
                                                    <button type="button" class="btn btn-sm btn-danger remove-section" style="position:absolute; top:10px; right:10px;">&times;</button>


                                                    <!-- Event Name & Banner Image -->
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Event Name <span class="txt-danger">*</span></label>
                                                            <input type="text" name="event_name[]" class="form-control" placeholder="Enter Event Name" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Detailed Page Banner Image <span class="txt-danger">*</span></label>
                                                            <input type="file" name="banner_image[]" class="form-control banner-input" accept="image/*">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                            <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                                            <div class="mt-2">
                                                                <img class="img-fluid rounded border banner-preview" style="max-height:150px; display:none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Detailed Description -->
                                                    <div class="col-md-12 mt-3">
                                                        <label class="form-label">Detailed Description <span class="txt-danger">*</span></label>
                                                        <textarea name="detailed_description[]" class="form-control" rows="4" placeholder="Enter detailed description"></textarea>
                                                    </div>

                                                    <!-- Gallery Table -->
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

                                            <!-- Container where sections will appear -->
                                            <div id="detailedSectionContainer"></div>
                                        </div>


                                        <!-- Submit Buttons -->
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

                    // Update gallery input names
                    const sectionCount = container.querySelectorAll('.detailed_section').length;
                    template.querySelectorAll('.gallery-input').forEach((input, index) => {
                        input.name = `gallery_images[${sectionCount}][]`;
                        input.value = ''; // reset
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
                    // Remove gallery row
                    if (e.target.classList.contains('removeRow')) {
                        const row = e.target.closest('tr');
                        row.remove();
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
                    if (e.target.classList.contains('banner-input')) {
                        const preview = e.target.closest('.detailed_section').querySelector('.banner-preview');
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

                    if (e.target.classList.contains('gallery-input')) {
                        const preview = e.target.closest('tr').querySelector('.img-preview');
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

        </script>

</body>

</html>