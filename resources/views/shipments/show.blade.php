@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Shipment Details
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Tracking Number:</strong>
                            <p class="bg-light p-2 rounded">{{ $shipment->tracking_number }}</p>
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
                            <p class="badge 
                                @if($shipment->status == 'pending') 
                                    badge-warning 
                                @elseif($shipment->status == 'in_transit') 
                                    badge-info 
                                @elseif($shipment->status == 'delivered') 
                                    badge-success 
                                @endif">
                                {{ $shipment->status }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
