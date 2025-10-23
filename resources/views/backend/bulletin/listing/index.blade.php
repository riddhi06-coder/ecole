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
                                    <a href="{{ route('manage-bulletin-listing.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"> Bulletin Board List</li>
                            </ol>
                        </nav>

                        <!-- Button -->
                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('manage-bulletin-listing.create') }}" class="btn btn-primary px-5 radius-30 mb-2">+ Add Details</a>
                            
                            <!-- Search Box directly below button -->
                            <input type="text" id="searchInput" class="form-control" placeholder="Search articles..." style="max-width: 800px;">
                        </div>
                    </div>
                    
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article Name</th>
                                    <th>Article Image</th>
                                    <th>Article Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($categories as $category)
                                    <tr class="table-primary category-row">
                                        <td colspan="5"><strong>{{ $category->category }}</strong></td>
                                    </tr>

                                    @forelse($category->listings as $listing)
                                        <tr class="listing-row">
                                            <td>{{ $sn++ }}</td>
                                            <td class="article-name">{{ $listing->article_name }}</td>
                                            <td>
                                                @if($listing->thumbnail_image)
                                                    <img src="{{ asset('uploads/bulletin/' . $listing->thumbnail_image) }}" 
                                                        alt="{{ $listing->article_name }}" style="max-height: 100px;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($listing->article_date)->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('manage-bulletin-listing.edit', $listing->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <form action="{{ route('manage-bulletin-listing.destroy', $listing->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="no-articles">
                                            <td colspan="5" class="text-center">No articles in this category.</td>
                                        </tr>
                                    @endforelse
                                @empty
                                    <tr class="no-articles">
                                        <td colspan="5" class="text-center">No categories found.</td>
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


        <!-- JS Search -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const table = document.getElementById('bulletinTable');

                if (!table) return;

                searchInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();
                    const rows = Array.from(table.querySelectorAll('tbody tr'));

                    let currentCategory = null;
                    let categoryMatchesFilter = false;

                    rows.forEach(row => {
                        if (row.classList.contains('category-row')) {
                            currentCategory = row;
                            categoryMatchesFilter = row.textContent.toLowerCase().includes(filter);
                            // Initially hide category, will show later if matches or has visible articles
                            row.style.display = categoryMatchesFilter ? '' : 'none';
                        } 
                        else if (row.classList.contains('listing-row')) {
                            const articleName = row.querySelector('.article-name').textContent.toLowerCase();
                            const showRow = articleName.includes(filter) || categoryMatchesFilter;

                            row.style.display = showRow ? '' : 'none';

                            // If any listing is visible, show the category
                            if (showRow && currentCategory) {
                                currentCategory.style.display = '';
                            }
                        } 
                        else if (row.classList.contains('no-articles')) {
                            row.style.display = filter ? 'none' : '';
                        }
                    });
                });
            });
        </script>


</body>

</html>