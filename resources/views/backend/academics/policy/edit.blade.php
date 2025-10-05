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
                  <h4>Edit Policies Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-policies.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Policies</li>
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
                        <h4>Policies Form</h4>
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
                                        action="{{ route('manage-policies.update', $university->id) }}" 
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image"> Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)" required>
                                            <div class="invalid-feedback">Please upload a Banner image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small>

                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="{{ $university->banner_image ? asset('uploads/academics/' . $university->banner_image) : '#' }}" 
                                                    alt="Preview" class="img-fluid rounded border {{ $university->banner_image ? '' : 'd-none' }}" 
                                                    style="max-height: 150px;">
                                            </div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $university->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner heading.</div>
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
                                                    @php
                                                        $docs = json_decode($university->documents, true) ?? [];
                                                    @endphp
                                                    @forelse($docs as $index => $doc)
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="doc_names[]" class="form-control" value="{{ $doc['name'] }}" placeholder="Enter Document Name" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Upload File</label>
                                                                <input type="file" name="doc_files[]" class="form-control" onchange="previewDocFile(event, this)" accept=".pdf,.doc,.docx">
                                                                <input type="hidden" name="existing_doc_file[]" value="{{ $doc['file'] ?? '' }}">
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .pdf, .docx format can be uploaded.</b></small>
                                                                <div class="mt-2">
                                                                    @if($doc['file'])
                                                                        <a href="{{ asset('uploads/academics/' . $doc['file']) }}" target="_blank" class="text-primary small">
                                                                            View Document: {{ $doc['file'] }}
                                                                        </a>
                                                                    @else
                                                                        <span class="text-secondary small file-name d-none"></span>
                                                                    @endif
                                                                </div>

                                                            </td>
                                                            <td class="text-center align-middle">
                                                                @if($index == 0)
                                                                    <button type="button" class="btn btn-success" onclick="addDocRow()">Add More</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="doc_names[]" class="form-control" placeholder="Enter Document Name" required>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Upload File</label>
                                                                <input type="file" name="doc_files[]" class="form-control" onchange="previewDocFile(event, this)" accept=".pdf,.doc,.docx">
                                                                <div class="mt-2">
                                                                    <span class="text-secondary small file-name d-none"></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <button type="button" class="btn btn-success" onclick="addDocRow()">Add More</button>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-policies.index') }}" class="btn btn-danger px-4">Cancel</a>
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