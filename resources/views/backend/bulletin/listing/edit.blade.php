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
                  <h4>Edit Bulletin Board Listing Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-bulletin-listing.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Bulletin Board Listing</li>
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
                        <h4>Bulletin Board Listing Form</h4>
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
                                        action="{{ route('manage-bulletin-listing.update', $category->id) }}" 
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
                                                        {{ old('category', $category->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Category</div>
                                        </div>

                                        <!-- Thumbnail Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="thumbnail_image">Thumbnail Image</label>
                                            <input class="form-control" id="thumbnail_image" type="file" name="thumbnail_image" onchange="previewThumbnail(event)">
                                            <div class="invalid-feedback">Please upload a Thumbnail image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                @if($category->thumbnail_image)
                                                    <img id="thumbnailPreview" 
                                                        src="{{ asset('uploads/bulletin/' . $category->thumbnail_image) }}" 
                                                        alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                    <img id="thumbnailPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Article Name -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="article_name">Article Name <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="article_name" type="text" name="article_name" 
                                                placeholder="Enter Article Name" 
                                                value="{{ old('article_name', $category->article_name) }}" required>
                                            <div class="invalid-feedback">Please enter an Article Name.</div>
                                        </div>

                                        <!-- Article Date -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="article_date">Article Date <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="article_date" type="date" name="article_date" 
                                                value="{{ old('article_date', $category->article_date) }}" required>
                                            <div class="invalid-feedback">Please enter the Article Date.</div>
                                        </div>

                                        <!-- Article Author -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="article_author">Article Author </label>
                                            <input class="form-control" id="article_author" type="text" name="article_author" 
                                                placeholder="Enter Article Author" 
                                                value="{{ old('article_author', $category->article_author) }}" >
                                            <div class="invalid-feedback">Please enter an Article Author.</div>
                                        </div>

                                        <!-- Special Tags -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="special_tags">Special Tags</label>
                                            <input class="form-control" id="special_tags" type="text" name="special_tags" 
                                                placeholder="Enter Special Tags" 
                                                value="{{ old('special_tags', $category->special_tags) }}">
                                        </div>

                                        <!-- Short Description -->
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="short_desc">Short Description </label>
                                            <textarea class="form-control" id="short_desc" name="short_desc" rows="5">{{ old('short_desc', $category->short_desc) }}</textarea>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-bulletin-listing.index') }}" class="btn btn-danger px-4">Cancel</a>
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

       
</body>

</html>