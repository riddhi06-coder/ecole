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
                  <h4>Add Brochure Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-brochure-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Brochure Details</li>
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
                        <h4>Brochure Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-brochure-details.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- PDF Brochure Upload -->
                                        <div class="col-md-6 mt-4">
                                            <label class="form-label" for="brochure">Upload PDF Brochure <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="brochure" type="file" name="brochure" accept=".pdf" onchange="previewPDF(event)" required>
                                            <small class="text-secondary"><b>Note: Only PDF files up to 3MB allowed.</b></small>
                                            <div class="invalid-feedback">Please upload a PDF brochure.</div>

                                            <!-- PDF Preview -->
                                            <div class="mt-2" id="pdfPreview" style="display:none;">
                                                <p><b>Preview:</b> <a href="#" id="pdfLink" target="_blank"></a></p>
                                            </div>
                                        </div>

                                        <!-- Brochure Fees Table -->
                                        <!-- Brochure Fees Table -->
                                        <div class="col-md-12 mt-4">
                                            <label class="form-label">Brochure Fees <span class="txt-danger">*</span></label>
                                            <table class="table table-bordered" id="brochureFeesTable">
                                                <thead>
                                                    <tr>
                                                        <th>Passport Type</th>
                                                        <th>Amount (₹)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="passport_type[]" class="form-select" required>
                                                                <option value="">Select</option>
                                                                <option value="1">Indian Passport</option>
                                                                <option value="2">Foreign Passport</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="amount[]" class="form-control" placeholder="Enter Amount" required>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-success btn-sm addRow">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-brochure-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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


       <!-- JS Section -->
        <script>
            // === Preview PDF ===
            function previewPDF(event) {
                const file = event.target.files[0];
                const pdfPreview = document.getElementById('pdfPreview');
                const pdfLink = document.getElementById('pdfLink');

                if (file && file.type === "application/pdf") {
                    if (file.size > 3 * 1024 * 1024) {
                        alert("File size must be less than 3MB.");
                        event.target.value = '';
                        pdfPreview.style.display = "none";
                        return;
                    }
                    pdfLink.textContent = file.name;
                    pdfLink.href = URL.createObjectURL(file);
                    pdfPreview.style.display = "block";
                } else {
                    alert("Please upload a valid PDF file.");
                    event.target.value = '';
                    pdfPreview.style.display = "none";
                }
            }

            document.addEventListener('click', function (e) {
                // Add new row
                if (e.target.closest('.addRow')) {
                    const table = document.querySelector('#brochureFeesTable tbody');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>
                            <select name="passport_type[]" class="form-select" required>
                                <option value="">Select</option>
                                <option value="1">Indian Passport</option>
                                <option value="2">Foreign Passport</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="form-control" placeholder="Enter Amount" required>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm removeRow">Remove</button>
                        </td>
                    `;
                    table.appendChild(newRow);
                }

                // Remove row
                if (e.target.closest('.removeRow')) {
                    e.target.closest('tr').remove();
                }
            });


        </script>


</body>

</html>