<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTask Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
        }
        .sidebar {
            height: 100vh; /* Ensure sidebar takes full viewport height */
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

            <!-- Dashboard Content -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Welcome Card -->
                <div class="card p-6 lg:col-span-2 flex flex-col md:flex-row items-center justify-between relative overflow-visible">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Hi, {{ $user->name ?? 'User' }}!</h2>
                        <p class="text-gray-600 mb-4 text-lg">Here's your task summary:</p>
                        <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-base text-gray-700">
                            <div class="flex items-center space-x-2"><span class="text-blue-500 text-xl">&#8226;</span> Total Tasks: {{ $totalTasksCount }}</div>
                            <div class="flex items-center space-x-2"><span class="text-green-500 text-xl">&#8226;</span> Completed Tasks: {{ $completedTasksCount }}</div>
                            <div class="flex items-center space-x-2"><span class="text-yellow-500 text-xl">&#8226;</span> Pending Tasks: {{ $pendingTasksCount }}</div>
                            <div class="flex items-center space-x-2"><span class="text-red-500 text-xl">&#8226;</span> Overdue Tasks: {{ $overdueTasksCount }}</div> {{-- Placeholder for future overdue task logic --}}
                        </div>
                    </div>
                    <div class="flex-1 flex justify-center items-center relative">
                        <img src="{{ asset('images/zerotwo.png') }}" alt="Zero Two Illustration" class="w-98 h-98 object-contain -mt-40">
                    </div>
                </div>

                <!-- Notifications -->
                <div class="card p-6 flex flex-col space-y-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-semibold text-gray-800">Notifications</h3>
                        <a href="{{ route('tasks.index') }}" class="text-blue-500 text-sm hover:underline">See all</a>
                    </div>

                    @if ($pendingTasksForNotification || $overdueTasksForNotification || $completedTasksForNotification)
                        @if ($pendingTasksForNotification)
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-yellow-50 bg-opacity-75">
                        <span class="flex items-center justify-center w-8 h-8 bg-yellow-200 rounded-full text-yellow-700 font-bold text-lg">!</span>
                                <p class="text-sm text-gray-700">Pending: {{ $pendingTasksForNotification->name }} {{ $pendingTasksForNotification->due_date ? ' (Due: ' . \Carbon\Carbon::parse($pendingTasksForNotification->due_date)->format('M d') . ')' : '' }}</p>
                                <a href="{{ route('tasks.index', ['task_status' => 'pending']) }}" class="ml-auto text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                        @endif

                        @if ($overdueTasksForNotification)
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-red-50 bg-opacity-75">
                        <span class="flex items-center justify-center w-8 h-8 bg-red-200 rounded-full text-red-700 font-bold text-lg">!</span>
                                <p class="text-sm text-gray-700">Overdue: {{ $overdueTasksForNotification->name }} (Due: {{ \Carbon\Carbon::parse($overdueTasksForNotification->due_date)->format('M d') }})</p>
                                <a href="{{ route('tasks.index', ['task_status' => 'pending']) }}" class="ml-auto text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                        @endif

                        @if ($completedTasksForNotification)
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-blue-50 bg-opacity-75">
                                <span class="flex items-center justify-center w-8 h-8 bg-blue-200 rounded-full text-blue-700 font-bold text-lg">✔</span>
                                <p class="text-sm text-gray-700">Completed: {{ $completedTasksForNotification->name }} {{ $completedTasksForNotification->due_date ? ' (Due: ' . \Carbon\Carbon::parse($completedTasksForNotification->due_date)->format('M d') . ')' : '' }}</p>
                                <a href="{{ route('tasks.index', ['task_status' => 'completed']) }}" class="ml-auto text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                        @endif
                    @else
                        <p class="text-gray-700">No tasks to display in notifications.</p>
                    @endif
                </div>

                <!-- Financial/Task Summary Cards -->
                <div class="card p-6 flex flex-col items-start">
                    <div class="flex justify-between items-center w-full mb-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 8v4m-6 0h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h12v2H6a2 2 0 01-2-2v-4H2"></path></svg>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Income</p>
                    <p class="text-3xl font-bold text-gray-800">Rp{{ number_format($totalIncome, 2, ',', '.') }}</p>
                </div>

                <div class="card p-6 flex flex-col items-start">
                    <div class="flex justify-between items-center w-full mb-4">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Expense</p>
                    <p class="text-3xl font-bold text-gray-800">Rp{{ number_format($totalExpense, 2, ',', '.') }}</p>
                </div>

                <div class="card p-6 flex flex-col items-start">
                    <div class="flex justify-between items-center w-full mb-4">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.5v11M17.5 12H6.5"></path></svg>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Balance</p>
                    <p class="text-3xl font-bold text-gray-800">Rp{{ number_format($netBalance, 2, ',', '.') }}</p>
                </div>
            </div>

            <!-- Latest Tasks Section -->
            <div class="card p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Latest Tasks</h3>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-2">
                            <label for="task_status_filter" class="text-sm text-gray-600">Filter by Status:</label>
                            <select name="task_status" id="task_status_filter" class="border border-gray-300 rounded-md p-1 text-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                                <option value="" {{ request('task_status') == '' ? 'selected' : '' }}>All</option>
                                <option value="completed" {{ request('task_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ request('task_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </form>
                    <a href="{{ route('tasks.index') }}" class="text-blue-500 text-sm hover:underline">See all tasks</a>
                    </div>
                </div>
                @if ($latestTasks->isEmpty())
                    <p class="text-gray-700">No tasks found. Add a new task to see it here.</p>
                @else
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Completed
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestTasks as $task)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-gray-900 hover:text-blue-600 hover:underline">{{ $task->name }}</a>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if($task->is_completed)
                                            <span class="inline-block px-3 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">Yes</span>
                                        @else
                                            <span class="inline-block px-3 py-1 rounded-full bg-red-200 text-red-800 font-semibold text-sm">No</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Latest Financial Records Section -->
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Latest Financial Records</h3>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-2">
                            <label for="record_type_filter" class="text-sm text-gray-600">Filter by Type:</label>
                            <select name="record_type" id="record_type_filter" class="border border-gray-300 rounded-md p-1 text-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                                <option value="" {{ request('record_type') == '' ? 'selected' : '' }}>All</option>
                                <option value="income" {{ request('record_type') == 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ request('record_type') == 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </form>
                    <a href="{{ route('financial-records.index') }}" class="text-blue-500 text-sm hover:underline">See all records</a>
                    </div>
                </div>
                @if ($latestFinancialRecords->isEmpty())
                    <p class="text-gray-700">No financial records found. Add a new record to see it here.</p>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestFinancialRecords as $record)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="{{ route('financial-records.show', $record->id) }}" class="text-gray-900 hover:text-blue-600 hover:underline">{{ $record->description ?? 'N/A' }}</a>
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
