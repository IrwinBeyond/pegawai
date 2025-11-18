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

                <a href="{{ url('/dashboard') }}" class="flex items-center space-x-2 transition-all duration-300">
                    <div class="text-white px-4 py-2 font-bold text-2xl hover:scale-105 transition-all duration-300 italic ease-in-out">
                        PEGAWAI
                    </div>
                </a>

                @auth
                <div class="flex items-center gap-4">
                    <nav>
                        <ul class="flex space-x-1">
                            @if (auth()->user()->role === 'admin')
                                <li>
                                    <a href="{{ route('admin.employees.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('admin/employees*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Employee
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.departments.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('admin/departments*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Department
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.attendances.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('admin/attendances*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Attendance
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.positions.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('admin/positions*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Position
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.salaries.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('admin/salaries*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Salary
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->role === 'employee')
                                <li>
                                    <a href="{{ route('employee.home') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('employee/') ? 'font-bold' : 'hover:font-bold' }}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.attendances.index') }}"
                                       class="block px-4 py-2 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-blue-700
                                           {{ request()->is('employee/attendances*') ? 'font-bold' : 'hover:font-bold' }}">
                                        Attendance
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg transition-all duration-300 ease-in-out hover:bg-red-700 hover:shadow-md">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth

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
