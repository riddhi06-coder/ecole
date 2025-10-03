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
                  <h4>Add Gallery Videos Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-gallery-videos.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Gallery Videos</li>
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
                        <h4>Gallery Videos Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-gallery-videos.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="title">Title <span class="txt-danger">*</span> </label>
                                            <input class="form-control" id="title" type="text" name="title" placeholder="Enter Title" required>
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>


                                         <!-- Video URL -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="video_iframe_url">Video Iframe URL <span class="txt-danger">*</span> </label>
                                            <input class="form-control" id="video_iframe_url" type="text" name="video_iframe_url" placeholder="Enter Video Iframe URL" required>
                                            <div class="invalid-feedback">Please enter a Video Iframe URL.</div>
                                        </div>

                                       
                                        <!-- Video URL -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="video_url">Video URL <span class="txt-danger">*</span> </label>
                                            <input class="form-control" id="video_url" type="text" name="video_url" placeholder="Enter Video URL" required>
                                            <div class="invalid-feedback">Please enter a Video URL.</div>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-gallery-videos.index') }}" class="btn btn-danger px-4">Cancel</a>
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

        </script>




</body>

</html>