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
                                    <a href="{{ route('manage-gallery-images.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gallery Images</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-gallery-images.create') }}" class="btn btn-primary px-5 radius-30">+ Add Images</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Event Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach($galleryImages as $index => $gallery)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $gallery->event_name }}</td>
                                      <td>
                                          @if($gallery->thumbnail_image)
                                              <img src="{{ asset('uploads/campus-life/' . $gallery->thumbnail_image) }}" 
                                                  alt="{{ $gallery->event_name }}" 
                                                  style="width: 150px; height: auto; border-radius: 5px;">
                                          @else
                                              <span class="text-muted">No Image</span>
                                          @endif
                                      </td>
                                      <td>
                                          <!-- Action Buttons -->
                                          <a href="{{ route('manage-gallery-images.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                          <form action="{{ route('manage-gallery-images.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-sm btn-danger"
                                                      onclick="return confirm('Are you sure you want to delete this?')">
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