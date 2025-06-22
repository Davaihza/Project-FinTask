<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTask - Edit Profile</title>
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
                <h1 class="text-3xl font-bold text-gray-800">Edit Profile</h1>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6 flex items-center">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/80' }}" alt="Avatar" class="w-20 h-20 rounded-full border mr-4 object-cover">
                        <div>
                            <label for="avatar" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture:</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('avatar')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Profile</button>
                        <a href="{{ route('profile.show') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
                    </div>
                </form>
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
