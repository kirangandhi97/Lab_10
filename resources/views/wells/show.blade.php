@extends('layouts.app')

@section('title', 'Well Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Well Details: {{ $well->well_name }}</h2>
            <div>
                <a href="{{ route('wells.edit', $well) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('wells.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="table-light" style="width: 40%">Well Name</th>
                            <td>{{ $well->well_name }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Field Location</th>
                            <td>{{ $well->field_location }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Depth (meters)</th>
                            <td>{{ $well->depth_meters }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Status</th>
                            <td>
                                <span class="badge {{ 
                                        $well->status === 'Producing' ? 'bg-success' :
        ($well->status === 'Drilling' ? 'bg-warning' :
            ($well->status === 'Suspended' ? 'bg-secondary' : 'bg-danger')) 
                                    }}">
                                    {{ $well->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-light">Production (bpd)</th>
                            <td>{{ $well->production_bpd ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Commissioned Date</th>
                            <td>{{ $well->commissioned_date->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Created At</th>
                            <td>{{ $well->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Last Updated</th>
                            <td>{{ $well->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Well Status Information
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>Current Status:</strong> {{ $well->status }}
                            </p>
                            @if($well->status === 'Producing')
                                <div class="alert alert-success">
                                    <h5>Producing Well</h5>
                                    <p>This well is currently operational and producing
                                        {{ $well->production_bpd ?? 'an unknown amount of' }} barrels per day.</p>
                                </div>
                            @elseif($well->status === 'Drilling')
                                <div class="alert alert-warning">
                                    <h5>Drilling in Progress</h5>
                                    <p>This well is currently in the drilling phase. Production has not yet started.</p>
                                </div>
                            @elseif($well->status === 'Suspended')
                                <div class="alert alert-secondary">
                                    <h5>Operations Suspended</h5>
                                    <p>This well's operations have been temporarily suspended.</p>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <h5>Decommissioned</h5>
                                    <p>This well has been permanently decommissioned and is no longer in service.</p>
                                </div>
                            @endif

                            <p class="mt-3">
                                <strong>Well Age:</strong>
                                {{ $well->commissioned_date->diffInYears(now()) }} years
                                (Commissioned on {{ $well->commissioned_date->format('F j, Y') }})
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <!-- Delete form following A.7 pattern with method spoofing for DELETE -->
                <form action="{{ route('wells.destroy', $well) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this well?')">Delete Well</button>
                </form>
            </div>
        </div>
    </div>
@endsection