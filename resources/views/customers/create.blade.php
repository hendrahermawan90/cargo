@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Add New Customer</h4>
                            <a href="{{ route('customers.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Validation Errors</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('customers.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Personal Information Section -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control" id="name" 
                                               value="{{ old('name') }}" placeholder="Full Name" required>
                                        <label for="name" class="form-label">Full Name</label>
                                        <div class="invalid-feedback">Please enter customer name</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" 
                                               value="{{ old('email') }}" placeholder="Email Address" required>
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="invalid-feedback">Please enter a valid email</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" class="form-control" id="phone" 
                                               value="{{ old('phone') }}" placeholder="Phone Number">
                                        <label for="phone" class="form-label">Phone Number</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="address" class="form-control" id="address" 
                                               value="{{ old('address') }}" placeholder="Full Address">
                                        <label for="address" class="form-label">Full Address</label>
                                    </div>
                                </div>
                                
                                <!-- Status Section -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-label fw-bold">Account Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                            <select name="Status" class="form-select" id="status">
                                                <option value="1" {{ old('Status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('Status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_deleted" class="form-label fw-bold">Account Deletion Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-trash-alt"></i></span>
                                            <select name="IsDeleted" class="form-select" id="is_deleted">
                                                <option value="0" {{ old('IsDeleted') == '0' ? 'selected' : '' }}>Active Account</option>
                                                <option value="1" {{ old('IsDeleted') == '1' ? 'selected' : '' }}>Deleted Account</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save Customer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        // Client-side validation
        (function () {
            'use strict'
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
            
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    @endsection
@endsection