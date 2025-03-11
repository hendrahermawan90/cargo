@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipments
                            <a href="{{ route('shipments.create') }}" class="btn btn-primary float-end">Add New Shipment</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
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
                                        <td>{{ $shipment->status }}</td>
                                        <td>
                                            <a href="{{ route('shipments.show', $shipment->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('shipments.edit', $shipment->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $shipments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 