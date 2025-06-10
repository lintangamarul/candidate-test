@extends('layouts.apps')

@section('title', $buildingPart->name . ' - ' . $project->name . ' - CLT Toolbox')
@section('page-title', $buildingPart->name)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('projects.building-parts.edit', [$project, $buildingPart]) }}" 
           class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Edit
        </a>
        <a href="{{ route('projects.building-parts.index', $project) }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Building Parts
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <div class="space-y-6">
            <!-- Building Part Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Building Part Details</h3>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Name</label>
                                        <p class="text-sm text-gray-900">{{ $buildingPart->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Type</label>
                                        <p class="text-sm text-gray-900">{{ $buildingPart->buildingPartType->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Material</label>
                                        <p class="text-sm text-gray-900">{{ $buildingPart->material->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Supplier</label>
                                        <p class="text-sm text-gray-900">{{ $buildingPart->supplier->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Project Information</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Project Name</label>
                                        <p class="text-sm text-gray-900">{{ $project->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Project Description</label>
                                        <p class="text-sm text-gray-900">{{ $project->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Building Part Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Building Part Name</label>
                                <p class="text-sm text-gray-900">{{ $buildingPart->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Created At</label>
                                <p class="text-sm text-gray-900">{{ $buildingPart->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $buildingPart->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="border-t pt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('projects.building-parts.edit', [$project, $buildingPart]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Building Part
                        </a>
                    </div>
                    
                    <form action="{{ route('projects.building-parts.destroy', [$project, $buildingPart]) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this building part? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Building Part
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection