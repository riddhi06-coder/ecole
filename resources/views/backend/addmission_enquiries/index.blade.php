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

                        
                    </div>

                    <div class="table-responsive custom-scrollbar mt-5">

                    
                        <div class="flex-grow-1 d-flex justify-content-center mb-3">
                            <div class="col-md-6">
                                <select id="formTypeFilter" name="form_type" class="form-select">
                                    <option value="">-- Filter by Form Type --</option>
                                    <option value="1">Application for Admission</option>
                                    <option value="2">Schedule a Visit</option>
                                    <option value="3">Enquiry for Admission</option>
                                </select>
                            </div>
                        </div>

                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Date of Birth</th>
                                    <th>Present School</th>
                                    <th>Joining Grade</th>
                                    <th>Country</th>
                                    <th>Nationality</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="admissionTableBody">
                                @foreach($admission as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->student_name ?? '-' }}</td>
                                        <td>{{ $item->dob ? \Carbon\Carbon::parse($item->dob)->format('d M, Y') : '-' }}</td>
                                        <td>{{ $item->present_school ?? '-' }}</td>
                                        <td>{{ $item->join_grade_name ?? '-' }}</td>
                                        <td>{{ $item->country_name ?? '-' }}</td>
                                        <td>{{ $item->nationality_name ?? '-' }}</td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
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


</body>

</html>