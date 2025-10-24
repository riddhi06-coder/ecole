<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                  <h4>Add Bulletin Board Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-bulletin-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Bulletin Board Details</li>
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
                        <h4>Bulletin Board Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('manage-bulletin-details.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        
                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="category">Category <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">--- Select Category ---</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Category</div>
                                        </div>


                                        <!-- Article -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="article">Article <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="article" name="article" required>
                                                <option value="">--- Select Article ---</option>
                                            </select>
                                            <div class="invalid-feedback">Please select an Article</div>
                                        </div>


                                        <hr class="my-3">

                                        
                                        <!-- Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail_image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail_image" type="file" name="thumbnail_image" required onchange="previewThumbnail(event)" required>
                                            <div class="invalid-feedback">Please upload a image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                            </div>
                                        </div>
                                        
                                        <!--Location -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="location">Location </label>
                                            <input class="form-control" id="location" type="text" name="location" placeholder="Enter Location">
                                            <div class="invalid-feedback">Please enter a Location.</div>
                                        </div>


                                       <!-- Article Time (From - To) -->
                                        <div class="col-md-6">
                                            <label class="form-label">Time </label>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-fill">
                                                    <input class="form-control" id="article_time_from" type="text" name="article_time_from">
                                                    <small class="text-muted">From</small>
                                                    <div class="invalid-feedback">Please select start time.</div>
                                                </div>

                                                <div class="flex-fill">
                                                    <input class="form-control" id="article_time_to" type="text" name="article_time_to">
                                                    <small class="text-muted">To</small>
                                                    <div class="invalid-feedback">Please select end time.</div>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <!--Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="title">Title </label>
                                            <input class="form-control" id="title" type="text" name="title" placeholder="Enter Title">
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>


                                        <!-- Short Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="short_desc">Short Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="short_desc" rows="5" placeholder="Enter Short Description" required></textarea>
                                        </div>
                

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-bulletin-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = document.getElementById('category');
                const articleSelect = document.getElementById('article');

                categorySelect.addEventListener('change', function() {
                    const categoryId = this.value;
                    articleSelect.innerHTML = '<option value="">Loading...</option>';

                    if (!categoryId) {
                        articleSelect.innerHTML = '<option value="">--- Select Article ---</option>';
                        return;
                    }

                    fetch(`/ecole-mondiale/bulletin/articles/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            articleSelect.innerHTML = '<option value="">--- Select Article ---</option>';
                            if (data.length > 0) {
                                data.forEach(article => {
                                    const option = document.createElement('option');
                                    option.value = article.id;
                                    option.textContent = article.article_name;
                                    articleSelect.appendChild(option);
                                });
                            } else {
                                articleSelect.innerHTML = '<option value="">No articles found</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching articles:', error);
                            articleSelect.innerHTML = '<option value="">Error loading articles</option>';
                        });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#article_time_from", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "h:i K",  // 12-hour format with AM/PM
                    time_24hr: false
                });

                flatpickr("#article_time_to", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "h:i K",
                    time_24hr: false
                });
            });
        </script>



       
</body>

</html>