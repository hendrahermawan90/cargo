@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card dark-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Shipments
                            <a href="{{ route('shipments.create') }}" class="btn btn-dark btn-sm float-end">Add New Shipment</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tracking Number</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Weight</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment->tracking_number }}</td>
                                        <td>{{ $shipment->sender_name }}</td>
                                        <td>{{ $shipment->receiver_name }}</td>
                                        <td>{{ $shipment->weight }} kg</td>
                                        <td>
                                            <span class="badge 
                                                @if($shipment->status == 'pending') 
                                                    badge-warning 
                                                @elseif($shipment->status == 'in_transit') 
                                                    badge-info 
                                                @elseif($shipment->status == 'delivered') 
                                                    badge-success 
                                                @endif">
                                                {{ $shipment->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('shipments.show', $shipment->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('shipments.edit', $shipment->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST"
                                                style="display:inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $shipments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
