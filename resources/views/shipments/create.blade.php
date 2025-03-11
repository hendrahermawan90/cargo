@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Shipment
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('shipments.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Sender Name</label>
                                <input type="text" name="sender_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Sender Address</label>
                                <textarea name="sender_address" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Receiver Name</label>
                                <input type="text" name="receiver_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Receiver Address</label>
                                <textarea name="receiver_address" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Shipment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
