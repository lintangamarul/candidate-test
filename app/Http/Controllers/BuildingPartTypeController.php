<?php

namespace App\Http\Controllers;

use App\Models\BuildingPartType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BuildingPartTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
{
    $search = request('search');
    
    $buildingPartTypes = BuildingPartType::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);
        
    return view('building-part-types.index', compact('buildingPartTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('building-part-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        BuildingPartType::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('building-part-types.index')
            ->with('success', 'Building Part Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BuildingPartType $buildingPartType): View
    {
        return view('building-part-types.show', compact('buildingPartType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuildingPartType $buildingPartType): View
    {
        return view('building-part-types.edit', compact('buildingPartType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuildingPartType $buildingPartType): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $buildingPartType->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('building-part-types.index')
            ->with('success', 'Building Part Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuildingPartType $buildingPartType): RedirectResponse
    {
        $buildingPartType->delete();

        return redirect()->route('building-part-types.index')
            ->with('success', 'Building Part Type deleted successfully.');
    }
}