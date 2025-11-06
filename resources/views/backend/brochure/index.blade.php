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
                                    <a href="{{ route('manage-brochure-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Brochure Details</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-brochure-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Brochure</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Brochure</th>
                                <th>Fees</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($brochures as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($item->brochure)
                                                <a href="{{ asset($item->brochure) }}" target="_blank">
                                                    View PDF
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $fees = json_decode($item->fees, true);
                                            @endphp

                                            @if(!empty($fees))
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($fees as $fee)
                                                        <li>
                                                            <strong>
                                                                {{ $fee['passport_type'] == 1 ? 'Indian Passport' : 'Foreign Passport' }}
                                                            </strong>: ₹{{ $fee['amount'] }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manage-brochure-details.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('manage-brochure-details.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this brochure?')">Delete</button>
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