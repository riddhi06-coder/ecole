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
                                    <a href="{{ route('manage-home-festivities.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Festivities Hosted</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-home-festivities.create') }}" class="btn btn-primary px-5 radius-30">+ Add Festivitiess</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Imagee</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($festivities as $index => $festivity)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $festivity->heading }}</td>
                                        <td>
                                            @if(!empty($festivity->image))
                                                <img src="{{ asset('uploads/home/festivities/' . $festivity->image) }}" alt="Festivity Image" width="120" height="80" style="object-fit: cover;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manage-home-festivities.edit', $festivity->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('manage-home-festivities.destroy', $festivity->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this festivity?')">Delete</button>
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