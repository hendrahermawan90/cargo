@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Customer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan error jika ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $customer->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $customer->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $customer->phone) }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $customer->address) }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="Status" class="form-control" id="status">
                                    <option value="1" {{ old('Status', $customer->Status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('Status', $customer->Status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_deleted" class="form-label">Is Deleted</label>
                                <select name="IsDeleted" class="form-control" id="is_deleted">
                                    <option value="1" {{ old('IsDeleted', $customer->IsDeleted) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('IsDeleted', $customer->IsDeleted) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
