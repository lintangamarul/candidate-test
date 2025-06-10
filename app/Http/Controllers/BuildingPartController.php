<?php

namespace App\Http\Controllers;

use App\Models\BuildingPart;
use App\Models\Project;
use App\Models\BuildingPartType;
use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BuildingPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project): View
    {
        $buildingParts = $project->buildingParts()->with(['buildingPartType', 'material', 'supplier'])->paginate(10);
        return view('building-parts.index', compact('project', 'buildingParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project): View
    {
        $buildingPartTypes = BuildingPartType::all();
        $materials = Material::all();
        $suppliers = Supplier::all();
        
        return view('building-parts.create', compact('project', 'buildingPartTypes', 'materials', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'building_part_type_id' => 'required|exists:building_part_types,id',
            'material_id' => 'required|exists:materials,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $project->buildingParts()->create([
            'name' => $request->name,
            'building_part_type_id' => $request->building_part_type_id,
            'material_id' => $request->material_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('projects.building-parts.index', $project)
            ->with('success', 'Building part created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, BuildingPart $buildingPart): View
    {
        $buildingPart->load(['buildingPartType', 'material', 'supplier']);
        return view('building-parts.show', compact('project', 'buildingPart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, BuildingPart $buildingPart): View
    {
        $buildingPartTypes = BuildingPartType::all();
        $materials = Material::all();
        $suppliers = Supplier::all();
        
        return view('building-parts.edit', compact('project', 'buildingPart', 'buildingPartTypes', 'materials', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, BuildingPart $buildingPart): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'building_part_type_id' => 'required|exists:building_part_types,id',
            'material_id' => 'required|exists:materials,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $buildingPart->update([
            'name' => $request->name,
            'building_part_type_id' => $request->building_part_type_id,
            'material_id' => $request->material_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('projects.building-parts.index', $project)
            ->with('success', 'Building part updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, BuildingPart $buildingPart): RedirectResponse
    {
        $buildingPart->delete();

        return redirect()->route('projects.building-parts.index', $project)
            ->with('success', 'Building part deleted successfully.');
    }
}