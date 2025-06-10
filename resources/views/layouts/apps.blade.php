<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CLT Toolbox')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <div class="p-6">
                <h1 class="text-xl font-bold text-gray-800">CLT Toolbox</h1>
            </div>
            
            <!-- Main Navigation -->
            <nav class="mt-6 flex-1">
                <div class="px-6 py-2">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Menu</div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('dashboard') }}" 
                    class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('dashboard.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                </div>
                <div class="mt-2">
                    <a href="{{ route('projects.index') }}" 
                       class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('projects.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="fas fa-folder mr-3"></i>
                        Projects
                    </a>
                </div>
                <div class="mt-2">
                    <a href="{{ route('building-part-types.index') }}" 
                       class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('building-part-types.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="fas fa-building mr-3"></i>
                        Building Part Type
                    </a>
                </div>
                <div class="mt-2">
                    <a href="{{ route('materials.index') }}" 
                       class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('materials.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="fas fa-cube mr-3"></i>
                        Material
                    </a>
                </div>
                <div class="mt-2">
                    <a href="{{ route('suppliers.index') }}" 
                       class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('suppliers.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                        <i class="fas fa-truck mr-3"></i>
                        Suppliers
                    </a>
                </div>
            </nav>

            <!-- Profile & Logout Section -->
            <div class="border-t border-gray-200 p-4">
                <div class="px-2 py-2">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Account</div>
                </div>
                
                <div class="mt-2 space-y-1">
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fas fa-user mr-3"></i>
                        Profile
                    </a>
                    
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md text-left"
                                onclick="return confirm('Are you sure you want to log out?')">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Projects')</h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- User Info in Header (Optional) -->
                            <div class="hidden md:block">
                                <span class="text-sm text-gray-600">Welcome, {{ Auth::user()->name ?? 'User' }}</span>
                            </div>
                            @yield('page-actions')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Close alert messages
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                const closeBtn = alert.querySelector('button');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        alert.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>