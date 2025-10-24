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
                  <h4>Edit Bulletin Board Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-bulletin-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Bulletin Board Details</li>
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
                                    <form class="row g-3 needs-validation custom-input" novalidate
                                        action="{{ route('manage-bulletin-details.update', $detail->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="category">Category <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">--- Select Category ---</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $detail->category_id == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Category</div>
                                        </div>

                                        <!-- Article -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="article">Article <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="article" name="article" required>
                                                <option value="">--- Select Article ---</option>
                                                @foreach($articles as $article)
                                                    <option value="{{ $article->id }}"
                                                        {{ $detail->article_id == $article->id ? 'selected' : '' }}>
                                                        {{ $article->article_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select an Article</div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail_image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="thumbnail_image" type="file" name="thumbnail_image"
                                                onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                @if($detail->thumbnail_image)
                                                    <img id="thumbnailPreview"
                                                        src="{{ asset('uploads/bulletin/' . $detail->thumbnail_image) }}"
                                                        alt="Preview"
                                                        class="img-fluid rounded border"
                                                        style="max-height:150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" class="d-none">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Location -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="location">Location </label>
                                            <input class="form-control" id="location" type="text" name="location"
                                                value="{{ $detail->location }}" placeholder="Enter Location">
                                            <div class="invalid-feedback">Please enter a Location.</div>
                                        </div>


                                        <!-- Article Time -->
                                        <div class="col-md-6">
                                            <label class="form-label">Time </label>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-fill">
                                                    <input class="form-control" id="article_time_from" type="text" name="article_time_from"
                                                        value="{{ $detail->article_time_from ? \Carbon\Carbon::parse($detail->article_time_from)->format('g:i A') : '' }}">
                                                    <small class="text-muted">From</small>
                                                    <div class="invalid-feedback">Please select start time.</div>
                                                </div>
                                                <div class="flex-fill">
                                                    <input class="form-control" id="article_time_to" type="text" name="article_time_to"
                                                        value="{{ $detail->article_time_to ? \Carbon\Carbon::parse($detail->article_time_to)->format('g:i A') : '' }}">
                                                    <small class="text-muted">To</small>
                                                    <div class="invalid-feedback">Please select end time.</div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="title">Title </label>
                                            <input class="form-control" id="title" type="text" name="title"
                                                value="{{ $detail->title }}" placeholder="Enter Title">
                                            <div class="invalid-feedback">Please enter a Title.</div>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="short_desc">Short Description <span class="txt-danger">*</span></label>
                                            <textarea class="form-control editor" id="editor" name="short_desc" rows="5" required>{{ $detail->desc }}</textarea>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-bulletin-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
            document.getElementById('category').addEventListener('change', function() {
                let categoryId = this.value;
                let articleSelect = document.getElementById('article');
                articleSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`/ecole-mondiale/bulletin/articles/${categoryId}`)
                    .then(res => res.json())
                    .then(data => {
                        articleSelect.innerHTML = '<option value="">--- Select Article ---</option>';
                        data.forEach(article => {
                            let selected = article.id == {{ $detail->article_id }} ? 'selected' : '';
                            articleSelect.innerHTML += `<option value="${article.id}" ${selected}>${article.article_name}</option>`;
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