@extends('layouts.apps')

@section('title', $supplier->name . ' - CLT Toolbox')
@section('page-title', $supplier->name)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('suppliers.edit', $supplier) }}" 
           class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Edit
        </a>
        <a href="{{ route('suppliers.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Suppliers
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <div class="space-y-6">
            <!-- Supplier Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Supplier Overview</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Supplier Name</label>
                                        <p class="text-gray-900 font-medium">{{ $supplier->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Material Type</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $supplier->material_type === 'clt' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $supplier->material_type_display }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Supplier Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Name</label>
                                <p class="text-sm text-gray-900">{{ $supplier->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Material Type</label>
                                <p class="text-sm text-gray-900">{{ $supplier->material_type_display }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Quantity</label>
                                <p class="text-sm text-gray-900">{{ number_format($supplier->quantity) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Created At</label>
                                <p class="text-sm text-gray-900">{{ $supplier->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $supplier->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="border-t pt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('suppliers.edit', $supplier) }}" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Supplier
                        </a>
                    </div>
                    
                    <form action="{{ route('suppliers.destroy', $supplier) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Supplier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection