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
                                            <label class="form-label" for="other_contact_number">Other Contact Number </label>
                                            <input class="form-control" id="other_contact_number" type="text" name="other_contact_number" 
                                                value="{{ old('other_contact_number', $contact->other_contact_number) }}" 
                                                placeholder="Enter Contact Number" maxlength="12">
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
                                            <label class="form-label" for="desc">Short Description <span class="txt-danger">*</span></label>
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
                                                        <th style="width: 50%;">Announcement <span class="txt-danger">*</span></th>
                                                        <th>
                                                            Attachment (Document / Image)
                                                            <br><small class="text-secondary">Optional. pdf, doc, docx, jpg, jpeg, png, webp — max 2MB. Shows a "Click here" link on the website.</small>
                                                        </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="announcement-table-body">
                                                    @forelse($announcements as $index => $announcement)
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="announcements[{{ $index }}][title]" class="form-control"
                                                                       value="{{ $announcement['title'] ?? '' }}" placeholder="Enter Announcement" required>
                                                            </td>
                                                            <td>
                                                                <input type="file" name="announcements[{{ $index }}][file]" class="form-control announcement-file"
                                                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp">

                                                                <!-- Preview (existing file, replaced live when a new file is chosen) -->
                                                                <div class="announcement-preview mt-2">
                                                                    @if(!empty($announcement['file']))
                                                                        @php
                                                                            $fileUrl = asset('uploads/announcements/'.$announcement['file']);
                                                                            $ext = strtolower(pathinfo($announcement['file'], PATHINFO_EXTENSION));
                                                                        @endphp
                                                                        <small class="text-secondary d-block mb-1">Current file:</small>
                                                                        @if(in_array($ext, ['jpg','jpeg','png','webp']))
                                                                            <a href="{{ $fileUrl }}" target="_blank" rel="noopener">
                                                                                <img src="{{ $fileUrl }}" alt="Attachment" class="img-thumbnail" style="max-height: 90px;">
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ $fileUrl }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                                                                                View {{ strtoupper($ext) }} file
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </div>

                                                                @if(!empty($announcement['file']))
                                                                    <input type="hidden" name="announcements[{{ $index }}][existing_file]" value="{{ $announcement['file'] }}">
                                                                    <div class="mt-2 small">
                                                                        <label class="mb-0">
                                                                            <input type="checkbox" name="announcements[{{ $index }}][remove_file]" value="1"> Remove file
                                                                        </label>
                                                                        <br><span class="text-secondary">Uploading a new file will replace the current one.</span>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td><button type="button" class="btn btn-danger remove-announcement-row">Remove</button></td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="announcements[0][title]" class="form-control" placeholder="Enter Announcement" required>
                                                            </td>
                                                            <td>
                                                                <input type="file" name="announcements[0][file]" class="form-control announcement-file"
                                                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp">
                                                                <div class="announcement-preview mt-2"></div>
                                                            </td>
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

