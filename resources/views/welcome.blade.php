<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - App Pegawai</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/pegawai-logo.png') }}">
    @vite('resources/css/app.css')
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <div class="mb-12 animate-fade-in">
                <h1 class="text-7xl font-bold text-white italic mb-4 drop-shadow-2xl">
                    PEGAWAI
                </h1>
                <p class="text-blue-100 text-xl">Employee Management System</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 max-w-6xl mx-auto">     
                <a href="{{ url('/admin/employees') }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="bg-blue-100 p-4 rounded-full group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-12 h-12 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Employee</h3>
                                <p class="text-gray-500 text-sm mt-1">Manage Employees</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/departments') }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="bg-blue-100 p-4 rounded-full group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-12 h-12 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Department</h3>
                                <p class="text-gray-500 text-sm mt-1">Manage Departments</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/attendances') }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="bg-blue-100 p-4 rounded-full group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-12 h-12 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Attendance</h3>
                                <p class="text-gray-500 text-sm mt-1">Track Attendance</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/positions') }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="bg-blue-100 p-4 rounded-full group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-12 h-12 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Position</h3>
                                <p class="text-gray-500 text-sm mt-1">Manage Positions</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/admin/salaries') }}" class="group">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="bg-blue-100 p-4 rounded-full group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-12 h-12 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Salary</h3>
                                <p class="text-gray-500 text-sm mt-1">Manage Salaries</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mt-12">
                <p class="text-blue-100 text-sm">
                    &copy; {{ date('Y') }} App Pegawai. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>