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
                                    <a href="{{ route('manage-addmission-enquiries.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Admission Enquiries Details</li>
                            </ol>
                        </nav>

                        <div class="col-md-6">
                            <select id="formTypeFilter" name="form_type" class="form-select">
                                <option value="">-- Filter by Form Type --</option>
                                <option value="1">Application for Admission</option>
                                <option value="2">Schedule a Visit</option>
                                <option value="3">Enquiry for Admission</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <input type="text" id="tableSearch" class="form-control w-25" placeholder="Search...">
                    </div>


                    <div class="table-responsive custom-scrollbar mt-5">

                        <table class="table table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Joining Grade</th>
                                    <th>Country</th>
                                    <th>Enquiry Date</th>
                                    
                                    <th>Payment Status</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="admissionTableBody">
                        
                                @php
                                    // Group admission records by form_type
                                    $grouped = $admission->groupBy('form_type');
                                    $counter = 1;
                                @endphp
                        
                                @foreach($grouped as $formTypeKey => $items)
                                    @php
                                        // Determine Form Type name
                                        $formTypeName = $formTypeKey == 1 ? 'Application for Admission' :
                                                        ($formTypeKey == 2 ? 'Schedule a Visit' :
                                                        ($formTypeKey == 3 ? 'Enquiry for Admission' : 'Other'));
                                    @endphp
                        
                                    <!-- Group Header Row -->
                                    <tr class="table-primary">
                                        <td colspan="8" class="fw-bold text-center">{{ $formTypeName }}</td>
                                    </tr>
                        
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $item->student_name ?? '-' }}</td>
                                            <td>{{ $item->join_grade_name ?? '-' }}</td>
                                            <td>{{ $item->country_name ?? '-' }}</td>
                                            <td>
                                                {{ $item->inserted_at 
                                                    ? \Carbon\Carbon::parse($item->inserted_at)->format('d M Y, h:i A') 
                                                    : '-' }}
                                            </td>
                                            <td>
                                                @if($item->payment_status)
                                                    @if($item->payment_status === 'Paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @elseif($item->payment_status === 'Failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @elseif($item->payment_status === 'Cancelled')
                                                        <span class="badge bg-warning">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $item->payment_status }}</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">NA</span>
                                                @endif
                                            </td>
                                            
                                            
                                            <td>
                                              {{-- Application Status --}}
                                                <div>
                                                    @if($item->application_status)
                                                        @php
                                                            $appClass = match($item->application_status) {
                                                                'Viewed' => 'bg-info',
                                                                'Under Review' => 'bg-warning text-dark',
                                                                'Processed' => 'bg-primary',
                                                                default => 'bg-secondary'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $appClass }}">
                                                            {{ $item->application_status }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary text-center">NA</span>
                                                    @endif
                                                </div>
                                            </td>
                                            
                                            <td><a href="{{ route('manage-addmission-enquiries.show', $item->id) }}" class="btn btn-primary btn-sm">View</a>
                                            
                                                <!--<a href="{{ route('admission.pdf', $item->id) }}"-->
                                                <!--   class="btn btn-danger btn-sm"-->
                                                <!--   target="_blank">-->
                                                <!--    PDF-->
                                                <!--</a>-->
                                            </td>
                                            
                                            
                                        </tr>
                                    @endforeach
                                @endforeach
                        
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
                    url: "{{ route('manage-addmission-enquiries.index') }}",
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
            document.getElementById('tableSearch').addEventListener('keyup', function() {
                var searchValue = this.value.toLowerCase();
                var rows = document.querySelectorAll('#admissionTableBody tr');

                rows.forEach(function(row) {
                    var text = row.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>



</body>

</html>