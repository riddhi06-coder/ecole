<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.3.0/apexcharts.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.3.0/apexcharts.min.js"></script>
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        @php
            $totalAdmissions = \DB::table('admission_details')->count();
            
            $totalCareerApplications = \DB::table('teaching_applications')->count();
            
            $contactenquiries = \DB::table('contact_enquiry')->count();
            
            $bulletin = \DB::table('bulletin_listing')->count();
        @endphp
        
        @php
            use Carbon\Carbon;
            
            // Get total admissions per month for the current year
            $monthlyAdmissions = \DB::table('admission_details')
                ->selectRaw('MONTH(inserted_at) as month, COUNT(*) as total')
                ->whereYear('inserted_at', now()->year)
                ->groupBy('month')
                ->pluck('total', 'month'); // returns array: [month => count]
            
            // Make sure all months are present (Jan=1 ... Dec=12)
            $admissionsData = [];
            for($m=1; $m<=12; $m++){
                $admissionsData[$m] = $monthlyAdmissions[$m] ?? 0;
            }
            
            $labels = collect(range(1,12))->map(function($m){
                return Carbon::create()->month($m)->format('M'); // Jan, Feb, ...
            })->toArray();
            
            $data = array_values($admissionsData); // array of totals
        @endphp
        
        
        @php

            // Get total career applications per month for current year
            $monthlyCareerApplications = \DB::table('teaching_applications')
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->pluck('total', 'month'); // [month => count]
            
            // Ensure all months 1-12 are present
            $careerData = [];
            for($m=1; $m<=12; $m++){
                $careerData[$m] = $monthlyCareerApplications[$m] ?? 0;
            }
            
            $careerLabels = collect(range(1,12))->map(function($m){
                return Carbon::create()->month($m)->format('M'); // Jan, Feb, ...
            })->toArray();
            
            $careerDataValues = array_values($careerData);
        @endphp
        
        
        @php
            // Monthly Contact Enquiries (current year)
            $monthlyContactEnquiries = \DB::table('contact_enquiry')
                ->selectRaw('MONTH(inserted_at) as month, COUNT(*) as total')
                ->whereYear('inserted_at', now()->year)
                ->groupBy('month')
                ->pluck('total', 'month');
            
            // Ensure all months exist
            $contactData = [];
            for ($m = 1; $m <= 12; $m++) {
                $contactData[$m] = $monthlyContactEnquiries[$m] ?? 0;
            }
            
            $contactLabels = collect(range(1, 12))->map(function ($m) {
                return \Carbon\Carbon::create()->month($m)->format('M');
            })->toArray();
            
            $contactDataValues = array_values($contactData);
        @endphp
        
        
        @php
            $monthlyBulletins = \DB::table('bulletin_listing')
                ->selectRaw('MONTH(inserted_at) as month, COUNT(*) as total')
                ->whereYear('inserted_at', now()->year)
                ->groupBy('month')
                ->pluck('total', 'month');
            
            $bulletinData = [];
            for ($m = 1; $m <= 12; $m++) {
                $bulletinData[$m] = $monthlyBulletins[$m] ?? 0;
            }
            
            $bulletinLabels = collect(range(1,12))->map(function ($m) {
                return \Carbon\Carbon::create()->month($m)->format('M');
            })->toArray();
            
            $bulletinDataValues = array_values($bulletinData);
        @endphp





       <div class="page-body"> 
          <div class="container-fluid">            
            <div class="page-title"> 
              <div class="row">
                
                
              </div>
            </div>
          </div>


        <!-- Container-fluid starts -->
          <div class="container-fluid">
            <div class="row"> 
            
                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Admission Enquiries</span>
                
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">{{ number_format($totalAdmissions) }}</h2>
                                    <span class="f-12 f-w-400"></span>
                                </div>
                
                                <div class="product-sub bg-primary-light">
                                    <svg class="invoice-icon">
                                        <use href="{{ asset('admin/assets/svg/icon-sprite.svg#color-swatch') }}"></use>
                                    </svg>
                                </div>
                            </div>
                
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                  

                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-Progress border-b-warning border-2">
                            <span class="f-light f-w-500 f-14">Total Career Application</span>
                
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">{{ number_format($totalCareerApplications) }}</h2>
                                    <span class="f-12 f-w-400"></span>
                                </div>
                
                                <div class="product-sub bg-warning-light">
                                    <svg class="invoice-icon">
                                        <use href="{{ asset('admin/assets/svg/icon-sprite.svg#tick-circle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                  
                  
                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <div class="card-body total-Complete border-b-secondary border-2"><span class="f-light f-w-500 f-14">Total Contact Enquiries</span>
                        <div class="project-details">
                          <div class="project-counter">
                            <h2 class="f-w-600">{{ number_format($contactenquiries) }}</h2><span class="f-12 f-w-400"></span>
                          </div>
                          <div class="product-sub bg-secondary-light"> 
                            <svg class="invoice-icon">
                              <use href="{{ asset('admin/assets/svg/icon-sprite.svg#add-square') }}"></use>
                            </svg>
                          </div>
                        </div>
                        <ul class="bubbles"> 
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"> </li>
                        </ul>
                      </div>
                    </div>
                 </div>
                  
                  
                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <div class="card-body total-upcoming"><span class="f-light f-w-500 f-14">Total Bulletins</span>
                        <div class="project-details"> 
                          <div class="project-counter">
                            <h2 class="f-w-600">{{ number_format($bulletin) }}</h2><span class="f-12 f-w-400"> </span>
                          </div>
                          <div class="product-sub bg-light-light"> 
                            <svg class="invoice-icon">
                              <use href="{{ asset('admin/assets/svg/icon-sprite.svg#edit-2') }}"></use>
                            </svg>
                          </div>
                        </div>
                        <ul class="bubbles"> 
                          <li class="bubble"> </li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                          <li class="bubble"></li>
                        </ul>
                      </div>
                    </div>
                </div>
             
            </div>
            
            
            <div class="row"> 
            
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="f-w-600 mb-4">Monthly Admission Enquiries</h5>
                            <canvas id="admissionsChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="f-w-600 mb-4">Monthly Career Applications</h5>
                            <canvas id="careerApplicationsChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="f-w-600 mb-4">Monthly Contact Applications</h5>
                            <canvas id="contactEnquiriesChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="f-w-600 mb-4">Monthly Bulletins</h5>
                            <canvas id="bulletinSparkChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                

            </div>


          </div>
          <!-- Container-fluid Ends -->
        </div>
      </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>

    
    @include('components.backend.main-js')
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

    <!--- Monthly Admission Graph----->
    <script>
        const ctx = document.getElementById('admissionsChart').getContext('2d');
        
        const admissionsChart = new Chart(ctx, {
            type: 'line', // you can change to 'bar' if you prefer
            data: {
                labels: {!! json_encode($labels) !!}, // Jan, Feb, ...
                datasets: [{
                    label: 'Admissions',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
    </script>
    
    
    <!--- Monthly Career Graph----->
    <script>
        const ctxCareer = document.getElementById('careerApplicationsChart').getContext('2d');
        
        const careerChart = new Chart(ctxCareer, {
            type: 'bar', // use 'bar' instead of 'pie'
            data: {
                labels: {!! json_encode($careerLabels) !!}, // Jan, Feb ...
                datasets: [{
                    label: 'Career Applications',
                    data: {!! json_encode($careerDataValues) !!},
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 5 } }
                }
            }
        });
    </script>
    
    
    <!--- Monthly Contact Graph----->
    <script>
        const ctxContact = document
            .getElementById('contactEnquiriesChart')
            .getContext('2d');
        
            new Chart(ctxContact, {
                type: 'radar',
                data: {
                    labels: {!! json_encode($contactLabels) !!},
                    datasets: [{
                        label: 'Contact Enquiries',
                        data: {!! json_encode($contactDataValues) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.3)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        pointBackgroundColor: 'rgba(255, 159, 64, 1)'
                    }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: { display: false }
                    }
                }
            }
        });
    </script>

    
    <!--- Monthly Bulletin Graph----->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

    const ctxBulletin = document.getElementById('bulletinSparkChart');
    if (!ctxBulletin) return;

    new Chart(ctxBulletin.getContext('2d'), {
        type: 'polarArea',
        data: {
            labels: {!! json_encode($bulletinLabels) !!},
            datasets: [{
                data: {!! json_encode($bulletinDataValues) !!},
                backgroundColor: [
                    'rgba(13,110,253,.6)',
                    'rgba(102,16,242,.6)',
                    'rgba(111,66,193,.6)',
                    'rgba(214,51,132,.6)',
                    'rgba(220,53,69,.6)',
                    'rgba(253,126,20,.6)',
                    'rgba(255,193,7,.6)',
                    'rgba(25,135,84,.6)',
                    'rgba(32,201,151,.6)',
                    'rgba(13,202,240,.6)',
                    'rgba(173,181,189,.6)',
                    'rgba(108,117,125,.6)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

});
    </script>


    
  

 
</body>

</html>