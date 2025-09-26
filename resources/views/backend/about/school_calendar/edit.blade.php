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
                  <h4>Add School Calendar Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-school-calendar.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add School Calendar</li>
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
                        <h4>School Calendar Form</h4>
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
                                        action="{{ route('manage-school-calendar.update', $set_apart->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail" type="file" name="thumbnail" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Existing Image Preview -->
                                            <div class="mt-2">
                                                @if($set_apart->banner_image)
                                                    <img id="thumbnailPreview" src="{{ asset('uploads/about/' . $set_apart->banner_image) }}" 
                                                        alt="Banner Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $set_apart->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Section Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="section_image">Section Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_image" type="file" name="section_image" onchange="previewSectionImage(event)">
                                            <div class="invalid-feedback">Please upload a Section image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Existing Section Image Preview -->
                                            <div class="mt-2">
                                                @if($set_apart->section_image)
                                                    <img id="sectionImagePreview" src="{{ asset('uploads/about/' . $set_apart->section_image) }}" 
                                                        alt="Section Preview" 
                                                        class="img-fluid rounded border" 
                                                        style="max-height: 150px;">
                                                @else
                                                    <img id="sectionImagePreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="section_heading">Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="section_heading" type="text" name="section_heading" 
                                                value="{{ old('section_heading', $set_apart->section_heading) }}" 
                                                placeholder="Enter Heading" required>
                                            <div class="invalid-feedback">Please enter heading.</div>
                                        </div>

                                        <!-- Section Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="section_description">Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="section_description" rows="5" 
                                                    placeholder="Enter Description" required>{{ old('section_description', $set_apart->section_description) }}</textarea>
                                        </div>


                                        <hr class="my-3">

                                        <!-- Year + Document Table -->
                                        <div class="col-md-12 mb-3">
                                            <h5><strong># Yearly Documents</strong></h5>
                                            <table class="table table-bordered mt-5" id="yearDocumentTable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 25%;">Year <span class="txt-danger">*</span></th>
                                                        <th style="width: 55%;">Document Upload <span class="txt-danger">*</span></th>
                                                        <th style="width: 20%;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($yearlyDocuments))
                                                        @foreach($yearlyDocuments as $index => $doc)
                                                        <tr>
                                                            <!-- Year Input -->
                                                            <td>
                                                                <input type="text" name="years[]" class="form-control" value="{{ $doc['year'] }}" required>
                                                            </td>

                                                            <!-- File Upload + Preview -->
                                                            <td>
                                                                <input type="file" name="documents[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" onchange="previewDocument(this)">
                                                                
                                                                <!-- Existing document preview -->
                                                                @if(!empty($doc['document']))
                                                                <div class="mt-2">
                                                                    @php
                                                                        $ext = pathinfo($doc['document'], PATHINFO_EXTENSION);
                                                                        $url = asset('uploads/about/' . $doc['document']);
                                                                    @endphp
                                                                    @if(in_array($ext, ['pdf','doc','docx']))
                                                                        <a href="{{ $url }}" target="_blank">View Document</a>
                                                                    @else
                                                                        <img src="{{ $url }}" class="img-fluid rounded border" style="max-height:150px;">
                                                                    @endif
                                                                </div>
                                                                @endif

                                                                <small class="text-secondary">
                                                                    <b>Note: The file size should be less than 2MB.</b>
                                                                </small><br>
                                                                <small class="text-secondary">
                                                                    <b>Note: Only files in .pdf, .doc, .docx format can be uploaded.</b>
                                                                </small>
                                                            </td>

                                                            <!-- Action -->
                                                            <td class="text-center">
                                                                @if($index == 0)
                                                                    <button type="button" class="btn btn-success addRow">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger removeRow">Remove</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <!-- Default empty row if no documents -->
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="years[]" class="form-control" placeholder="Enter Year" required>
                                                            </td>
                                                            <td>
                                                                <input type="file" name="documents[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" onchange="previewDocument(this)">
                                                                <small class="text-secondary">
                                                                    <b>Note: The file size should be less than 2MB.</b>
                                                                </small><br>
                                                                <small class="text-secondary">
                                                                    <b>Note: Only files in .pdf, .doc, .docx format can be uploaded.</b>
                                                                </small>
                                                                <div class="mt-2">
                                                                    <iframe src="#" class="doc-preview d-none" style="width: 100%; height: 150px; border: 1px solid #ddd;"></iframe>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-success addRow">Add More</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>


                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-school-calendar.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                let preview = document.getElementById('sectionImagePreview');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('d-none');
            }
        </script>

        <!-- Scripts -->
        <script>
            // Preview uploaded document
            function previewDocument(input) {
                let preview = input.closest('td').querySelector('.doc-preview');
                if (input.files && input.files[0]) {
                    let fileURL = URL.createObjectURL(input.files[0]);
                    preview.src = fileURL;
                    preview.classList.remove('d-none');
                }
            }

            // Add more rows dynamically
            document.addEventListener("click", function(e) {
                if (e.target && e.target.classList.contains("addRow")) {
                    let tableBody = document.querySelector("#yearDocumentTable tbody");
                    let newRow = `
                        <tr>
                            <td>
                                <input type="text" name="years[]" class="form-control" placeholder="Enter Year" required>
                            </td>
                            <td>
                                <input type="file" name="documents[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp" required onchange="previewDocument(this)">
                                                            
                                <small class="text-secondary">
                                    <b>Note: The file size should be less than 2MB.</b>
                                </small><br>
                                <small class="text-secondary">
                                    <b>Note: Only files in .pdf, .doc, .docx format can be uploaded.</b>
                                </small>
                                <div class="mt-2">
                                    <iframe src="#" class="doc-preview d-none" style="width: 100%; height: 150px; border: 1px solid #ddd;"></iframe>
                                </div>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML("beforeend", newRow);
                }

                // Remove row
                if (e.target && e.target.classList.contains("removeRow")) {
                    e.target.closest("tr").remove();
                }
            });
        </script>

</body>

</html>