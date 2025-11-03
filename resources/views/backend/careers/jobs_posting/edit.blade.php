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
                  <h4>Edit Teaching Job Opportunities Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-job-postings.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Teaching Job Opportunities</li>
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
                        <h4>Teaching Job Opportunities Form</h4>
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
                                        action="{{ route('manage-job-postings.update', $opportunities->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT') {{-- ✅ Use PUT for updates --}}

                                        <!-- Job Category -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="job_category">Job Category <span class="txt-danger">*</span></label>
                                            <select class="form-select" id="job_category" name="job_category" required>
                                                <option value="">Select a category</option>
                                                @foreach($jobCategories as $category)
                                                    <option value="{{ $category['id'] }}"
                                                        {{ $opportunities->job_category_id == $category['id'] ? 'selected' : '' }}>
                                                        {{ $category['title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Job Category.</div>
                                        </div>

                                        <!-- Job Role -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="job_role">Job Role <span class="txt-danger">*</span></label>
                                            <input class="form-control"
                                                id="job_role"
                                                type="text"
                                                name="job_role"
                                                placeholder="Enter Job Role"
                                                value="{{ old('job_role', $opportunities->job_roles) }}"
                                                required>
                                            <div class="invalid-feedback">Please enter a Job Role.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-job-postings.index') }}" class="btn btn-danger px-4">Cancel</a>
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

       
</body>

</html>