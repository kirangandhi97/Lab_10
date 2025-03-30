@extends('layouts.app')

@section('title', 'Well List')

@section('content')
    <div class="card shadow-lg border-light">
        <div class="card-header bg-dark text-white">
            <h2>Well List</h2>
        </div>
        <div class="card-body">
            <!-- Search form with improved styling -->
            <form method="GET" action="{{ route('wells.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="search" placeholder="Search name or status..." class="form-control border-info" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="field_location" placeholder="Field location" class="form-control border-info" value="{{ request('field_location') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" name="min_depth" placeholder="Min depth" class="form-control border-info" value="{{ request('min_depth') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-info">Search</button>
                        <a href="{{ route('wells.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="number" step="0.01" name="production_min" placeholder="Min production" class="form-control border-info" value="{{ request('production_min') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" step="0.01" name="production_max" placeholder="Max production" class="form-control border-info" value="{{ request('production_max') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="date" name="start_date" placeholder="Start date" class="form-control border-info" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="date" name="end_date" placeholder="End date" class="form-control border-info" value="{{ request('end_date') }}">
                    </div>
                </div>
            </form>

            @if(count($wells) > 0)
                <!-- Table layout with enhanced styles -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Well Name</th>
                                <th>Field Location</th>
                                <th>Depth (m)</th>
                                <th>Status</th>
                                <th>Production (bpd)</th>
                                <th>Commissioned</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wells as $well)
                                <tr>
                                    <td>{{ $well->well_name }}</td>
                                    <td>{{ $well->field_location }}</td>
                                    <td>{{ $well->depth_meters }}</td>
                                    <td>
                                        <span class="badge {{ 
                                            $well->status === 'Producing' ? 'bg-success' : 
                                            ($well->status === 'Drilling' ? 'bg-warning' : 
                                            ($well->status === 'Suspended' ? 'bg-secondary' : 'bg-danger')) 
                                        }}">
                                            {{ $well->status }}
                                        </span>
                                    </td>
                                    <td>{{ $well->production_bpd ?? 'N/A' }}</td>
                                    <td>{{ $well->commissioned_date->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- View button with custom styling -->
                                            <a href="{{ route('wells.show', $well) }}" class="btn btn-outline-info btn-sm">View</a>
                                            
                                            <!-- Edit button with custom styling -->
                                            <a href="{{ route('wells.edit', $well) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                            
                                            <!-- Delete form with custom styling -->
                                            <form action="{{ route('wells.destroy', $well) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this well?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning">
                    No wells found. <a href="{{ route('wells.create') }}" class="alert-link">Register a new well</a>.
                </div>
            @endif
        </div>
    </div>
@endsection
