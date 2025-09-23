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
                  <h4>Add Clients Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-clients.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Clients</li>
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
                        <h4>Clients Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-clients.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Features Table -->
                                        <div class="col-12">
                                            <table class="table table-bordered mt-5" id="featuresTable">
                                                <thead>
                                                    <tr>
                                                        <th>Upload Image <span class="txt-danger">*</span></th>
                                                        <th>Preview</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="feature-row">
                                                        <!-- Upload -->
                                                        <td>
                                                            <input type="file" name="features[0][image]" class="form-control feature-image" onchange="previewFeatureImage(event, this)">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                            <small class="text-secondary"><b>Note: Only .jpg, .jpeg, .png, .webp, .svg allowed.</b></small>
                                                        </td>
                                                        <!-- Preview -->
                                                        <td>
                                                            <img src="#" class="img-fluid mt-2 d-none feature-preview" style="max-height: 100px; border:1px solid #ccc;">
                                                        </td>
                                                        <!-- Action -->
                                                        <td>
                                                            <button type="button" class="btn btn-success add-feature">Add More</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-clients.index') }}" class="btn btn-danger px-4">Cancel</a>
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


        <!-- JS for dynamic features and preview -->
        <script>
            let featureIndex = 1;

            function previewFeatureImage(event, input) {
                const preview = input.closest('tr').querySelector('.feature-preview');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('d-none');
            }

            $(document).ready(function() {
                // Add new row
                $('#featuresTable').on('click', '.add-feature', function() {
                    const newRow = `
                        <tr class="feature-row">
                            <td>
                                <input type="file" name="features[${featureIndex}][image]" class="form-control feature-image" onchange="previewFeatureImage(event, this)">
                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                <small class="text-secondary"><b>Note: Only .jpg, .jpeg, .png, .webp, .svg allowed.</b></small>
                            </td>
                            <td>
                                <img src="#" class="img-fluid mt-2 d-none feature-preview" style="max-height: 100px; border:1px solid #ccc;">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-feature">Remove</button>
                            </td>
                        </tr>
                    `;
                    $('#featuresTable tbody').append(newRow);
                    featureIndex++;
                });

                // Remove row
                $('#featuresTable').on('click', '.remove-feature', function() {
                    $(this).closest('tr').remove();
                });
            });
        </script>

</body>

</html>