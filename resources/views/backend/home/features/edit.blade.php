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
                  <h4>Edit Features Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-home-features.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Features</li>
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
                        <h4>Features Form</h4>
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
                                        action="{{ route('manage-home-features.update', $features->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Background Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="image"> Background Image </label>
                                            <input class="form-control" id="image" type="file" name="image" onchange="previewThumbnail(event)">
                                            <small class="text-secondary"><b>Max size: 2MB. Allowed: jpg,jpeg,png,webp,svg</b></small>
                                            <div class="mt-2">
                                                <img id="thumbnailPreview"
                                                    src="{{ asset('uploads/home/features/' . ($features->image ?? '')) }}"
                                                    class="img-fluid rounded border" style="max-height:150px; background:black;">
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="description"> Description </label>
                                            <textarea name="description" id="description" class="form-control" rows="4"
                                                    required>{{ old('description', $features->description) }}</textarea>
                                        </div>

                                        <hr>

                                        <!-- Features Section -->
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="mb-0"># Features Section</h4>
                                                <button type="button" class="btn btn-success add-feature">Add More</button>
                                            </div>

                                            <table class="table table-bordered" id="featuresTable">
                                                <thead>
                                                <tr>
                                                    <th>Feature Image</th>
                                                    <th>Feature Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $featuresData = json_decode($features->features ?? '[]', true);
                                                    $count = 0;
                                                @endphp

                                                @if(!empty($featuresData))
                                                    @foreach($featuresData as $feature)
                                                        <tr class="feature-row">
                                                            <td>
                                                                <input type="file" name="features[{{ $count }}][image]"
                                                                    class="form-control feature-image" onchange="previewFeatureImage(event, this)">

                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small><br>
                                                                <img src="{{ asset('uploads/home/features/' . ($feature['image'] ?? '')) }}"
                                                                    class="img-fluid mt-2 feature-preview" style="max-height:100px; border:1px solid #ccc;">
                                                                <input type="hidden" name="features[{{ $count }}][existing_image]"
                                                                    value="{{ $feature['image'] }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="features[{{ $count }}][name]" class="form-control"
                                                                    value="{{ old('features.' . $count . '.name', $feature['name'] ?? '') }}"
                                                                    placeholder="Enter Feature Name">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-feature">Remove</button>
                                                            </td>
                                                        </tr>
                                                        @php $count++; @endphp
                                                    @endforeach
                                                @else
                                                    <tr class="feature-row">
                                                        <td>
                                                            <input type="file" name="features[0][image]" class="form-control feature-image"
                                                                onchange="previewFeatureImage(event, this)">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small><br>
                                                            <img src="#" class="img-fluid mt-2 d-none feature-preview" style="max-height:100px; border:1px solid #ccc;">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="features[0][name]" class="form-control" placeholder="Enter Feature Name">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success add-feature">Add More</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-home-features.index') }}" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Update</button>
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


        <!-- JS for dynamic features and preview -->
        <script>
            $(document).ready(function () {
                // Start index after last row
                let featureIndex = Math.max(...$('#featuresTable tbody tr').map(function () {
                    return parseInt($(this).find('input[type="text"]').attr('name').match(/\d+/)[0]);
                }).get()) + 1 || 0;

                // Make preview global
                window.previewFeatureImage = function (event, input) {
                    const preview = input.closest('td').querySelector('.feature-preview');
                    preview.src = URL.createObjectURL(event.target.files[0]);
                    preview.classList.remove('d-none');
                }

                // Add row
                $('.add-feature').click(function () {
                    const newRow = `<tr class="feature-row">
                        <td>
                            <input type="file" name="features[${featureIndex}][image]" class="form-control feature-image" onchange="previewFeatureImage(event, this)">
                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                            <br>
                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp, .svg format can be uploaded.</b></small><br>
                            <br>
                            <img src="#" class="img-fluid mt-2 d-none feature-preview" style="max-height:100px; border:1px solid #ccc;">
                        </td>
                        <td>
                            <input type="text" name="features[${featureIndex}][name]" class="form-control" placeholder="Enter Feature Name">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-feature">Remove</button>
                        </td>
                    </tr>`;
                    $('#featuresTable tbody').append(newRow);
                    featureIndex++;
                });

                // Remove row
                $('#featuresTable').on('click', '.remove-feature', function () {
                    $(this).closest('tr').remove();
                });
            });
        </script>

</body>

</html>