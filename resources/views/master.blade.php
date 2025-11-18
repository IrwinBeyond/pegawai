<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/pegawai-logo.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <header class="bg-blue-600 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 transition-all duration-300">
                    <div class="text-white px-4 py-2 font-bold text-2xl hover:scale-105 transition-all duration-300 italic ease-in-out">
                        PEGAWAI
                    </div>
                </a>
                
                <nav>
                    <ul class="flex space-x-1">
                        <li>
                            <a href="{{ url('/admin/employees') }}" 
                               class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:font-bold {{ request()->is('employees*') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700 hover:shadow-md' }}">
                                Employee
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/departments') }}" 
                               class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:font-bold {{ request()->is('departments*') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700 hover:shadow-md' }}">
                                Department
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/attendances') }}" 
                               class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:font-bold {{ request()->is('attendances*') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700 hover:shadow-md' }}">
                                Attendance
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/positions') }}" 
                               class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:font-bold {{ request()->is('positions*') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700 hover:shadow-md' }}">
                                Position
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/salaries') }}" 
                               class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:font-bold {{ request()->is('salaries*') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700 hover:shadow-md' }}">
                                Salary
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center text-gray-600 text-sm">
                &copy; {{ date('Y') }} App Pegawai. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>