@extends('layouts.apps')

@section('title', $project->name . ' - Building Parts - CLT Toolbox')
@section('page-title', 'Project Details')

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('projects.building-parts.create', $project) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add Building Part
        </a>
        <a href="{{ route('projects.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Projects
        </a>
    </div>
@endsection

@section('content')
<!-- Project Information -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6">
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Project Name</h3>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-900">{{ $project->name }}</p>
            </div>
        </div>
        
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Project Description</h3>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-700">{{ $project->description }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Building Parts Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Building Parts</h3>
            <a href="{{ route('projects.building-parts.create', $project) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Building Part
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Material
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Supplier
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($buildingParts as $index => $buildingPart)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $buildingParts->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $buildingPart->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">
                                {{ $buildingPart->buildingPartType->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">
                                {{ $buildingPart->material->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">
                                {{ $buildingPart->supplier->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('projects.building-parts.show', [$project, $buildingPart]) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-sm">
                                    View
                                </a>
                                <a href="{{ route('projects.building-parts.edit', [$project, $buildingPart]) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('projects.building-parts.destroy', [$project, $buildingPart]) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this building part?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-hammer text-4xl mb-4"></i>
                                <p class="text-lg font-medium">No building parts found</p>
                                <p class="text-sm">Get started by adding your first building part.</p>
                                <a href="{{ route('projects.building-parts.create', $project) }}" 
                                   class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Building Part
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($buildingParts->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $buildingParts->links() }}
        </div>
    @endif
</div>
@endsection