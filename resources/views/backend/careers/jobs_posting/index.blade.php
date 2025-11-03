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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manage-job-postings.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Job Posting</li>
                            </ol>
                        </nav>

                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('manage-job-postings.create') }}" class="btn btn-primary px-5 radius-30 mb-2">
                                + Add Job Roles
                            </a>

                            <!-- 🔍 Search Section -->
                            <div class="input-group" style="width: 250px;">
                                <input type="text" id="jobSearch" class="form-control" placeholder="Search by Job Role or Category...">
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                       @foreach($jobCategories as $category)
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">{{ $category['title'] }}</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        // Filter job postings by current category ID
                                        $categoryJobs = $jobPostings->where('job_category_id', $category['id']);
                                    @endphp

                                    @if($categoryJobs->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped align-middle">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60px;">#</th>
                                                        <th>Job Role</th>
                                                        <th style="width: 280px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($categoryJobs->count() > 0)
                                                        @foreach($categoryJobs as $key => $job)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $job->job_roles }}</td>
                                                                <td>
                                                                    <a href="{{ route('manage-job-postings.edit', $job->id) }}" class="btn btn-sm btn-primary me-1">
                                                                        Edit
                                                                    </a>
                                                                    <form action="{{ route('manage-job-postings.destroy', $job->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job role?')">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">
                                                                No job roles available under this category.
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No job roles added under this category.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach


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
            document.addEventListener("DOMContentLoaded", function () {
                const searchInput = document.getElementById("jobSearch");
                const container = document.querySelector(".table-responsive.custom-scrollbar");
                const categoryCards = container.querySelectorAll(".card");

                // ✅ Create a "No results found" message
                const noResultsMsg = document.createElement("div");
                noResultsMsg.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-exclamation-circle fs-3 d-block mb-2"></i>
                        <p class="mb-0">No matching job roles or categories found.</p>
                    </div>
                `;
                noResultsMsg.style.display = "none";
                // Append AFTER the container, not inside
                container.parentNode.insertBefore(noResultsMsg, container.nextSibling);

                searchInput.addEventListener("keyup", function () {
                    const query = searchInput.value.toLowerCase().trim();
                    let anyMatch = false;

                    categoryCards.forEach(card => {
                        const categoryTitle = card.querySelector(".card-header h5").textContent.toLowerCase();
                        const jobRows = card.querySelectorAll("tbody tr");
                        let matchFound = false;

                        jobRows.forEach(row => {
                            const jobRole = row.querySelector("td:nth-child(2)")?.textContent.toLowerCase();
                            if (jobRole && (jobRole.includes(query) || categoryTitle.includes(query))) {
                                row.style.display = "";
                                matchFound = true;
                            } else {
                                row.style.display = "none";
                            }
                        });

                        if (matchFound || categoryTitle.includes(query) || query === "") {
                            card.style.display = "";
                            anyMatch = true;
                        } else {
                            card.style.display = "none";
                        }
                    });

                    // ✅ Show or hide the "No results found" message
                    noResultsMsg.style.display = anyMatch ? "none" : "block";
                });
            });
        </script>




</body>

</html>