<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="text-xl font-semibold text-gray-700">
                    <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-gray-700">FinanceApp</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    @foreach ($dynamicMenus as $menu)
                    @if($menu->cName === 'Master')
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-600 hover:text-blue-500 focus:outline-none">
                            {{ $menu->cName }} <svg class="h-4 w-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <a href="{{ route('users.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Users</a>
                            <a href="{{ route('roles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Roles</a>
                            <a href="{{ route('permissions.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Permissions</a>
                        </div>
                    </div>
                    @elseif($menu->cName === 'Sales')
                    <a href="{{ route('sales-orders.index') }}" class="text-gray-600 hover:text-blue-500">{{ $menu->cName }}</a>
                    @elseif($menu->cName === 'Purchasing')
                    <a href="{{ route('purchase-orders.index') }}" class="text-gray-600 hover:text-blue-500">{{ $menu->cName }}</a>
                    @elseif($menu->cName === 'Cash/Bank')
                    <a href="{{ route('cash-bank-transactions.index') }}" class="text-gray-600 hover:text-blue-500">{{ $menu->cName }}</a>
                    @else
                    <a href="#" class="text-gray-600 hover:text-blue-500">{{ $menu->cName }}</a>
                    @endif
                    @endforeach

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-blue-500">Logout</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>

</html>