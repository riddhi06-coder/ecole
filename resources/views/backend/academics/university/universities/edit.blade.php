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
                  <h4>Edit University & College List Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-universities.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit University & College List</li>
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
                        <h4>University & College List Form</h4>
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
                                        action="{{ route('manage-universities.update', $university->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Country Dropdown -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="country_id">Select Country <span class="txt-danger">*</span></label>
                                            <select class="form-control" name="country_id" id="country_id" required>
                                                <option value="">-- Select Country --</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" 
                                                        {{ $university->country_id == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a country.</div>
                                        </div>

                                        <!-- Universities Table -->
                                        <div class="col-md-12 mb-3 mt-5">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5 class="mb-0"><strong># University Details</strong></h5>
                                                <button type="button" class="btn btn-primary btn-sm" id="addUniversityRow">Add More</button>
                                            </div>

                                            <table class="table table-bordered" id="universitiesTable">
                                                <thead>
                                                    <tr>
                                                        <th>University Name</th>
                                                        <th>URL</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($universityNames as $index => $name)
                                                        <tr>
                                                            <td>
                                                                <label for="university_name_{{ $index }}">University Name</label>
                                                                <input type="text" 
                                                                    id="university_name_{{ $index }}" 
                                                                    name="universities[{{ $index }}][name]" 
                                                                    class="form-control" 
                                                                    placeholder="Enter University Name" 
                                                                    value="{{ $name }}" 
                                                                    required>
                                                            </td>
                                                            <td>
                                                                <label for="university_url_{{ $index }}">URL</label>
                                                                <input type="url" 
                                                                    id="university_url_{{ $index }}" 
                                                                    name="universities[{{ $index }}][url]" 
                                                                    class="form-control" 
                                                                    placeholder="Enter University URL" 
                                                                    value="{{ $universityUrls[$index] ?? '' }}">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-universities.index') }}" class="btn btn-danger px-4">Cancel</a>
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
       
       
       <!-- JS for dynamic rows -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let index = {{ count($universityNames) }};

                document.getElementById('addUniversityRow').addEventListener('click', function() {
                    const tableBody = document.querySelector('#universitiesTable tbody');
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>
                            <label for="university_name_${index}">University Name</label>
                            <input type="text" id="university_name_${index}" 
                                name="universities[${index}][name]" class="form-control" placeholder="Enter University Name" required>
                        </td>
                        <td>
                            <label for="university_url_${index}">URL</label>
                            <input type="url" id="university_url_${index}" 
                                name="universities[${index}][url]" class="form-control" placeholder="Enter University URL">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                    index++;
                });

                // Remove row
                document.querySelector('#universitiesTable').addEventListener('click', function(e) {
                    if(e.target.classList.contains('remove-row')) {
                        e.target.closest('tr').remove();
                    }
                });
            });
        </script>

</body>

</html>