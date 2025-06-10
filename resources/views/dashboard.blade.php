@extends('layouts.apps')

@section('title', 'Dashboard - CLT Toolbox')
@section('page-title', 'Dashboard Overview')

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('projects.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
            <i class="fas fa-project-diagram mr-2"></i>
            View Projects
        </a>
    </div>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Projects Card -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Projects</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $projectsCount ?? 0 }}</h3>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-project-diagram text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('projects.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 inline-flex items-center">
                View all projects
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Building Part Types Card -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Building Part Types</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $buildingPartTypesCount ?? 0 }}</h3>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-shapes text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Types of building components</span>
        </div>
    </div>

    <!-- Materials Card -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Materials</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $materialsCount ?? 0 }}</h3>
            </div>
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-cubes text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Different material types</span>
        </div>
    </div>

    <!-- Suppliers Card -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Suppliers</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $suppliersCount ?? 0 }}</h3>
            </div>
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-truck text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">Vendors and suppliers</span>
        </div>
    </div>
</div>

<!-- Recent Projects and Info Pedia -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Recent Projects -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Recent Projects</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($recentProjects as $project)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $project->name }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-1.5"></i>
                                <span>Created {{ $project->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" 
                           class="text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">
                            View
                            <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <i class="fas fa-project-diagram text-3xl mb-3"></i>
                    <p>No projects found</p>
                </div>
            @endforelse
        </div>
        @if($recentProjects->count() > 0)
            <div class="px-6 py-4 border-t border-gray-200 text-right">
                <a href="{{ route('projects.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    View all projects
                </a>
            </div>
        @endif
    </div>

    <!-- Info Pedia -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">CLT Toolbox Info</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-900">About Building Parts</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            Building parts are components of your construction project. Each part has a type, material, and supplier.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="p-2 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-900">Quick Tip</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            Use consistent naming for your building parts to make them easier to find and manage.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="p-2 rounded-full bg-purple-100 text-purple-600">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-900">Statistics</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            You have {{ $buildingPartsCount ?? 0 }} building parts across all projects.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-blue-800">Need help?</h4>
                <p class="text-sm text-blue-700 mt-1">
                    Check our documentation or contact support if you have any questions.
                </p>
                <a href="https://wa.me/6288290320097" target="_blank" 
   class="mt-2 text-sm font-medium text-green-600 hover:text-green-800 inline-flex items-center">
    Hubungi Saya via WA
    <i class="fab fa-whatsapp ml-1"></i>
</a>

            </div>
        </div>
    </div>
</div>


@endsection