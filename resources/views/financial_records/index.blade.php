<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTask - Financial Records</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
        }
        .sidebar {
            width: 80px; /* Collapsed width */
            background-color: #FFFFFF;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
            transition: width 0.3s ease-in-out; /* Add transition for smooth animation */
            overflow: hidden; /* Hide overflowing content when collapsed */
        }
        .sidebar.expanded {
            width: 280px; /* Expanded width, adjust as needed */
        }
        .sidebar .nav-item-text {
            margin-left: 10px; /* Space between icon and text */
            opacity: 0;
            transition: opacity 0.3s ease-in-out, max-width 0.3s ease-in-out; /* Add transition for smooth text fade and width */
            white-space: nowrap;
            overflow: hidden; /* Hide overflowing text */
            max-width: 0; /* Collapse text by default */
        }
        .sidebar.expanded .nav-item-text {
            opacity: 1;
            max-width: 200px; /* Max width for text when expanded */
        }
        .sidebar nav a,
        .sidebar nav button,
        .sidebar .mt-auto {
            display: flex; /* Allow icon and text to be in a row */
            align-items: center;
            width: 100%; /* Take full width for padding */
        }
        .sidebar:not(.expanded) nav a,
        .sidebar:not(.expanded) nav button,
        .sidebar:not(.expanded) .mt-auto {
            justify-content: center; /* Center horizontally when collapsed */
        }
        .sidebar.expanded nav a,
        .sidebar.expanded nav button,
        .sidebar.expanded .mt-auto {
            justify-content: flex-start; /* Align to start when expanded */
            padding-left: 20px; /* Add padding when expanded */
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
                <img src="{{ asset('images/logo_zerotwo_dashboard.png') }}" alt="FinTask Logo" class="w-20 h-20 object-contain flex-shrink-0">
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
                        <input type="text" name="q" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                    <div class="text-gray-600 text-sm">{{ \Carbon\Carbon::now()->format('M d, Y') }}</div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/40' }}" alt="User Avatar" class="w-10 h-10 rounded-full border border-gray-200 object-cover">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email ?? 'user@example.com' }}</p>
                        </div>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Financial Records List</h1>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('financial-records.index') }}" method="GET" class="flex items-center space-x-2">
                        <label for="record_type_filter" class="text-sm text-gray-600">Filter by Type:</label>
                        <select name="record_type" id="record_type_filter" class="border border-gray-300 rounded-md p-1 text-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                            <option value="" {{ request('record_type') == '' ? 'selected' : '' }}>All</option>
                            <option value="income" {{ request('record_type') == 'income' ? 'selected' : '' }}>Income</option>
                            <option value="expense" {{ request('record_type') == 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </form>
                <a href="{{ route('financial-records.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    Add New Record
                </a>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow overflow-x-auto">
                @if ($financialRecords->isEmpty())
                    <p class="text-gray-700">No financial records found. Click "Add New Record" to create one.</p>
                @else
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($financialRecords as $record)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $record->description ?? 'N/A' }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">Rp{{ number_format($record->amount, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if($record->type === 'income')
                                            <span class="inline-block px-3 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">Income</span>
                                        @else
                                            <span class="inline-block px-3 py-1 rounded-full bg-red-200 text-red-800 font-semibold text-sm">Expense</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="{{ route('financial-records.show', $record->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="{{ route('financial-records.edit', $record->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('financial-records.destroy', $record->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const navItemTexts = document.querySelectorAll('.nav-item-text');

            // Initial state: hide texts
            navItemTexts.forEach(span => {
                span.style.opacity = '0';
                span.style.display = 'none';
            });

            // Make sure the logo text is initially hidden too
            const logoText = document.querySelector('#sidebar .text-xl.font-bold');
            if (logoText) {
                logoText.style.opacity = '0';
                logoText.style.display = 'none';
            }

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('expanded');

                if (sidebar.classList.contains('expanded')) {
                    // Show text with a slight delay for animation
                    setTimeout(() => {
                        navItemTexts.forEach(span => {
                            span.style.display = 'inline-block';
                            setTimeout(() => span.style.opacity = '1', 0); // Trigger transition
                        });
                        if (logoText) {
                            logoText.style.display = 'inline-block';
                            setTimeout(() => logoText.style.opacity = '1', 0); // Trigger transition
                        }
                    }, 100); // Delay for sidebar width transition
                } else {
                    // Hide text immediately for better effect
                    navItemTexts.forEach(span => {
                        span.style.opacity = '0';
                        span.style.display = 'none';
                    });
                    if (logoText) {
                        logoText.style.opacity = '0';
                        logoText.style.display = 'none';
                    }
                }
            });
        });
    </script>
</body>
</html>
