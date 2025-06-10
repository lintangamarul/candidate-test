@extends('layouts.apps')

@section('title', $material->name . ' - CLT Toolbox')
@section('page-title', $material->name)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('materials.edit', $material) }}" 
           class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Edit
        </a>
        <a href="{{ route('materials.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Materials
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <div class="space-y-6">
            <!-- Material Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $material->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Material Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Name</label>
                                <p class="text-sm text-gray-900">{{ $material->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Quantity</label>
                                <p class="text-sm text-gray-900">{{ number_format($material->quantity) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Created At</label>
                                <p class="text-sm text-gray-900">{{ $material->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $material->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="border-t pt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('materials.edit', $material) }}" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Material
                        </a>
                    </div>
                    
                    <form action="{{ route('materials.destroy', $material) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this material? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Material
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection