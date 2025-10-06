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
                                    <a href="{{ route('manage-nonteaching-jobs.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Non-Teaching Job Opportunities </li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-nonteaching-jobs.create') }}" class="btn btn-primary px-5 radius-30">+ Add Details</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Heading</th>
                                <th>Banner Image</th>
                             
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($teaching as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->banner_heading }}</td>
                                        <td>
                                            @if(!empty($item->banner_image) && file_exists(public_path('uploads/careers/' . $item->banner_image)))
                                                <img src="{{ asset('uploads/careers/' . $item->banner_image) }}" 
                                                    alt="Banner Image" 
                                                    class="img-fluid rounded border" 
                                                    style="max-height: 100px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('manage-nonteaching-jobs.edit', $item->id) }}" class="btn btn-sm btn-primary me-1">
                                              Edit
                                            </a>
                                            <form action="{{ route('manage-nonteaching-jobs.destroy', $item->id) }}" 
                                                method="POST" 
                                                class="d-inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                                </button>
                                            </form>
                                        </td>
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

</body>

</html>