<!-- Social media rows -->
<script>
    // Start after the highest existing index so new rows never overwrite old ones
    let socialIndex = {{ count($contact_details) ? max(array_map('intval', array_keys($contact_details))) + 1 : 1 }};

    document.getElementById('add-social-media-row').addEventListener('click', function () {
        const tableBody = document.getElementById('social-media-table-body');
        const platforms = [
            { id: 1, name: 'Facebook' },
            { id: 2, name: 'Twitter' },
            { id: 3, name: 'Instagram' },
            { id: 4, name: 'LinkedIn' },
            { id: 5, name: 'YouTube' },
            { id: 6, name: 'Pinterest' }
        ];
        const options = platforms.map(p => `<option value="${p.id}">${p.name}</option>`).join('');

        tableBody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>
                    <select name="social_media[${socialIndex}][platform]" class="form-control" required>
                        <option value="">Select Platform</option>${options}
                    </select>
                </td>
                <td><input type="url" name="social_media[${socialIndex}][link]" class="form-control" placeholder="Enter Social Media URL" required></td>
                <td><button type="button" class="btn btn-danger remove-social-media-row">Remove</button></td>
            </tr>
        `);
        socialIndex++;
    });

    document.getElementById('social-media-table-body').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-social-media-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>

<!-- Banner preview -->
<script>
    function previewbanner(event) {
        const input = event.target;
        const preview = document.getElementById('bannerPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<!-- Announcement rows -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Start after the highest existing index so new rows never overwrite old ones
        let announcementIndex = {{ count($announcements) ? max(array_map('intval', array_keys($announcements))) + 1 : 1 }};
        const allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'webp'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        // Add row
        document.getElementById("add-announcement-row").addEventListener("click", function () {
            const tableBody = document.getElementById("announcement-table-body");
            tableBody.insertAdjacentHTML("beforeend", `
                <tr>
                    <td>
                        <input type="text" name="announcements[${announcementIndex}][title]" class="form-control" placeholder="Enter Announcement" required>
                    </td>
                    <td>
                        <input type="file" name="announcements[${announcementIndex}][file]" class="form-control announcement-file"
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp">
                        <div class="announcement-preview mt-2"></div>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-announcement-row">Remove</button></td>
                </tr>
            `);
            announcementIndex++;
        });

        // Remove row
        document.getElementById("announcement-table-body").addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-announcement-row")) {
                e.target.closest("tr").remove();
            }
        });

        // Remember the original (existing file) preview of each row so it can be restored
        document.querySelectorAll("#announcement-table-body .announcement-preview").forEach(function (box) {
            box.dataset.original = box.innerHTML;
        });

        function escapeHtml(str) {
            return str.replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        }

        function renderPreview(input, file) {
            const box = input.closest("td").querySelector(".announcement-preview");
            if (!box) return;

            // Free the previous temporary URL
            if (box.dataset.blobUrl) {
                URL.revokeObjectURL(box.dataset.blobUrl);
                delete box.dataset.blobUrl;
            }

            // No file chosen → go back to the existing file preview (if any)
            if (!file) {
                box.innerHTML = box.dataset.original || "";
                return;
            }

            const ext = file.name.split('.').pop().toLowerCase();
            const url = URL.createObjectURL(file);
            box.dataset.blobUrl = url;
            const name = escapeHtml(file.name);

            let html = '<small class="text-secondary d-block mb-1">New file (preview):</small>';
            if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) {
                html += `<a href="${url}" target="_blank" rel="noopener">
                            <img src="${url}" alt="Preview" class="img-thumbnail" style="max-height: 90px;">
                         </a>`;
            } else if (ext === 'pdf') {
                html += `<a href="${url}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Preview PDF</a>
                         <small class="d-block text-muted mt-1">${name}</small>`;
            } else {
                // Browsers can't preview Word files — just show the name
                html += `<span class="badge bg-secondary">${ext.toUpperCase()}</span>
                         <small class="text-muted ms-1">${name}</small>`;
            }
            html += `<button type="button" class="btn btn-sm btn-link text-danger clear-announcement-file p-0 d-block mt-1">Clear selected file</button>`;
            box.innerHTML = html;
        }

        // Validate + preview on file select
        document.getElementById("announcement-table-body").addEventListener("change", function (e) {
            if (!e.target.classList.contains("announcement-file")) return;
            const file = e.target.files[0];

            if (file) {
                const ext = file.name.split('.').pop().toLowerCase();
                if (!allowed.includes(ext)) {
                    alert("Only pdf, doc, docx, jpg, jpeg, png, webp files are allowed.");
                    e.target.value = "";
                    renderPreview(e.target, null);
                    return;
                }
                if (file.size > maxSize) {
                    alert("File size should be less than 2MB.");
                    e.target.value = "";
                    renderPreview(e.target, null);
                    return;
                }
            }
            renderPreview(e.target, file || null);
        });

        // Clear selected (new) file
        document.getElementById("announcement-table-body").addEventListener("click", function (e) {
            if (!e.target.classList.contains("clear-announcement-file")) return;
            const input = e.target.closest("td").querySelector(".announcement-file");
            input.value = "";
            renderPreview(input, null);
        });
    });
</script>

</body>

</html>