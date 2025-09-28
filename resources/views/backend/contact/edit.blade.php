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
                  <h4>Edit Contact Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-contact-us.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Contact Details</li>
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
                        <h4>Contact Details Form</h4>
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
                                        action="{{ route('manage-contact-us.update', $contact->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Heading -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" 
                                                value="{{ old('banner_heading', $contact->banner_heading) }}" 
                                                placeholder="Enter Banner Heading" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner">Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner" type="file" name="banner" onchange="previewbanner(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            
                                            <!-- Existing Preview -->
                                            <div class="mt-2">
                                                @if($contact->banner_image)
                                                    <img id="bannerPreview" src="{{ asset('uploads/contact/'.$contact->banner_image) }}" 
                                                        alt="Banner" class="img-fluid rounded border" style="max-height: 150px;">
                                                @else
                                                    <img id="bannerPreview" src="#" alt="Preview" class="img-fluid rounded border d-none" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="email">Email <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="email" type="text" name="email" 
                                                value="{{ old('email', $contact->email) }}" placeholder="Enter Email" required>
                                            <div class="invalid-feedback">Please enter an Email.</div>
                                        </div>

                                        <!-- Other Email -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="other_email">Other Email <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="other_email" type="text" name="other_email" 
                                                value="{{ old('other_email', $contact->other_email) }}" placeholder="Enter Other Email" required>
                                            <div class="invalid-feedback">Please enter an Other Email.</div>
                                        </div>

                                        <!-- Contact Number -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact_number">Contact Number <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="contact_number" type="text" name="contact_number" 
                                                value="{{ old('contact_number', $contact->contact_number) }}" 
                                                placeholder="Enter Contact Number" required maxlength="12">
                                            <div class="invalid-feedback">Please enter a valid Contact Number.</div>
                                        </div>

                                        <!-- Other Contact Number -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="other_contact_number">Other Contact Number <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="other_contact_number" type="text" name="other_contact_number" 
                                                value="{{ old('other_contact_number', $contact->other_contact_number) }}" 
                                                placeholder="Enter Contact Number" required maxlength="12">
                                            <div class="invalid-feedback">Please enter a valid Contact Number.</div>
                                        </div>

                                        <!-- Gmap URL -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="url">Gmap URL <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="url" type="text" name="url" 
                                                value="{{ old('url', $contact->map_url) }}" placeholder="Enter Gmap URL" required>
                                            <div class="invalid-feedback">Please enter a Gmap URL.</div>
                                        </div>

                                        <!-- IFrame URL -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="i_frame">IFrame URL <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="i_frame" type="text" name="i_frame" 
                                                value="{{ old('i_frame', $contact->i_frame) }}" placeholder="Enter IFrame URL" required>
                                            <div class="invalid-feedback">Please enter an IFrame URL.</div>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="col-md-12 mb-5">
                                            <label class="form-label" for="desc">Short Description<span class="txt-danger">*</span></label>
                                            <textarea class="form-control" id="desc" name="desc" placeholder="Enter Short Description" required>{{ old('desc', $contact->desc) }}</textarea>
                                            <div class="invalid-feedback">Please enter a Short Description.</div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-md-12 mb-5">
                                            <label class="form-label" for="address">Address <span class="txt-danger">*</span></label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address" required>{{ old('address', $contact->address) }}</textarea>
                                            <div class="invalid-feedback">Please enter an Address.</div>
                                        </div>

                                        <!-- Announcements -->
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label"><strong>Announcements</strong></label>
                                                <button type="button" id="add-announcement-row" class="btn btn-success">Add Announcement</button>
                                            </div>
                                            <table class="table table-bordered p-3" id="announcementTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Announcement <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="announcement-table-body">
                                                    @forelse($announcements as $index => $announcement)
                                                        <tr>
                                                            <td><input type="text" name="announcements[{{ $index }}][title]" class="form-control" value="{{ $announcement['title'] }}" required></td>
                                                            <td><button type="button" class="btn btn-danger remove-announcement-row">Remove</button></td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td><input type="text" name="announcements[0][title]" class="form-control" placeholder="Enter Announcement" required></td>
                                                            <td><button type="button" class="btn btn-danger remove-announcement-row">Remove</button></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Social Media Links -->
                                        <div class="col-12 mt-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label"><strong>Social Media Links</strong></label>
                                                <button type="button" id="add-social-media-row" class="btn btn-success">Add Link</button>
                                            </div>
                                            <table class="table table-bordered p-3" id="dynamicTable" style="border: 2px solid #dee2e6;">
                                                <thead>
                                                    <tr>
                                                        <th>Social Media Platform <span class="txt-danger">*</span></th>
                                                        <th>Link <span class="txt-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="social-media-table-body">
                                                    @forelse($contact_details as $index => $social)
                                                        <tr>
                                                            <td>
                                                                <select name="social_media[{{ $index }}][platform]" class="form-control" required>
                                                                    <option value="">Select Platform</option>
                                                                    <option value="1" {{ $social['platform'] == 1 ? 'selected' : '' }}>Facebook</option>
                                                                    <option value="2" {{ $social['platform'] == 2 ? 'selected' : '' }}>Twitter</option>
                                                                    <option value="3" {{ $social['platform'] == 3 ? 'selected' : '' }}>Instagram</option>
                                                                    <option value="4" {{ $social['platform'] == 4 ? 'selected' : '' }}>LinkedIn</option>
                                                                    <option value="5" {{ $social['platform'] == 5 ? 'selected' : '' }}>YouTube</option>
                                                                    <option value="6" {{ $social['platform'] == 6 ? 'selected' : '' }}>Pinterest</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="url" name="social_media[{{ $index }}][link]" class="form-control" value="{{ $social['link'] }}" required></td>
                                                            <td><button type="button" class="btn btn-danger remove-social-media-row">Remove</button></td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                <select name="social_media[0][platform]" class="form-control" required>
                                                                    <option value="">Select Platform</option>
                                                                    <option value="1">Facebook</option>
                                                                    <option value="2">Twitter</option>
                                                                    <option value="3">Instagram</option>
                                                                    <option value="4">LinkedIn</option>
                                                                    <option value="5">YouTube</option>
                                                                    <option value="6">Pinterest</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="url" name="social_media[0][link]" class="form-control" placeholder="Enter Social Media URL" required></td>
                                                            <td><button type="button" class="btn btn-danger remove-social-media-row">Remove</button></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-contact-us.index') }}" class="btn btn-danger px-4">Cancel</a>
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


    <!-- JavaScript to dynamically add/remove rows -->
