<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $query = Project::where('user_id', Auth::id());
    
    // Tambahkan pencarian jika ada parameter search
    if ($request->filled('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }
    
    $projects = $query->latest()->paginate(10);
    
    return view('projects.index', compact('projects'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Tambahkan user_id saat membuat project baru
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        // Pastikan user hanya bisa melihat project miliknya
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this project.');
        }

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        // Pastikan user hanya bisa edit project miliknya
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this project.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        // Pastikan user hanya bisa update project miliknya
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this project.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        // Pastikan user hanya bisa delete project miliknya
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this project.');
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
     }
}
