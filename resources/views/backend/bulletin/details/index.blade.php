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

                    <div class="d-flex flex-column align-items-end gap-2">

                        <!-- Category + Add Button -->
                        <div class="d-flex align-items-center gap-2">
                            <select id="categoryFilter" class="form-select" style="width: 220px;">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ strtolower($category->category) }}">
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                    
                            <a href="{{ route('manage-bulletin-details.create') }}"
                               class="btn btn-primary px-5 radius-30">
                                + Add Details
                            </a>
                        </div>
                    
                        <!-- Search -->
                        <input type="text" id="searchInput"
                               class="form-control"
                               placeholder="Search articles..."
                               style="max-width: 500px; margin-top:30px;">
                    </div>



                    <div class="table-responsive custom-scrollbar mt-3">
                        <table class="table table-bordered table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article Name</th>
                                    <th>Image</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp

                                @foreach($categories as $category)
                                    <!-- Category row -->
                                    <tr class="table-secondary category-row" data-category="{{ strtolower($category->category) }}">
                                        <td colspan="5"><strong>{{ $category->category }}</strong></td>
                                    </tr>

                                    @foreach($category->details as $detail)
                                        <tr class="listing-row">
                                            <td>{{ $sn++ }}</td>
                                            <td class="article-name">{{ $detail->article->article_name ?? 'N/A' }}</td>
                                            <td>
                                                @if($detail->thumbnail_image)
                                                    {{-- Show Image --}}
                                                    <img src="{{ asset('uploads/bulletin/' . $detail->thumbnail_image) }}" 
                                                         alt="{{ $detail->title ?? $detail->article_name }}" 
                                                         style="width: 120px; height: auto; border-radius: 6px;">
                                                @elseif($detail->thumbnail_video)
                                                    {{-- Show Video --}}
                                                    <video width="160px;" height="100px;" autoplay muted loop playsinline controls 
                                                           style="border-radius: 6px; display: block;">
                                                        <source src="{{ asset('uploads/bulletin/videos/' . $detail->thumbnail_video) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <td>{{ $detail->location ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('manage-bulletin-details.edit', $detail->id) }}" class="btn btn-sm btn-primary">Edit</a><br><br>
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
        
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {

    const searchInput    = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const rows = document.querySelectorAll('#bulletinTable tbody tr');
    const noDataRow = document.querySelector('.no-data');

    function filterTable() {
        const searchText = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;

        let currentCategory = '';
        let hasVisibleRows = false;

        rows.forEach(row => {

            // Category row
            if (row.classList.contains('category-row')) {
                currentCategory = row.dataset.category;
                const showCategory = !selectedCategory || currentCategory === selectedCategory;
                row.style.display = showCategory ? '' : 'none';
                return;
            }

            // Listing row
            if (row.classList.contains('listing-row')) {
                const articleName =
                    row.querySelector('.article-name')?.textContent.toLowerCase() || '';

                const matchesSearch = articleName.includes(searchText);
                const matchesCategory =
                    !selectedCategory || currentCategory === selectedCategory;

                const visible = matchesSearch && matchesCategory;
                row.style.display = visible ? '' : 'none';

                if (visible) hasVisibleRows = true;
            }
        });

        // Show / hide "No data" row
        if (noDataRow) {
            noDataRow.style.display = hasVisibleRows ? 'none' : '';
        }
    }

    searchInput.addEventListener('keyup', filterTable);
    categoryFilter.addEventListener('change', filterTable);
});
        </script>




</body>

</html>