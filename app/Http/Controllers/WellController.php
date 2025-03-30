<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    /**
     * Display a listing of the wells.
     */
    public function index(Request $request)
    {
        $query = Well::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($request) {
                $q->where('well_name', 'like', "%{$request->search}%")
                  ->orWhere('status', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('field_location')) {
            $query->where('field_location', 'like', "%{$request->input('field_location')}%");
        }

        if ($request->filled('min_depth')) {
            $query->where('depth_meters', '>=', $request->input('min_depth'));
        }

        if ($request->filled('production_min')) {
            $query->where('production_bpd', '>=', $request->input('production_min'));
        }

        if ($request->filled('production_max')) {
            $query->where('production_bpd', '<=', $request->input('production_max'));
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('commissioned_date', [
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        }

        $wells = $query->get();
        return view('wells.index', compact('wells'));
    }

    /**
     * Show the form for creating a new well.
     */
    public function create()
    {
        return view('wells.create');
    }

    /**
     * Store a newly created well in the database.
     */
    public function store(Request $request)
    {
        // Validation implementing rules from Appendix B with custom messages from Appendix C
        $validated = $request->validate([
            'well_name' => 'required|unique:wells',
            'field_location' => 'required',
            'depth_meters' => 'required|integer|min:1',
            'status' => 'required|in:Drilling,Producing,Suspended,Decommissioned',
            'production_bpd' => 'nullable|numeric|min:0',
            'commissioned_date' => 'required|date',
        ], [
            'well_name.required' => 'The well name is required.',
            'well_name.unique' => 'This well name already exists.',
            'field_location.required' => 'The field location is required.',
            'depth_meters.required' => 'Depth is required.',
            'depth_meters.integer' => 'Depth must be a valid number.',
            'depth_meters.min' => 'Depth must be greater than 0.',
            'status.required' => 'The status is required.',
            'status.in' => 'Invalid status selected.',
            'production_bpd.numeric' => 'Production must be a valid number.',
            'production_bpd.min' => 'Production must be 0 or more.',
            'commissioned_date.required' => 'The commissioning date is required.',
            'commissioned_date.date' => 'Invalid date format.'
        ]);

    
        Well::create($validated);
        
        
        return redirect()->route('wells.index')->with('success', 'Well created successfully.');
    }

    /**
     * Display the specified well.
     */
    public function show(Well $well)
    {
        return view('wells.show', compact('well'));
    }

    /**
     * Show the form for editing the specified well.
     */
    public function edit(Well $well)
    {
        return view('wells.edit', compact('well'));
    }

    /**
     * Update the specified well in the database.
     */
    public function update(Request $request, Well $well)
    {
        // Validation implementing rules from Appendix B with custom messages from Appendix C
        // Note the unique rule adjustment as specified in Appendix B
        $validated = $request->validate([
            'well_name' => 'required|unique:wells,well_name,' . $well->id,
            'field_location' => 'required',
            'depth_meters' => 'required|integer|min:1',
            'status' => 'required|in:Drilling,Producing,Suspended,Decommissioned',
            'production_bpd' => 'nullable|numeric|min:0',
            'commissioned_date' => 'required|date',
        ], [
            'well_name.required' => 'The well name is required.',
            'well_name.unique' => 'This well name already exists.',
            'field_location.required' => 'The field location is required.',
            'depth_meters.required' => 'Depth is required.',
            'depth_meters.integer' => 'Depth must be a valid number.',
            'depth_meters.min' => 'Depth must be greater than 0.',
            'status.required' => 'The status is required.',
            'status.in' => 'Invalid status selected.',
            'production_bpd.numeric' => 'Production must be a valid number.',
            'production_bpd.min' => 'Production must be 0 or more.',
            'commissioned_date.required' => 'The commissioning date is required.',
            'commissioned_date.date' => 'Invalid date format.'
        ]);

        $well->update($validated);
        
        return redirect()->route('wells.index')->with('success', 'Well updated successfully.');
    }

    /**
     * Remove the specified well from the database.
     */
    public function destroy(Well $well)
    {
        $well->delete();
        
        return redirect()->route('wells.index')->with('success', 'Well deleted successfully.');
    }
}