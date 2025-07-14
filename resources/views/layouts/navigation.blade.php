<nav x-data="{ open: true }" class="fixed top-0 left-0 h-full transition-all duration-300 ease-in-out bg-white border-r border-gray-200 shadow-md z-50" :class="{ 'w-64': open, 'w-20': !open }">
    <div class="flex flex-col h-full">
        <!-- Collapse Toggle -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200">
            <span class="text-xl font-bold text-gray-600 tracking-tight" x-show="open" style="font-family: 'Inter', sans-serif;">Booking</span>
            <button @click="open = !open" class="p-2 text-gray-500 hover:text-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
        </div>

        <!-- Nav Links -->
        <div class="flex-1 overflow-y-auto py-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="nav-link flex items-center space-x-2 px-4 py-2" :class="{ 'justify-center': !open }">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span x-show="open">Dashboard</span>
            </a>
            <a href="{{ route('bookings.index') }}" class="nav-link flex items-center space-x-2 px-4 py-2" :class="{ 'justify-center': !open }">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span x-show="open">My Bookings</span>
            </a>
            <a href="{{ route('bookings.create') }}" class="nav-link flex items-center space-x-2 px-4 py-2" :class="{ 'justify-center': !open }">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span x-show="open">New Booking</span>
            </a>
        </div>

        <!-- User Profile Section -->
        <div class="border-t border-gray-100 px-4 py-4">
            <div class="flex items-center space-x-3" :class="{ 'justify-center': !open }">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-600 text-white font-semibold text-lg" style="font-family: 'Inter', sans-serif;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
                <span x-show="open" class="text-gray-700 text-sm font-medium" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->name }}</span>
            </div>
            <div x-show="open" class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .nav-link {
            color: #6b7280;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
        }

        .nav-link:hover,
        .nav-link.active {
            color: black;
            background-color: #f3f4f6;
            border-radius: 0.5rem;
        }
    </style>
</nav>
