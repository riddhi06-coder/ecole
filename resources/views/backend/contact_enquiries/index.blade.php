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
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manage-contact-enquiries.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Enquiries Details</li>
                            </ol>
                        </nav>

                        <div class="col-md-6">
                            <select id="formTypeFilter" name="form_type" class="form-select">
                                <option value="">-- Filter by Form Type --</option>
                                <option value="1">Contact Form</option>
                                <option value="2">Admission Enquiry Form</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <input type="text" id="tableSearch" class="form-control w-25" placeholder="Search...">
                    </div>


                    <div class="table-responsive custom-scrollbar mt-5" style="max-height: 450px; overflow-y: auto;">

                        <table class="table table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Enquiry Type</th>
                                    <th>Enquiry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="admissionTableBody">

                                @forelse($enquiries as $formType => $items)
                                
                                    {{-- GROUP HEADER --}}
                                    <tr class="table-secondary text-center">
                                        <td colspan="7" class="fw-bold">
                                            {{ $formType == 1 ? 'Contact Enquiries' : 'Home Admission Enquiries' }}
                                        </td>
                                    </tr>
                                
                                    @foreach($items as $index => $enquiry)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $enquiry->name ?? '-' }}</td>
                                            <td>{{ $enquiry->email ?? '-' }}</td>
                                            <td>{{ $enquiry->phone ?? '-' }}</td>
                                            <td>{{ ucfirst($enquiry->enquiry_type ?? '-') }}</td>
                                            <td>
                                                {{ $enquiry->inserted_at 
                                                    ? \Carbon\Carbon::parse($enquiry->inserted_at)->format('d M Y, h:i A') 
                                                    : '-' 
                                                }}
                                            </td>

                                            <td><a href="{{ route('manage-contact-enquiries.show', $enquiry->id) }}" class="btn btn-primary btn-sm">View</a><br><br>
                                            
                                                <!--<a href="{{ route('contact-application.pdf', $enquiry->id) }}"-->
                                                <!--   class="btn btn-danger btn-sm"-->
                                                <!--   target="_blank">-->
                                                <!--    PDF-->
                                                <!--</a>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            No Contact Enquiries Found
                                        </td>
                                    </tr>
                                @endforelse
                                
                                </tbody>

                        </table>
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


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            $('#formTypeFilter').on('change', function() {
                let formType = $(this).val();

                $.ajax({
                    url: "{{ route('manage-contact-enquiries.index') }}",
                    method: "GET",
                    data: { form_type: formType },
                    beforeSend: function() {
                        $('#admissionTableBody').html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
                    },
                    success: function(response) {
                        $('#admissionTableBody').html(response.html);
                    },
                    error: function() {
                        $('#admissionTableBody').html('<tr><td colspan="8" class="text-center text-danger">Error loading data</td></tr>');
                    }
                });
            });
        </script>

        <script>
            document.getElementById('tableSearch').addEventListener('keyup', function () {
        
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#admissionTableBody tr');
            let visibleCount = 0;
        
            // Remove old no-data message
            document.querySelectorAll('.no-data-message').forEach(e => e.remove());
        
            rows.forEach(function (row) {
        
                // Always show group headers initially
                if (row.classList.contains('table-secondary')) {
                    row.style.display = '';
                    return;
                }
        
                const text = row.textContent.toLowerCase();
        
                if (text.includes(searchValue)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        
            // If NO data rows are visible → show message
            if (visibleCount === 0) {
                document.getElementById('admissionTableBody').insertAdjacentHTML(
                    'beforeend',
                    `<tr class="no-data-message">
                        <td colspan="7" class="text-center text-muted">
                            No data available
                        </td>
                    </tr>`
                );
            }
        
            // Hide group headers if no visible rows under them
            rows.forEach((row, index) => {
                if (row.classList.contains('table-secondary')) {
                    let hasVisibleChild = false;
        
                    for (let i = index + 1; i < rows.length; i++) {
                        if (rows[i].classList.contains('table-secondary')) break;
                        if (rows[i].style.display !== 'none') {
                            hasVisibleChild = true;
                            break;
                        }
                    }
        
                    row.style.display = hasVisibleChild ? '' : 'none';
                }
            });
        });
        </script>




</body>

</html>