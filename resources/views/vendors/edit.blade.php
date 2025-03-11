@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Vendor</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Vendor Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $vendor->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" class="form-control" id="contact" value="{{ old('contact', $vendor->contact) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="active" {{ $vendor->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $vendor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $vendor->address) }}">
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" id="city" value="{{ old('city', $vendor->city) }}">
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" id="state" value="{{ old('state', $vendor->state) }}">
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" id="postal_code" value="{{ old('postal_code', $vendor->postal_code) }}">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" class="form-control" id="country" value="{{ old('country', $vendor->country) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $vendor->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" name="website" class="form-control" id="website" value="{{ old('website', $vendor->website) }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $vendor->description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
