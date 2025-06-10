@extends('layouts.apps')

@section('title', 'Suppliers - CLT Toolbox')
@section('page-title', 'Suppliers')

@section('page-actions')
    <a href="{{ route('suppliers.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
        <i class="fas fa-plus mr-2"></i>
        New Supplier
    </a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow">
    <!-- Search Form -->
    <div class="p-4 border-b">
        <form action="{{ route('suppliers.index') }}" method="GET">
            <div class="flex items-center">
                <div class="relative flex-grow">
                    <input type="text" 
                           name="search" 
                           placeholder="Search by name or material type..." 
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <button type="submit" 
                        class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('suppliers.index') }}" 
                       class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Material Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($suppliers as $supplier)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $supplier->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $supplier->material_type === 'clt' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $supplier->material_type_display }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ number_format($supplier->quantity) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('suppliers.show', $supplier) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-sm">
                                    View
                                </a>
                                <a href="{{ route('suppliers.edit', $supplier) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-truck text-4xl mb-4"></i>
                                <p class="text-lg font-medium">No suppliers found</p>
                                @if(request('search'))
                                    <p class="text-sm">No results found for "{{ request('search') }}".</p>
                                @else
                                    <p class="text-sm">Get started by creating your first supplier.</p>
                                @endif
                                <a href="{{ route('suppliers.create') }}" 
                                   class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create Supplier
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($suppliers->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $suppliers->appends(['search' => request('search')])->links() }}
        </div>
    @endif
</div>
@endsection