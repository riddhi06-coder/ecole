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
                  <h4>Add University of Bath Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-university-bath.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add University of Bath</li>
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
                        <h4>University of Bath Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-university-bath.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" required onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
                                        </div>


                                        <hr class="my-3">


                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading" required>
                                            <div class="invalid-feedback">Please enter a Section Heading</div>
                                        </div>


                                        <!-- Video URL -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="videos_url">Video URL <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="videos_url" type="text" name="videos_url" placeholder="Enter Video URL" required>
                                            <div class="invalid-feedback">Please enter a Video URL</div>
                                        </div>

                                        
                                        <!-- Section Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="section_description">Section Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="section_description" rows="5" placeholder="Enter Description" required></textarea>
                                        </div>



                                        <hr class="my-3 mt-5">


                                        <h4># Units Offered Section</h4>

                                         <!-- Image Heading -->
                                        <div class="col-md-6 mb-3 mt-5">
                                            <label class="form-label" for="unit_heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="unit_heading" type="text" name="unit_heading" placeholder="Enter Heading" required>
                                            <div class="invalid-feedback">Please enter heading.</div>
                                        </div>



                                        <!-- Background Image -->
                                        <div class="col-md-6 mt-5">
                                            <label class="form-label" for="bkg_image">Background Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="bkg_image" type="file" name="bkg_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Section Image Preview -->
                                            <div class="mt-2">
                                                <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>



                                        <!-- Table for Units Offered -->
                                        <div class="mt-5">
                                            <h5>Units Offered</h5>
                                            <table class="table table-bordered" id="unitsTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Title <span class="txt-danger">*</span></th>
                                                        <th>Image Upload <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="unit_titles[]" class="form-control" placeholder="Enter Title" required>
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Upload Image</label>
                                                            <input type="file" name="unit_images[]" class="form-control" accept="image/*" onchange="previewUnitImage(event, this)" required>  
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            <div class="mt-2">
                                                                <img src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 100px;">
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                        <hr class="my-3 mt-5">

                                       
                                        <!-- Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="desc">Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="desc" name="desc" rows="5" placeholder="Enter Description" required></textarea>
                                        </div>


                                        <hr class="my-3 mt-5">


                                        <h4># Documents Section</h4>

                                        <div class="mt-5">
                                            <h5>Documents Upload</h5>
                                            <table class="table table-bordered" id="docsTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Document Name <span class="txt-danger">*</span></th>
                                                        <th>Upload Document <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="doc_names[]" class="form-control" placeholder="Enter Document Name" required>
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Upload File</label>
                                                            <input type="file" name="doc_files[]" class="form-control" onchange="previewDocFile(event, this)" accept=".pdf,.doc,.docx"> 
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .pdf, .docx format can be uploaded.</b></small>
                                                            <div class="mt-2">
                                                                <span class="text-secondary small file-name d-none"></span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <button type="button" class="btn btn-success" onclick="addDocRow()">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-university-bath.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            ClassicEditor.create(document.querySelector('#desc'), {
                toolbar: [
                    'heading', 
                    '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript',
                    'link', 'blockQuote', 'codeBlock',
                    'bulletedList', 'numberedList', 'todoList',
                    '|',
                    'alignment', 'outdent', 'indent',
                    '|',
                    'fontColor', 'fontBackgroundColor', 'fontSize', 'fontFamily',
                    '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', 'horizontalLine', 'pageBreak',
                    '|',
                    'undo', 'redo', 'removeFormat', 'highlight', 'specialCharacters'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                fontFamily: {
                    options: [
                        'default', 'Arial, Helvetica, sans-serif', 'Courier New, Courier, monospace',
                        'Georgia, serif', 'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif'
                    ]
                },
                fontSize: {
                    options: [ 'tiny', 'small', 'default', 'big', 'huge' ]
                },
                alignment: {
                    options: [ 'left', 'center', 'right', 'justify' ]
                }
            })
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

            function previewSectionImage(event) {
                let preview = document.getElementById('sectionImagePreview');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('d-none');
            }
        </script>

        <script>

            // 🖼️ Preview for Unit Images
            function previewUnitImage(event, input) {
                const imgPreview = input.closest('td').querySelector('img');
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        imgPreview.src = e.target.result;
                        imgPreview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            }

            // ➕ Add More Row
            function addRow() {
                const table = document.getElementById('unitsTable').querySelector('tbody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>
                        <input type="text" name="unit_titles[]" class="form-control" placeholder="Enter Title" required>
                    </td>
                    <td>
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="unit_images[]" class="form-control" accept="image/*" onchange="previewUnitImage(event, this)">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                        <div class="mt-2">
                            <img src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 100px;">
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                `;
                table.appendChild(newRow);
            }

            // ❌ Remove Row
            function removeRow(button) {
                button.closest('tr').remove();
            }
        </script>



        <script>
            function addDocRow() {
                const table = document.getElementById('docsTable').querySelector('tbody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>
                        <input type="text" name="doc_names[]" class="form-control" placeholder="Enter Document Name" required>
                    </td>
                    <td>
                        <label class="form-label">Upload File</label>
                        <input type="file" name="doc_files[]" class="form-control" onchange="previewDocFile(event, this)" accept=".pdf,.doc,.docx">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .pdf, .docx format can be uploaded.</b></small>
                        <div class="mt-2">
                            <span class="text-secondary small file-name d-none"></span>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                `;
                table.appendChild(newRow);
            }

            // 📄 File name preview (instead of image)
            function previewDocFile(event, input) {
                const file = input.files[0];
                const fileNameDisplay = input.closest('td').querySelector('.file-name');

                if (file) {
                    fileNameDisplay.textContent = `Selected: ${file.name}`;
                    fileNameDisplay.classList.remove('d-none');
                } else {
                    fileNameDisplay.textContent = '';
                    fileNameDisplay.classList.add('d-none');
                }
            }

            // ✅ Reuse removeRow() from previous table
            function removeRow(button) {
                button.closest('tr').remove();
            }
        </script>


</body>

</html>