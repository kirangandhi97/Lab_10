@extends('layouts.app')

@section('title', 'Edit Well')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Well: {{ $well->well_name }}</h2>
        </div>
        <div class="card-body">
            <!-- Form with PUT method and CSRF protection as required in 4.4 & 4.5 -->
            <form action="{{ route('wells.update', $well) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Well Name field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="well_name" class="form-label">Well Name</label>
                    <input type="text" class="form-control @error('well_name') is-invalid @enderror" id="well_name" name="well_name" value="{{ old('well_name', $well->well_name) }}">
                    @error('well_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field Location field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="field_location" class="form-label">Field Location</label>
                    <input type="text" class="form-control @error('field_location') is-invalid @enderror" id="field_location" name="field_location" value="{{ old('field_location', $well->field_location) }}">
                    @error('field_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Depth Meters field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="depth_meters" class="form-label">Depth (meters)</label>
                    <input type="number" class="form-control @error('depth_meters') is-invalid @enderror" id="depth_meters" name="depth_meters" value="{{ old('depth_meters', $well->depth_meters) }}">
                    @error('depth_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="Drilling" {{ old('status', $well->status) === 'Drilling' ? 'selected' : '' }}>Drilling</option>
                        <option value="Producing" {{ old('status', $well->status) === 'Producing' ? 'selected' : '' }}>Producing</option>
                        <option value="Suspended" {{ old('status', $well->status) === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="Decommissioned" {{ old('status', $well->status) === 'Decommissioned' ? 'selected' : '' }}>Decommissioned</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Production BPD field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="production_bpd" class="form-label">Production (barrels per day)</label>
                    <input type="number" step="0.01" class="form-control @error('production_bpd') is-invalid @enderror" id="production_bpd" name="production_bpd" value="{{ old('production_bpd', $well->production_bpd) }}">
                    @error('production_bpd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Leave empty if not applicable</div>
                </div>

                <!-- Commissioned Date field with validation from Appendix B & C -->
                <div class="mb-3">
                    <label for="commissioned_date" class="form-label">Commissioned Date</label>
                    <input type="date" class="form-control @error('commissioned_date') is-invalid @enderror" id="commissioned_date" name="commissioned_date" value="{{ old('commissioned_date', $well->commissioned_date->format('Y-m-d')) }}">
                    @error('commissioned_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Well</button>
                    <a href="{{ route('wells.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection