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
                                    <a href="{{ route('manage-bulletin-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"> Bulletin Board Details</li>
                            </ol>
                        </nav>

                        <!-- Button -->
                        <div class="d-flex flex-column align-items-end">

                            <a href="{{ route('manage-bulletin-details.create') }}" class="btn btn-primary px-5 radius-30 mb-2">+ Add Details</a>

                            <input type="text" id="searchInput" class="form-control" placeholder="Search articles..." style="max-width: 800px;">
                        </div>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp

                                @foreach($categories as $category)
                                    <!-- Category row -->
                                    <tr class="table-secondary category-row">
                                        <td colspan="4"><strong>{{ $category->category }}</strong></td>
                                    </tr>

                                    @foreach($category->details as $detail)
                                        <tr class="listing-row">
                                            <td>{{ $sn++ }}</td>
                                            <td class="article-name">{{ $detail->title ?? $detail->article_name }}</td>
                                            <td>{{ $detail->location ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('manage-bulletin-details.edit', $detail->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('manage-bulletin-details.destroy', $detail->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                
                                <!-- No Data Row -->
                                <tr class="no-data text-center" style="display: none;">
                                    <td colspan="4"><strong>No articles found.</strong></td>
                                </tr>
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


        <!-- JS Search -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const table = document.getElementById('bulletinTable');
                const noDataRow = table.querySelector('.no-data');

                if (!table) return;

                searchInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();
                    const rows = Array.from(table.querySelectorAll('tbody tr'));
                    let anyVisible = false;
                    let currentCategory = null;
                    let anyVisibleInCategory = false;

                    rows.forEach(row => {
                        if (row.classList.contains('category-row')) {
                            currentCategory = row;
                            anyVisibleInCategory = false;
                        } 
                        else if (row.classList.contains('listing-row')) {
                            const articleName = row.querySelector('.article-name').textContent.toLowerCase();
                            const match = articleName.includes(filter);

                            row.style.display = match ? '' : 'none';

                            if (match) {
                                anyVisibleInCategory = true;
                                anyVisible = true;
                            }
                        }

                        // Show category only if it has visible listings
                        if (currentCategory) {
                            currentCategory.style.display = anyVisibleInCategory ? '' : 'none';
                        }
                    });

                    // Show "No articles found" if nothing matches
                    noDataRow.style.display = anyVisible ? 'none' : '';
                });
            });
        </script>



</body>

</html>