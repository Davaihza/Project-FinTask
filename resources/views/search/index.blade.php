<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTask - Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
        }
        .sidebar {
            height: 100vh;
            width: 80px;
            background-color: #FFFFFF;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
            transition: width 0.3s ease-in-out;
            overflow: hidden;
        }
        .sidebar.expanded {
            width: 280px;
        }
        .sidebar .nav-item-text {
            margin-left: 10px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, max-width 0.3s ease-in-out;
            white-space: nowrap;
            overflow: hidden;
            max-width: 0;
        }
        .sidebar.expanded .nav-item-text {
            opacity: 1;
            max-width: 200px;
        }
        .sidebar nav a,
        .sidebar nav button,
        .sidebar .mt-auto {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .sidebar:not(.expanded) nav a,
        .sidebar:not(.expanded) nav button,
        .sidebar:not(.expanded) .mt-auto {
            justify-content: center;
        }
        .sidebar.expanded nav a,
        .sidebar.expanded nav button,
        .sidebar.expanded .mt-auto {
            justify-content: flex-start;
            padding-left: 20px;
            padding-right: 20px;
        }
        .main-content {
            background-color: #F8F9FA;
        }
        .card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar flex flex-col items-center justify-between py-6">
            <div class="mb-8 flex items-center justify-center w-full px-2">
                <!-- Logo -->
                <img src="{{ asset('images/logo_zerotwo_dashboard.png') }}" alt="FinTask Logo" class="w-12 h-12 object-contain flex-shrink-0">
                <span class="text-xl font-bold text-gray-800 ml-2 nav-item-text"></span>
            </div>
            <nav class="flex flex-col space-y-6 w-full items-center flex-grow">
                <!-- Hamburger Menu Toggle Button -->
                <button id="sidebarToggle" class="p-2 rounded-lg bg-blue-100 text-blue-600 flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <span class="nav-item-text"></span>
                </button>
                <!-- Nav Icons -->
                <a href="{{ route('dashboard') }}" class="p-2 rounded-lg flex items-center {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-600' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354l-7.793 7.793A1 1 0 003.293 13H4a1 1 0 011 1v5a1 1 0 001 1h2a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h2a1 1 0 001-1v-5a1 1 0 00-.293-.707L12 4.354z"></path></svg>
                    <span class="nav-item-text">Dashboard</span>
                </a>
                <a href="{{ route('tasks.index') }}" class="p-2 rounded-lg flex items-center {{ request()->routeIs('tasks.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span class="nav-item-text">Tasks</span>
                </a>
                <a href="{{ route('financial-records.index') }}" class="p-2 rounded-lg flex items-center {{ request()->routeIs('financial-records.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="nav-item-text">Financial Records</span>
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-8 main-content overflow-y-auto">
            <!-- Header -->
            <header class="flex justify-between items-center pb-8 border-b border-gray-200 mb-8">
                <div class="flex items-center space-x-4">
                    <form action="{{ route('search.index') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Search..." value="{{ $query ?? '' }}" class="pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                    <div class="text-gray-600 text-sm">{{ \Carbon\Carbon::now()->format('M d, Y') }}</div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-full bg-white shadow-sm hover:bg-gray-50">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <button class="p-2 rounded-full bg-white shadow-sm hover:bg-gray-50">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/40' }}" alt="User Avatar" class="w-10 h-10 rounded-full border border-gray-200 object-cover">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email ?? 'user@example.com' }}</p>
                        </div>
                    </a>
                </div>
            </header>

            <!-- Search Results -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    @if(isset($query))
                        Search Results for "{{ $query }}"
                    @else
                        Search
                    @endif
                </h1>
                @if(isset($query))
                    <p class="text-gray-600">
                        Found {{ $tasks->count() + $financialRecords->count() }} results
                    </p>
                @endif
            </div>

            @if(isset($query) && $tasks->isEmpty() && $financialRecords->isEmpty())
                <div class="bg-white p-8 rounded-lg shadow text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">No results found</h3>
                    <p class="text-gray-600">Try searching with different keywords</p>
                </div>
            @endif

            <!-- Tasks Results -->
            @if($tasks->isNotEmpty())
                <div class="bg-white p-6 rounded-lg shadow mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Tasks ({{ $tasks->count() }})
                    </h2>
                    <div class="space-y-3">
                        @foreach($tasks as $task)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800">{{ $task->name }}</h3>
                                        @if($task->description)
                                            <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                                        @endif
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            @if($task->due_date)
                                                <span>Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                                            @endif
                                            <span class="px-2 py-1 rounded-full text-xs {{ $task->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Financial Records Results -->
            @if($financialRecords->isNotEmpty())
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Financial Records ({{ $financialRecords->count() }})
                    </h2>
                    <div class="space-y-3">
                        @foreach($financialRecords as $record)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800">
                                            {{ $record->description ?: 'No description' }}
                                        </h3>
                                        <div class="flex items-center space-x-4 mt-2 text-sm">
                                            <span class="font-medium {{ $record->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                                Rp{{ number_format($record->amount, 2, ',', '.') }}
                                            </span>
                                            <span class="px-2 py-1 rounded-full text-xs {{ $record->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($record->type) }}
                                            </span>
                                            <span class="text-gray-500">
                                                {{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('financial-records.show', $record->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('expanded');
            });
        });
    </script>
</body>
</html>
