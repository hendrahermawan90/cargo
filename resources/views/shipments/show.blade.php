@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipment Details
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Tracking Number:</strong>
                            <p>{{ $shipment->tracking_number }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Sender Name:</strong>
                            <p>{{ $shipment->sender_name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Sender Address:</strong>
                            <p>{{ $shipment->sender_address }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Receiver Name:</strong>
                            <p>{{ $shipment->receiver_name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Receiver Address:</strong>
                            <p>{{ $shipment->receiver_address }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Weight:</strong>
                            <p>{{ $shipment->weight }} kg</p>
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong>
                            <p>{{ $shipment->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
