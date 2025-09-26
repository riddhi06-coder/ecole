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
                  <h4>Add Vision, Mission & Values Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-vision-mission.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Vision, Mission & Values</li>
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
                        <h4>Vision, Mission & Values Form</h4>
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
                                        action="{{ route('manage-vision-mission.update', $vision_mission->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ $vision_mission->banner_heading }}" placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner" type="file" name="banner" onchange="previewbanner(event)">
                                            <div class="invalid-feedback">Please upload a Banner Image.</div>
                                             <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Preview -->
                                            <div class="mt-2">
                                                @if($vision_mission->banner_image)
                                                    <img id="bannerPreview" src="{{ asset('uploads/about/' . $vision_mission->banner_image) }}" 
                                                        class="img-fluid rounded border" style="max-height:150px;">
                                                @else
                                                    <img id="bannerPreview" src="#" class="img-fluid rounded border d-none" style="max-height:150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Section 1 -->
                                        <h5 class="mb-3"><strong># Section 1</strong></h5>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewThumbnail(event)">
                                             <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="invalid-feedback">Please upload a Section Image.</div>

                                            <div class="mt-2">
                                                @if($vision_mission->section_image)
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/about/' . $vision_mission->section_image) }}" 
                                                        class="img-fluid rounded border" style="max-height:150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" class="img-fluid rounded border d-none" style="max-height:150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Division Details Table -->
                                        <div class="table-container" style="margin-bottom: 20px;">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0"><strong>Division Details</strong></h5>
                                            </div>

                                            <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Icon <span class="text-danger">*</span></th>
                                                        <th>Heading <span class="text-danger">*</span></th>
                                                        <th>Description <span class="text-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $divisionDetails = json_decode($vision_mission->division_details, true) ?? [];
                                                @endphp

                                                <tbody>
                                                    @if(count($divisionDetails) > 0)
                                                        @foreach($divisionDetails as $index => $detail)
                                                            <tr>
                                                                <td>
                                                                    <input type="file" onchange="previewPrintImage(this, {{ $index }})" name="icon[]" class="form-control">
                                                                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                    <br>
                                                                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                                    <div class="mt-2">
                                                                        @if(isset($detail['icon']))
                                                                            <img src="{{ asset('uploads/about/' . $detail['icon']) }}" style="max-height:80px;" class="img-fluid rounded border">
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="heading[]" class="form-control" value="{{ $detail['heading'] ?? '' }}" required>
                                                                </td>
                                                                <td>
                                                                    <textarea name="description_division[]" class="form-control" rows="5" required>{{ $detail['description'] ?? '' }}</textarea>
                                                                </td>
                                                                <td>
                                                                    @if($index === 0)
                                                                        <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewPrintImage(this, 0)" name="icon[]" class="form-control">
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                                <div class="mt-2" id="print-preview-container-0"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="heading[]" class="form-control" placeholder="Enter Heading" required>
                                                            </td>
                                                            <td>
                                                                <textarea name="description_division[]" class="form-control" rows="5" placeholder="Enter Description" required></textarea>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>



                                        <!-- Section 2 -->
                                        <h5 class="mb-3"><strong># Section 2</strong></h5>

                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" 
                                                value="{{ $vision_mission->section_heading }}" required>
                                        </div>



                                        <!-- Gallery Table -->
                                        @php
                                            $gallery = json_decode($vision_mission->gallery_images, true) ?? [];
                                        @endphp
                                        <div class="table-container mt-5" style="margin-bottom: 20px;">
                                            <h5 class="mb-4"><strong>Gallery Image Upload</strong></h5>
                                            <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Uploaded Gallery Image <span class="text-danger">*</span></th>
                                                        <th>Preview</th>
                                                        <th>Features</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($gallery) > 0)
                                                        @foreach($gallery as $index => $g)
                                                            <tr>
                                                                <td>
                                                                    <input type="file" onchange="previewGalleryImage(this, {{ $index }})" name="gallery_image[]" class="form-control">
                                                                     <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                    <br>
                                                                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                                </td>
                                                                <td>
                                                                    @if(isset($g['image']))
                                                                        <img src="{{ asset('uploads/about/' . $g['image']) }}" style="max-height:80px;" class="img-fluid rounded border">
                                                                    @endif
                                                                    <div id="gallery-preview-container-{{ $index }}"></div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="gallery_features[]" class="form-control" value="{{ $g['features'] ?? '' }}">
                                                                </td>
                                                                <td>
                                                                    @if($index === 0)
                                                                        <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <input type="file" onchange="previewGalleryImage(this, 0)" name="gallery_image[]" class="form-control">
                                                            </td>
                                                            <td><div id="gallery-preview-container-0"></div></td>
                                                            <td><input type="text" name="gallery_features[]" class="form-control"></td>
                                                            <td><button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>


                                        
                                        <!-- Section 3 - Features Table -->
                                        @php
                                            $features = json_decode($vision_mission->features_table, true) ?? [];
                                        @endphp
                                        <div class="col-md-12 mt-4">
                                            <h5 class="mb-3"><strong>Features Table</strong></h5>
                                            <table class="table table-bordered" id="headingDescTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Heading <span class="text-danger">*</span></th>
                                                        <th>Description <span class="text-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($features as $index => $f)
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="table_heading[]" class="form-control" value="{{ $f['heading'] ?? '' }}" required>
                                                            </td>
                                                            <td>
                                                                <textarea name="table_description[]" class="form-control" rows="3" required>{{ $f['description'] ?? '' }}</textarea>
                                                            </td>
                                                            <td>
                                                                @if($index === 0)
                                                                    <button type="button" class="btn btn-primary" id="addHeadingDescRow">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger removeHeadingDescRow">Remove</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-vision-mission.index') }}" class="btn btn-danger px-4">Cancel</a>
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


        <!----- Summernote script --->
        <script>
            $(document).ready(function() {
                $('#summernote2').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#summernote3').summernote({
                height: 200, // Adjust height as needed
                focus: true   // Focus the editor when initialized
                });
            });
        </script>


        <!-- Scripts for dynamic rows & image preview Division Details -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let rowIndex = 1; // Start row index for new rows

                // Add row functionality
                document.getElementById("addPrintRow").addEventListener("click", function () {
                    const tableBody = document.querySelector("#printsTable tbody");
                    const newRow = document.createElement("tr");

                    newRow.innerHTML = `
                        <td>
                            <input type="file" onchange="previewPrintImage(this, ${rowIndex})" 
                                accept=".png, .jpg, .jpeg, .webp, .svg" 
                                name="icon[]" id="icon_${rowIndex}" class="form-control" required>
                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                            <br>
                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                            <div class="mt-2" id="print-preview-container-${rowIndex}"></div>
                        </td>
                        <td>
                            <input type="text" name="heading[]" class="form-control" placeholder="Enter Heading" required>
                        </td>
                        <td>
                            <textarea name="description_division[]" class="form-control" placeholder="Enter Description" rows="5" required></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                        </td>
                    `;

                    tableBody.appendChild(newRow);
                    rowIndex++; // Increment row index for unique IDs
                });

                // Remove row functionality
                document.querySelector("#printsTable").addEventListener("click", function (e) {
                    if (e.target.classList.contains("removePrintRow")) {
                        e.target.closest("tr").remove();
                    }
                });
            });


            // Image preview function
            function previewPrintImage(input, index) {
                const previewContainer = document.getElementById(`print-preview-container-${index}`);
                previewContainer.innerHTML = ""; // Clear previous preview
                previewContainer.style.backgroundColor = "#000"; // Set background color to black
                previewContainer.style.padding = "5px"; // Optional: add some padding
                previewContainer.style.display = "inline-block"; // Optional: fit around the image

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.className = "img-fluid rounded border";
                        img.style.maxHeight = "80px";
                        img.style.display = "block";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>


        <!--- Gallery Image Upload js ----->
        <script>
            $(document).ready(function () {
                let rowId = {{ count($gallery) ?? 0 }}; // Start from existing gallery count

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
                                <input type="text" name="gallery_features[]" class="form-control" placeholder="Enter features">
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


        <script>
            $(document).ready(function () {
                let rowId = 0;

                // Add a new Heading+Description row
                $('#addHeadingDescRow').click(function () {
                    rowId++;
                    const newRow = `
                        <tr>
                            <td>
                                <input type="text" name="table_heading[]" class="form-control" placeholder="Enter Heading" required>
                            </td>
                            <td>
                                <textarea name="table_description[]" class="form-control" rows="3" placeholder="Enter Description" required></textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeHeadingDescRow">Remove</button>
                            </td>
                        </tr>`;
                    $('#headingDescTable tbody').append(newRow);
                });

                // Remove a row
                $(document).on('click', '.removeHeadingDescRow', function () {
                    $(this).closest('tr').remove();
                });
            });
        </script>




</body>

</html>