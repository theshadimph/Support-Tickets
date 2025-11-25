<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket System</title>
    {{-- Load Tailwind CSS via CDN for quick styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Load Inter Font --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <svg class="h-8 w-8 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 01-3.07-3.07L1.25 12l2.846-.813a4.5 4.5 0 013.07-3.07L9 5.25l.813 2.846a4.5 4.5 0 013.07 3.07L16.75 12l-2.846.813a4.5 4.5 0 01-3.07 3.07zM18.25 21l-1.423-4.981a3 3 0 00-2.18-2.18L12 16.75l4.981 1.423a3 3 0 002.18 2.18L21 21l-1.423 4.981a3 3 0 00-2.18 2.18L12 28.75l-4.981 1.423a3 3 0 00-2.18 2.18L1 33l1.423-4.981a3 3 0 002.18-2.18L7 22.75l-1.423-4.981a3 3 0 00-2.18-2.18L1 12l4.981-1.423a3 3 0 002.18-2.18L7 2.75l-1.423-4.981a3 3 0 00-2.18-2.18L1 12z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                {{-- Navigation Links are controlled by the nav-link component --}}
                                @auth
                                    <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                    <x-nav-link href="/tickets" :active="request()->is('tickets*')">Tickets</x-nav-link>
                                    @if (auth()->user()->isManager())
                                        <x-nav-link href="/users" :active="request()->is('users')">All Users</x-nav-link>
                                    @endif
                                    @if (auth()->user()->isManager() || auth()->user()->isEmployee())
                                        <x-nav-link href="/team" :active="request()->is('team')">Team</x-nav-link>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @auth
                                <div class="text-sm font-medium text-gray-300">
                                    {{ auth()->user()->first_name }} ({{ ucfirst(auth()->user()->role) }})
                                </div>
                                <form method="POST" action="/logout" class="ml-4">
                                    @csrf
                                    <button class="text-sm font-medium text-gray-400 hover:text-white transition duration-150 ease-in-out">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="/login" class="text-sm font-medium text-gray-300 hover:text-white transition duration-150 ease-in-out mr-4">Login</a>
                                <a href="/register" class="text-sm font-medium text-gray-300 hover:text-white transition duration-150 ease-in-out">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
