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
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

                        @php
                            $teachingTitle = $titles[0]['title'] ?? 'Teaching Job Opportunities';
                            $nonTeachingTitle = $titles[1]['title'] ?? 'Non-Teaching Job Opportunities';
                        @endphp
                        
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manage-addmission-enquiries.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Job Application Enquiries Details</li>
                            </ol>
                        </nav>
                        
                        
                        <input type="text" id="tableSearch" class="form-control form-control-sm" style="width:350px;" placeholder="Search...">

                        <div class="col-md-4">
                            <select id="formTypeFilter" class="form-select">
                                <option value="">-- Filter by Job Type --</option>
                                <option value="1">{{ $teachingTitle }}</option>
                                <option value="2">{{ $nonTeachingTitle }}</option>
                            </select>
                        </div>

                    </div>


                    <div class="row mt-5 mb-3">
                        <div class="col-md-12">
                    
                            <div class="filter-container p-3 rounded shadow-sm">
                    
                                <div class="row g-3">
                    
                                    <!-- 1st Row -->
                                    <div class="col-md-3 col-6">
                                        <select id="filterRole" class="form-select form-select-sm">
                                            <option value="">Position</option>
                                            @foreach($roles as $id => $roleName)
                                                <option value="{{ $id }}">{{ $roleName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="col-md-3 col-6">
                                        <select id="filterGender" class="form-select form-select-sm">
                                            <option value="">Gender</option>
                                            @foreach($genders as $g)
                                                <option value="{{ strtolower($g) }}">{{ ucfirst($g) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <!--<div class="col-md-3 col-6">-->
                                    <!--    <select id="filterMarital" class="form-select form-select-sm">-->
                                    <!--        <option value="">Marital Status</option>-->
                                    <!--        @foreach($maritalStatuses as $m)-->
                                    <!--            <option value="{{ strtolower($m) }}">{{ ucfirst($m) }}</option>-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--</div>-->
                    
                                    <!--<div class="col-md-3 col-6">-->
                                    <!--    <select id="filterNationality" class="form-select form-select-sm">-->
                                    <!--        <option value="">Nationality</option>-->
                                    <!--        @foreach($nationalities as $n)-->
                                    <!--            <option value="{{ strtolower($n) }}">{{ $n }}</option>-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--</div>-->
                    
                                    <!-- 2nd Row -->
                                    <div class="col-md-3 col-6">
                                        <select id="filterNotice" class="form-select form-select-sm">
                                            <option value="">Notice Period</option>
                                            @foreach($noticePeriods as $np)
                                                <option value="{{ strtolower($np) }}">{{ $np }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="col-md-3 col-6">
                                        <select id="filterCurrentSalary" class="form-select form-select-sm">
                                            <option value="">Current Salary</option>
                                            @foreach($salaries as $s)
                                                <option value="{{ $s }}">{{ indian_number_format($s) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="col-md-3 col-6">
                                        <select id="filterExpectedSalary" class="form-select form-select-sm">
                                            <option value="">Expected Salary</option>
                                            @foreach($expected_salary as $es)
                                                <option value="{{ $es }}">{{ indian_number_format($es) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="col-md-3 col-6">
                                        <select id="filterApplicationDate" class="form-select form-select-sm">
                                            <option value="">Date</option>
                                            <option value="2">Last 2 Days</option>
                                            <option value="10">Last 10 Days</option>
                                            <option value="15">Last 15 Days</option>
                                            <option value="20">Last 20 Days</option>
                                            <option value="30">Last 1 Month</option>
                                        </select>
                                    </div>
                    
                                </div>
                    
                                <!-- Reset Button -->
                                <div class="text-end mt-3">
                                    <button id="resetFilters" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-undo me-1"></i> Reset
                                    </button>
                                </div>
                    
                            </div>
                    
                        </div>
                    </div>


                    <div class="table-responsive custom-scrollbar mt-5" style="max-height: 450px; overflow-y: auto;">

              
                        <table class="table table-bordered" id="jobTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>Position</th>
                                    <!--<th>DOB</th>-->
                                    <th>Gender</th>
                                    <!--<th>Marital Status</th>-->
                                    <!--<th>Nationality</th>-->
                                    <th>Notice Period</th>
                                    <th>Current Salary</th>
                                    <th>Expected Salary</th>
                                    <th>Applied Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                {{-- === Teaching Job Opportunities Section === --}}
                                <tr class="table-secondary">
                                    <td colspan="11" class="fw-bold">{{ $teachingTitle }}</td>
                                </tr>
                            
                                @php
                                    $teachingApps = $query->where('apply', 1);
                                @endphp
                            
                                @forelse($teachingApps as $index => $item)
                                    <tr data-role-id="{{ $item->position_applied }}"
                                        data-job-role="{{ $item->job_role }}"
                                        data-created-at="{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : '' }}">
                                        
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td>{{ $item->job_role ?? 'N/A' }}</td> <!-- POSITION -->
                                        <td>{{ ucfirst($item->gender ?? '-') }}</td>
                                        <!--<td>{{ $item->marital_status ?? '-' }}</td>-->
                                        <td>{{ $item->notice_period ?? '-' }}</td>
                                        <td>{{ indian_number_format($item->current_salary) ?? '-' }}</td>
                                        <td>{{ indian_number_format($item->expected_salary) ?? '-' }}</td>
                                        <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('manage-job-view.show', $item->id) }}"
                                               class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            No Teaching Applications Found.
                                        </td>
                                    </tr>
                                @endforelse

                            
                            
                                {{-- === Non-Teaching Job Opportunities Section === --}}
                                <tr class="table-secondary">
                                    <td colspan="11" class="fw-bold">{{ $nonTeachingTitle }}</td>
                                </tr>
                            
                                @php
                                    $nonTeachingApps = $query->where('apply', 2);
                                @endphp
                            
                                @forelse($nonTeachingApps as $index => $item)
                                    <tr data-role-id="{{ $item->position_applied }}"
                                        data-job-role="{{ $item->job_role }}"
                                        data-created-at="{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : '' }}">
                                        
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td>{{ $item->job_role ?? 'N/A' }}</td> <!-- POSITION -->
                                        <td>{{ ucfirst($item->gender ?? '-') }}</td>
                                        <!--<td>{{ $item->marital_status ?? '-' }}</td>-->
                                        <td>{{ $item->notice_period ?? '-' }}</td>
                                        <td>{{ indian_number_format($item->current_salary) ?? '-' }}</td>
                                        <td>{{ indian_number_format($item->expected_salary) ?? '-' }}</td>
                                        <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('manage-job-view.show', $item->id) }}"
                                                   class="btn btn-primary btn-sm">View</a>
                                                <a href="{{ route('job-application.pdf', $item->id) }}"
                                                   class="btn btn-secondary btn-sm" target="_blank">PDF</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            No Non-Teaching Applications Found.
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
        

        <!----- For Search Functionality ------>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
        
            const formTypeFilter = document.getElementById('formTypeFilter');
            const rows = Array.from(document.querySelectorAll('#jobTable tbody tr'));
        
            formTypeFilter.addEventListener('change', function () {
                const selectedType = this.value;
        
                // Reset all rows
                rows.forEach(row => row.style.display = '');
        
                if (selectedType === '') return;
        
                let showSection = false;
        
                rows.forEach(row => {
        
                    // SECTION HEADER
                    if (row.classList.contains('table-secondary')) {
                        const sectionText = row.textContent.toLowerCase();
        
                        if (
                            (selectedType === '1' && sectionText.includes('teaching')) ||
                            (selectedType === '2' && sectionText.includes('non'))
                        ) {
                            showSection = true;
                            row.style.display = '';
                        } else {
                            showSection = false;
                            row.style.display = 'none';
                        }
                        return;
                    }
        
                    // ROLE HEADER OR DATA ROW
                    if (showSection) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        
        });
        </script>


    
        <!----- For Reset Button Function------>
        <script>
            $('#resetFilters').on('click', function() {
                // Clear filters
                $('#filterGender, #filterMarital, #filterNationality, #filterNotice, #filterCurrentSalary, #filterExpectedSalary').val('');
            });
        </script>


        <!----- Filter Dropdown JS------->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
        
            const tableBody = document.querySelector('#jobTable tbody');
            const roleFilter = document.getElementById('filterRole');
        
            const filters = {
                gender: document.getElementById('filterGender'),
                notice: document.getElementById('filterNotice'),
                currentSalary: document.getElementById('filterCurrentSalary'),
                expectedSalary: document.getElementById('filterExpectedSalary'),
                applicationDate: document.getElementById('filterApplicationDate'),
                search: document.getElementById('tableSearch')
            };
        
            let rows = [];
        
            function refreshRows() {
                rows = Array.from(tableBody.querySelectorAll('tr'));
            }
        
            refreshRows();
        
            function applyFilters() {
        
                refreshRows();
        
                // Hide all rows first
                rows.forEach(r => r.style.display = 'none');
                document.querySelectorAll('.no-data-message').forEach(e => e.remove());
        
                const selectedRole = roleFilter.value;
                const gender = filters.gender.value.toLowerCase();
                const notice = filters.notice.value.toLowerCase();
                const currentSalary = filters.currentSalary.value;
                const expectedSalary = filters.expectedSalary.value;
                const appDays = filters.applicationDate.value;
                const search = filters.search?.value.toLowerCase() || '';
        
                const today = new Date();
                let matchedCount = 0;
        
                rows.forEach(row => {
        
                    // Skip section headers (Teaching / Non-Teaching)
                    if (row.classList.contains('table-secondary')) return;
        
                    const roleId = row.dataset.roleId || '';
                    const rowGender = row.children[3]?.textContent.toLowerCase() || '';
                    const rowNotice = row.children[4]?.textContent.toLowerCase() || '';
                    const rowCurrentSalary = row.children[5]?.textContent.replace(/[₹,]/g, '') || '';
                    const rowExpectedSalary = row.children[6]?.textContent.replace(/[₹,]/g, '') || '';
                    const rowText = row.textContent.toLowerCase();
        
                    let dateMatch = true;
                    if (appDays && row.dataset.createdAt) {
                        const created = new Date(row.dataset.createdAt);
                        const diff = (today - created) / (1000 * 60 * 60 * 24);
                        dateMatch = diff <= parseInt(appDays);
                    }
        
                    const matches =
                        (!selectedRole || roleId === selectedRole) &&
                        (!gender || rowGender === gender) &&
                        (!notice || rowNotice === notice) &&
                        (!currentSalary || rowCurrentSalary.includes(currentSalary)) &&
                        (!expectedSalary || rowExpectedSalary.includes(expectedSalary)) &&
                        (!search || rowText.includes(search)) &&
                        dateMatch;
        
                    if (!matches) return;
        
                    // Show matched row
                    row.style.display = '';
                    matchedCount++;
        
                    // Show section header above it
                    let prev = row.previousElementSibling;
                    while (prev) {
                        if (prev.classList.contains('table-secondary')) {
                            prev.style.display = '';
                            break;
                        }
                        prev = prev.previousElementSibling;
                    }
                });
        
                // Global no data
                if (matchedCount === 0) {
                    tableBody.insertAdjacentHTML(
                        'afterbegin',
                        `<tr class="no-data-message">
                            <td colspan="9" class="text-center text-muted fw-semibold">
                                No Data Available
                            </td>
                        </tr>`
                    );
                }
            }
        
            // Bind filter events
            document.querySelectorAll('.form-select-sm').forEach(el => {
                el.addEventListener('change', applyFilters);
            });
        
            filters.search?.addEventListener('keyup', applyFilters);
        
            // Reset
            document.getElementById('resetFilters').addEventListener('click', function () {
                Object.values(filters).forEach(f => f && (f.value = ''));
                roleFilter.value = '';
        
                refreshRows();
                rows.forEach(r => r.style.display = '');
                document.querySelectorAll('.no-data-message').forEach(e => e.remove());
            });
        
        });
        </script>













</body>

</html>