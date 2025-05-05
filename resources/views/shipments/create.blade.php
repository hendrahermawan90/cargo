@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Create New Shipment
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('shipments.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="sender_name">Sender Name</label>
                                <input type="text" name="sender_name" id="sender_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="sender_address">Sender Address</label>
                                <textarea name="sender_address" id="sender_address" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_name">Receiver Name</label>
                                <input type="text" name="receiver_name" id="receiver_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_address">Receiver Address</label>
                                <textarea name="receiver_address" id="receiver_address" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" name="weight" id="weight" class="form-control" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100">Save Shipment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
