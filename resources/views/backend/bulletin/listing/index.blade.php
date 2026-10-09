<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')

    
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 42px;
            height: 22px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 22px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #28a745;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }
    </style>


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

                    <div class="d-flex justify-content-between align-items-start mb-4">

                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manage-bulletin-listing.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Bulletin Board List
                                </li>
                            </ol>
                        </nav>
                    
                        <!-- Right Controls -->
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
                    
                                <a href="{{ route('manage-bulletin-listing.create') }}"
                                   class="btn btn-primary px-5 radius-30">
                                    + Add Details
                                </a>
                            </div>
                    
                            <!-- Search Box -->
                            <input type="text" id="searchInput"
                                   class="form-control"
                                   placeholder="Search articles..."
                                   style="max-width: 800px; margin-top:20px;">
                        </div>
                    
                    </div>

                    
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article Name</th>
                                    <th>Article Image</th>
                                    <th>Highlights</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @forelse($categories as $category)
                                    <tr class="table-primary category-row" data-category="{{ strtolower($category->category) }}">
                                        <td colspan="5"><strong>{{ $category->category }}</strong></td>
                                    </tr>

                                    @forelse($category->listings as $listing)
                                        <tr class="listing-row">
                                            <td>{{ $sn++ }}</td>
                                            <td class="article-name">{{ $listing->article_name }}</td>
                                            <td>
                                                @if($listing->thumbnail_image)
                                                    {{-- If Image Exists --}}
                                                    <img src="{{ asset('uploads/bulletin/' . $listing->thumbnail_image) }}" 
                                                         alt="{{ $listing->article_name }}" 
                                                         style="max-height: 100px; border-radius: 6px;">
                                                @elseif($listing->thumbnail_video)
                                                    {{-- If Video Exists --}}
                                                    <video width="160px;" height="100px;" autoplay muted loop playsinline controls>
                                                        <source src="{{ asset('uploads/bulletin/videos/' . $listing->thumbnail_video) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <!--<td>{{ \Carbon\Carbon::parse($listing->article_date)->format('d M Y') }}</td>-->
                                            
                                            <td>
                                                <form method="POST" action="{{ route('bulletin.toggle.highlight') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $listing->id }}">
                                            
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                               name="is_highlight"
                                                               value="1"
                                                               onchange="this.form.submit()"
                                                               {{ $listing->is_highlight == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </form>
                                            </td>


                                            <td>
                                                <a href="{{ route('manage-bulletin-listing.edit', $listing->id) }}" class="btn btn-sm btn-primary">Edit</a><br><br>

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
        
        
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
        
            const searchInput   = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const rows = document.querySelectorAll('#bulletinTable tbody tr');
        
            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
        
                let currentCategory = '';
        
                rows.forEach(row => {
        
                    if (row.classList.contains('category-row')) {
                        currentCategory = row.dataset.category;
                        row.style.display = (!selectedCategory || currentCategory === selectedCategory)
                            ? ''
                            : 'none';
                        return;
                    }
        
                    if (row.classList.contains('listing-row')) {
                        const articleName = row.querySelector('.article-name')?.textContent.toLowerCase() || '';
        
                        const matchesSearch = articleName.includes(searchText);
                        const matchesCategory = !selectedCategory || currentCategory === selectedCategory;
        
                        row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
                    }
                });
            }
        
            searchInput.addEventListener('keyup', filterTable);
            categoryFilter.addEventListener('change', filterTable);
        });
        </script>



</body>

</html>