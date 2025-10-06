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
                  <h4>Add University & College Counselling Programme Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-university-page.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add University & College Counselling Programme</li>
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
                        <h4>University & College Counselling Programme Form</h4>
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
                                        action="{{ route('manage-university-page.update', $student_support->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- Section Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="banner_heading" 
                                                type="text" 
                                                name="banner_heading" 
                                                value="{{ old('banner_heading', $student_support->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" 
                                                required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="image" 
                                                type="file" 
                                                name="image" 
                                                onchange="previewThumbnail(event)">
                                            <small class="text-secondary d-block mb-2">
                                                <b>Allowed: jpg, jpeg, png, webp, svg | Max 2MB.</b>
                                            </small>

                                            @if($student_support->banner_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/academics/' . $student_support->banner_image) }}" 
                                                        alt="Banner Image" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height:150px; background:black;">
                                                </div>
                                            @endif

                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" 
                                                    class="img-fluid rounded border d-none" 
                                                    style="max-height:150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="section_heading" 
                                                type="text" 
                                                name="section_heading" 
                                                value="{{ old('section_heading', $student_support->section_heading) }}" 
                                                placeholder="Enter Section Heading" 
                                                required>
                                            <div class="invalid-feedback">Please enter a Section Heading.</div>
                                        </div>

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" 
                                                id="section_image" 
                                                type="file" 
                                                name="section_image" 
                                                onchange="previewSectionImage(event)">
                                            <small class="text-secondary d-block mb-2">
                                                <b>Allowed: jpg, jpeg, png, webp, svg | Max 2MB.</b>
                                            </small>

                                            @if($student_support->section_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/academics/' . $student_support->section_image) }}" 
                                                        alt="Section Image" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height:150px; background:black;">
                                                </div>
                                            @endif

                                            <div class="mt-2">
                                                <img id="sectionImagePreview" src="#" alt="Preview" 
                                                    class="img-fluid rounded border d-none" 
                                                    style="max-height:150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12">
                                            <label for="section_description" class="form-label">Section Description <span class="txt-danger">*</span></label>
                                            <textarea name="section_description" id="section_description" class="form-control" rows="4" required>{{ old('section_description', $student_support->section_description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Section Description.</div>
                                        </div>

                                        <hr class="mt-5">

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description <span class="txt-danger">*</span></label>
                                            <textarea name="description" id="editor" class="form-control" rows="4" required>{{ old('description', $student_support->description) }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>


                                        
                                       <!-- Optional Document Upload -->
                                        <div class="col-md-6 mt-3">
                                            <label for="document" class="form-label">Upload Document (Optional)</label>
                                            <input type="file" name="document" id="document" class="form-control" accept=".pdf,.doc,.docx,.xlsx">
                                            <small class="text-secondary">Allowed formats: PDF, DOC, DOCX, XLSX. Max size 5MB.</small>

                                            @if($student_support->document)
                                                <div class="mt-2 d-flex align-items-center gap-2 doc-preview">
                                                    <a href="{{ asset('uploads/academics/' . $student_support->document) }}" 
                                                    target="_blank" 
                                                    class="btn btn-sm btn-outline-primary">
                                                        View Current Document
                                                    </a>

                                                    <span class="text-danger ms-2 remove-doc" style="cursor: pointer; font-size: 18px;">&times;</span>
                                                </div>
                                            @endif

                                            <!-- Hidden input to track removal -->
                                            <input type="hidden" name="remove_existing_doc" id="remove_existing_doc" value="0">
                                        </div>





                                        <!-- Optional URL -->
                                        <div class="col-md-6 mt-3">
                                            <label for="doc_url" class="form-label">Document URL (Optional)</label>
                                            <input type="url" 
                                                name="doc_url" 
                                                id="doc_url" 
                                                class="form-control" 
                                                placeholder="Enter a valid URL" 
                                                value="{{ old('doc_url', $student_support->url) }}">
                                            <small class="text-secondary">Provide a URL if document is hosted online.</small>
                                        </div>

                                        <!-- Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-university-page.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            ClassicEditor.create(document.querySelector('#section_description'), {
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
                const removeButtons = document.querySelectorAll('.remove-doc');

                removeButtons.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        // Find the closest preview div
                        const docPreviewDiv = btn.closest('.doc-preview');
                        if(docPreviewDiv) {
                            docPreviewDiv.remove(); // completely remove the div from DOM
                        }

                        // Set the hidden input to indicate removal
                        const removeInput = document.getElementById('remove_existing_doc');
                        if(removeInput) {
                            removeInput.value = 1;
                        }

                        // Clear the file input so user can re-upload if needed
                        const fileInput = document.getElementById('document');
                        if(fileInput) {
                            fileInput.value = '';
                        }
                    });
                });
            });
        </script>






</body>

</html>