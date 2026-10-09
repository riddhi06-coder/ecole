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
                                    <a href="{{ route('manage-users.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>

                        <a href="{{ route('manage-users.create') }}" class="btn btn-primary px-5 radius-30">+ Add User</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                        
                                        <td>{{ $user->name }}</td>
                        
                                        <td>{{ $user->role->role_name ?? 'No Role Assigned' }}</td>
                                        
                                        <td>
                                            @if($user->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                        
                                        <td>
                                            
                                            
                                            <!-- Activate / Deactivate -->
                                            <form action="{{ route('manage-users.toggle-status', $user->id) }}" 
                                                  method="POST" 
                                                  style="display:inline-block;">
                                                @csrf
                                        
                                                @if($user->status == 1)
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-warning"
                                                            onclick="return confirm('Do you want to deactivate this user?');">
                                                        Deactivate
                                                    </button>
                                                @else
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-success"
                                                            onclick="return confirm('Do you want to activate this user?');">
                                                        Activate
                                                    </button>
                                                @endif
                                            </form>
                                        
                                        
                                            <!-- Edit -->
                                            <a href="{{ route('manage-users.edit', $user->id) }}" 
                                               class="btn btn-sm btn-primary">Edit</a>
                                        
                                            
                                            <!-- Delete -->
                                            <form action="{{ route('manage-users.destroy', $user->id) }}" 
                                                  method="POST" 
                                                  style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                        
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
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