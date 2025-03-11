@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Shipment
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Sender Name</label>
                                <input type="text" name="sender_name" value="{{ $shipment->sender_name }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Sender Address</label>
                                <textarea name="sender_address" class="form-control">{{ $shipment->sender_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Receiver Name</label>
                                <input type="text" name="receiver_name" value="{{ $shipment->receiver_name }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Receiver Address</label>
                                <textarea name="receiver_address" class="form-control">{{ $shipment->receiver_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" value="{{ $shipment->weight }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="in_transit" {{ $shipment->status == 'in_transit' ? 'selected' : '' }}>In
                                        Transit</option>
                                    <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Shipment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
