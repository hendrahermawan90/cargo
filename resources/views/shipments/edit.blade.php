@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Edit Shipment
                            <a href="{{ route('shipments.index') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="sender_name">Sender Name</label>
                                <input type="text" name="sender_name" value="{{ $shipment->sender_name }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="sender_address">Sender Address</label>
                                <textarea name="sender_address" class="form-control" required>{{ $shipment->sender_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_name">Receiver Name</label>
                                <input type="text" name="receiver_name" value="{{ $shipment->receiver_name }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_address">Receiver Address</label>
                                <textarea name="receiver_address" class="form-control" required>{{ $shipment->receiver_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" value="{{ $shipment->weight }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="in_transit" {{ $shipment->status == 'in_transit' ? 'selected' : '' }}>In
                                        Transit</option>
                                    <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100">Update Shipment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
