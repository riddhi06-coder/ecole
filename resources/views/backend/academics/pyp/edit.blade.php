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
                  <h4>Edit IB Early Years & Primary Years Programme Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-pyp.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit IB Early Years & Primary Years Programme</li>
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
                        <h4>IB Early Years & Primary Years Programme Form</h4>
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
                                        action="{{ route('manage-pyp.update', $curriculum->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" 
                                                name="banner_heading" 
                                                placeholder="Enter Banner Heading" 
                                                value="{{ old('banner_heading', $curriculum->banner_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image"> Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)"> 
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" 
                                                    src="{{ $curriculum->banner_image ? asset('uploads/academics/'.$curriculum->banner_image) : '#' }}" 
                                                    alt="Preview" 
                                                    class="img-fluid rounded border {{ $curriculum->banner_image ? '' : 'd-none' }}" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" 
                                                name="section_heading" 
                                                placeholder="Enter Section Heading" 
                                                value="{{ old('section_heading', $curriculum->section_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Allowed formats: .jpg, .jpeg, .png, .webp, .svg</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="sectionImagePreview" 
                                                    src="{{ $curriculum->section_image ? asset('uploads/academics/'.$curriculum->section_image) : '#' }}" 
                                                    alt="Preview" 
                                                    class="img-fluid rounded border {{ $curriculum->section_image ? '' : 'd-none' }}" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Small Intro -->
                                        <div class="col-md-12">
                                            <label for="small_intro" class="form-label">Small Intro <span class="txt-danger">*</span></label>
                                            <textarea name="small_intro" id="small_intro" class="form-control" rows="4" 
                                                    placeholder="Enter Small Intro" required>{{ old('small_intro', $curriculum->small_intro) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Small Intro.</div>
                                        </div>

                                        <!-- Program Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="program_heading">Program Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="program_heading" type="text" 
                                                name="program_heading" 
                                                placeholder="Enter Program Heading" 
                                                value="{{ old('program_heading', $curriculum->program_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Program Heading.</div>
                                        </div>

                                        <!-- Program Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="program_image">Program Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="program_image" type="file" name="program_image" onchange="previewprogramImage(event)">
                                            <div class="invalid-feedback">Please upload a Program image.</div>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="programImagePreview" 
                                                    src="{{ $curriculum->program_image ? asset('uploads/academics/'.$curriculum->program_image) : '#' }}" 
                                                    alt="Preview" 
                                                    class="img-fluid rounded border {{ $curriculum->program_image ? '' : 'd-none' }}" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Program Description -->
                                        <div class="col-md-12">
                                            <label for="program_description" class="form-label">Program Description <span class="txt-danger">*</span></label>
                                            <textarea name="program_description" id="program_description" class="form-control" rows="4" 
                                                    placeholder="Enter Program description" required>{{ old('program_description', $curriculum->program_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Program description.</div>
                                        </div>

                                        <!-- Curriculum Framework Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="framework_heading">Curriculum Framework Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="framework_heading" type="text" 
                                                name="framework_heading" 
                                                placeholder="Enter Curriculum Framework Heading" 
                                                value="{{ old('framework_heading', $curriculum->framework_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Curriculum Framework Heading.</div>
                                        </div>

                                        <!-- Curriculum Framework Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="framework_image">Curriculum Framework Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="framework_image" type="file" name="framework_image" onchange="previewframeImage(event)">
                                            <div class="invalid-feedback">Please upload a Curriculum Framework image.</div>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="frameImagePreview" 
                                                    src="{{ $curriculum->framework_image ? asset('uploads/academics/'.$curriculum->framework_image) : '#' }}" 
                                                    alt="Preview" 
                                                    class="img-fluid rounded border {{ $curriculum->framework_image ? '' : 'd-none' }}" 
                                                    style="max-height: 150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Curriculum Description -->
                                        <div class="col-md-12">
                                            <label for="curriculum_description" class="form-label">Curriculum Description <span class="txt-danger">*</span></label>
                                            <textarea name="curriculum_description" id="editor" class="form-control" rows="4" 
                                                    placeholder="Enter Curriculum Description" required>{{ old('curriculum_description', $curriculum->curriculum_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Curriculum description.</div>
                                        </div>

                                        <!-- Extra Info -->
                                        <div class="col-md-12 mt-5">
                                            <label for="extra_info" class="form-label">Extra Information <span class="txt-danger">*</span></label>
                                            <textarea name="extra_info" id="extra_info" class="form-control" rows="4" 
                                                    placeholder="Enter Extra Information" required>{{ old('extra_info', $curriculum->extra_info) }}</textarea>
                                            <div class="invalid-feedback">Please enter Extra Information.</div>
                                        </div>

                                        <!-- Document Upload -->
                                        <div class="col-md-6 mt-5" id="document-upload-section">
                                            <label for="document" class="form-label">Upload Document (Optional)</label>
                                            <input type="file" name="document" id="document" class="form-control" accept=".pdf,.doc,.docx,.xlsx">
                                            <input type="hidden" name="remove_document" id="remove_document_input" value="0">

                                            <!-- 📄 File Preview Box -->
                                            <div id="document-preview" class="mt-3 position-relative border rounded bg-light p-3 {{ $curriculum->document ? '' : 'd-none' }}">
                                                <span id="remove-document"
                                                    class="text-danger fw-bold"
                                                    style="cursor:pointer; font-size:18px; position:absolute; right:8px; top:5px;">&times;</span>
                                                <div class="d-flex align-items-center mt-3">
                                                    <i class="bi bi-file-earmark-text me-2" style="font-size:22px;"></i>
                                                    <span id="document-name" class="text-dark fw-semibold">{{ $curriculum->document ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Document URL -->
                                        <div class="col-md-6 mt-5">
                                            <label for="doc_url" class="form-label">Document URL (Optional)</label>
                                            <input type="url" name="doc_url" id="doc_url" class="form-control" 
                                                placeholder="Enter a valid URL" 
                                                value="{{ old('doc_url', $curriculum->doc_url) }}">
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-pyp.index') }}" class="btn btn-danger px-4">Cancel</a>
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

            function previewprogramImage(event) {
                const input = event.target;
                const preview = document.getElementById('programImagePreview');

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

            function previewframeImage(event) {
                const input = event.target;
                const preview = document.getElementById('frameImagePreview');

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
                        preview.style.display = 'block';  // ✅ ensures it shows
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = "#";
                    preview.style.display = 'none';
                    preview.classList.add('d-none');
                }
            }


        </script>

        <script>
            ClassicEditor.create(document.querySelector('#program_description'), {
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
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells', 
                        'tableProperties', 'tableCellProperties'
                    ]
                },

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
            ClassicEditor.create(document.querySelector('#extra_info'), {
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
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells', 
                        'tableProperties', 'tableCellProperties'
                    ]
                },
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
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('document');
                const previewBox = document.getElementById('document-preview');
                const fileNameText = document.getElementById('document-name');
                const removeIcon = document.getElementById('remove-document');
                const removeInput = document.getElementById('remove_document_input');

                // When a file is selected
                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        fileNameText.textContent = file.name;
                        previewBox.classList.remove('d-none');
                        removeInput.value = 0; // reset remove flag
                    } else {
                        fileNameText.textContent = '';
                        previewBox.classList.add('d-none');
                    }
                });

                // When ❌ clicked
                removeIcon.addEventListener('click', function() {
                    fileInput.value = ''; // clear file input
                    fileNameText.textContent = ''; // clear file name
                    previewBox.classList.add('d-none'); // hide preview
                    removeInput.value = 1; // mark for removal
                });
            });

        </script>






</body>

</html>