<script>
    document.getElementById('add-social-media-row').addEventListener('click', function () {
        var tableBody = document.getElementById('social-media-table-body');
        var rowCount = tableBody.rows.length;
        var row = tableBody.insertRow();

        // Platform Dropdown
        var cell1 = row.insertCell(0);
        var platformSelect = document.createElement('select');
        platformSelect.name = `social_media[${rowCount}][platform]`;
        platformSelect.classList.add('form-control');
        platformSelect.required = true;

        // Add options to the dropdown with numerical values
        var platforms = [
            { id: 1, name: 'Facebook' },
            { id: 2, name: 'Twitter' },
            { id: 3, name: 'Instagram' },
            { id: 4, name: 'Linkedin' },
            { id: 5, name: 'Youtube' },
            { id: 6, name: 'Pintrest' }
        ];
        platformSelect.innerHTML = '<option value="">Select Platform</option>';
        platforms.forEach(function (platform) {
            var option = document.createElement('option');
            option.value = platform.id; // Numerical value
            option.textContent = platform.name.charAt(0).toUpperCase() + platform.name.slice(1); // Capitalized name
            platformSelect.appendChild(option);
        });

        cell1.appendChild(platformSelect);

        // URL Input
        var cell2 = row.insertCell(1);
        var urlInput = document.createElement('input');
        urlInput.type = 'url';
        urlInput.name = `social_media[${rowCount}][link]`;
        urlInput.classList.add('form-control');
        urlInput.placeholder = 'Enter Social Media URL';
        urlInput.required = true;
        cell2.appendChild(urlInput);

        // Remove Button
        var cell3 = row.insertCell(2);
        var removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-danger', 'remove-social-media-row');
        removeBtn.textContent = 'Remove';
        removeBtn.addEventListener('click', function () {
            tableBody.deleteRow(row.rowIndex);
        });
        cell3.appendChild(removeBtn);
    });


    // Event delegation to remove rows
    document.getElementById('social-media-table-body').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-social-media-row')) {
            var row = e.target.closest('tr');
            row.remove();
        }
    });
</script>

<script>
    function previewbanner(event) {
        const input = event.target;
        const preview = document.getElementById('bannerPreview');

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
    document.addEventListener("DOMContentLoaded", function () {
        // Get the last index from existing rows
        let lastIndex = document.querySelectorAll("#announcement-table-body tr").length;
        let announcementIndex = lastIndex > 0 ? lastIndex : 1;

        // Add row
        document.getElementById("add-announcement-row").addEventListener("click", function () {
            let tableBody = document.getElementById("announcement-table-body");
            let newRow = `
                <tr>
                    <td><input type="text" name="announcements[${announcementIndex}][title]" class="form-control" placeholder="Enter Announcement" required></td>
                    <td><button type="button" class="btn btn-danger remove-announcement-row">Remove</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML("beforeend", newRow);
            announcementIndex++;
        });

        // Remove row
        document.addEventListener("click", function (e) {
            if (e.target && e.target.classList.contains("remove-announcement-row")) {
                e.target.closest("tr").remove();
            }
        });
    });
</script>


</body>

</html>