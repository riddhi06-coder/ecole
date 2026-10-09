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
                  <h4>Add User Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-users.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>User Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate 
                                          action="{{ route('manage-users.store') }}" method="POST">
                                        @csrf
                                        
                                        
                                         <!-- Roles Dropdown -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="role_id">Select Role <span class="text-danger">*</span></label>
                                            <select class="form-control @error('role_id') is-invalid @enderror"
                                                    name="role_id" id="role_id" required>
                                                <option value="">-- Select Role --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                    
                                        <!-- User Name -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="user_name">User Name <span class="text-danger">*</span></label>
                                            <input class="form-control @error('user_name') is-invalid @enderror"
                                                   id="user_name" type="text" name="user_name"
                                                   value="{{ old('user_name') }}" placeholder="Enter User Name" required>
                                            @error('user_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                   id="email" type="email" name="email"
                                                   value="{{ old('email') }}" placeholder="Enter Email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                            
                                            <div class="input-group">
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                       id="password" type="password" name="password"
                                                       placeholder="Enter Password (Abc@1234)" minlength="8" required>
                                        
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" id="togglePassword" style="cursor:pointer;"></i>
                                                </span>
                                            </div>
                                        
                                            <small class="text-muted">
                                                Must be 8+ chars with uppercase, lowercase, number & symbol. Example: Abc@1234
                                            </small>
                                        
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        
                                        <!-- Confirm Password -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        
                                            <div class="input-group">
                                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       id="password_confirmation" type="password" name="password_confirmation"
                                                       placeholder="Confirm Password" minlength="8" required>
                                        
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" id="toggleConfirmPassword" style="cursor:pointer;"></i>
                                                </span>
                                            </div>
                                        
                                            <small class="text-muted">
                                                Must be 8+ chars with uppercase, lowercase, number & symbol. Example: Abc@1234
                                            </small>
                                        
                                            @error('password_confirmation')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    
                                       
                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-users.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>
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
       
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

       
       <script>
            // Toggle Password
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField  = document.querySelector('#password');
        
            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
        
                this.classList.toggle('fa-eye-slash');
            });
        
            // Toggle Confirm Password
            const toggleConfirm = document.querySelector('#toggleConfirmPassword');
            const confirmField  = document.querySelector('#password_confirmation');
        
            toggleConfirm.addEventListener('click', function () {
                const type = confirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmField.setAttribute('type', type);
        
                this.classList.toggle('fa-eye-slash');
            });
        </script>


</body>

</html>