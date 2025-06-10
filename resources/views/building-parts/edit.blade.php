@extends('layouts.apps')

@section('title', 'Edit ' . $buildingPart->name . ' - ' . $project->name . ' - CLT Toolbox')
@section('page-title', 'Edit Building Part: ' . $buildingPart->name)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('projects.building-parts.show', [$project, $buildingPart]) }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-eye mr-2"></i>
            View Building Part
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
        <form action="{{ route('projects.building-parts.update', [$project, $buildingPart]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Building Part Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Building Part Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $buildingPart->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                           placeholder="Enter building part name"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Building Part Type -->
                <div>
                    <label for="building_part_type_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Type <span class="text-red-500">*</span>
                    </label>
                    <select name="building_part_type_id" 
                            id="building_part_type_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('building_part_type_id') border-red-500 @enderror"
                            required>
                        <option value="">Select building part type</option>
                        @foreach($buildingPartTypes as $type)
                            <option value="{{ $type->id }}" {{ old('building_part_type_id', $buildingPart->building_part_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('building_part_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Material -->
                <div>
                    <label for="material_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Material <span class="text-red-500">*</span>
                    </label>
                    <select name="material_id" 
                            id="material_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('material_id') border-red-500 @enderror"
                            required>
                        <option value="">Select material</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ old('material_id', $buildingPart->material_id) == $material->id ? 'selected' : '' }}>
                                {{ $material->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('material_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Supplier <span class="text-red-500">*</span>
                    </label>
                    <select name="supplier_id" 
                            id="supplier_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('supplier_id') border-red-500 @enderror"
                            required>
                        <option value="">Select supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $buildingPart->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Building Part Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Building Part Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Created:</span> {{ $buildingPart->created_at->format('M d, Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Last Updated:</span> {{ $buildingPart->updated_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                    <a href="{{ route('projects.building-parts.show', [$project, $buildingPart]) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium">
                        Update Building Part
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection