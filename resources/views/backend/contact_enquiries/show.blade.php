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
                  <h4>Student Details</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-contact-enquiries.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Enquiry Details</li>
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
                        <h4>Enquiry Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">

                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    
                                    
                                    
                                    
                                    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                               
                                        <a href="{{ route('contact-application.pdf', $contact->id) }}"
                                           class="btn btn-primary btn-sm"
                                           target="_blank">
                                            <i class="fa fa-file-pdf me-1"></i> Download PDF
                                        </a>
                                    </div>
                                    

                                   <form class="row g-3 custom-input">

                                        <!-- Form Type -->
                                        <div class="col-md-6">
                                            <label class="form-label">Form Type</label>
                                            <input type="text" class="form-control" readonly value="{{ $formType }}">
                                        </div>
                                    
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $contact->name ?? '-' }}">
                                        </div>
                                    
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" readonly value="{{ $contact->email ?? '-' }}">
                                        </div>
                                    
                                        <!-- Phone -->
                                        <div class="col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" readonly value="{{ $contact->phone ?? '-' }}">
                                        </div>
                                    
                                        <!-- Enquiry Type -->
                                        @if(!empty($contact->enquiry_type))
                                            <div class="col-md-6">
                                                <label class="form-label">Enquiry Type</label>
                                                <input type="text"
                                                       class="form-control"
                                                       readonly
                                                       value="{{ ucfirst($contact->enquiry_type) }}">
                                            </div>
                                        @endif
                                    
                                        <!-- Enquiry Date -->
                                        <div class="col-md-6">
                                            <label class="form-label">Enquiry Date</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $contact->inserted_at ? \Carbon\Carbon::parse($contact->inserted_at)->format('d M Y, h:i A') : '-' }}">
                                        </div>
                                    
                                        <!-- Message -->
                                        <div class="col-md-12">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" rows="4" readonly>{{ $contact->message ?? '-' }}</textarea>
                                        </div>
                                    
                                        <!-- Back Button -->
                                        <div class="col-12 text-end mt-4">
                                            <a href="{{ route('manage-contact-enquiries.index') }}"
                                               class="btn btn-secondary px-4">
                                                ← Back to List
                                            </a>
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