<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <!-- Header Section -->
        <div class="bg-gray-800 border-b border-gray-700 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-red-400 mb-2">Dashboard</h1>
                    <p class="text-lg text-gray-300">Welcome to your booking management system</p>
                </div>

                <!-- Notification Bell Button -->
                <div class="relative"
                     x-data="{ showNotifications: false, notifications: @json($notifications ?? []) }">
                    <button @click="showNotifications = !showNotifications"
                            class="relative p-2 rounded-full text-gray-300 hover:text-red-400 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <!-- Notification Dot -->
                        <template x-if="notifications.length > 0">
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                        </template>
                    </button>

                    <!-- Dropdown for Notifications -->
                    <div x-show="showNotifications"
                         @click.outside="showNotifications = false"
                         class="absolute right-0 mt-2 w-80 bg-gray-800 border border-gray-700 rounded-md shadow-lg z-50 overflow-hidden"
                         x-transition>
                        <div class="p-4 border-b font-semibold text-gray-300">
                            Booking Notifications
                        </div>
                        <ul class="max-h-60 overflow-y-auto divide-y divide-gray-600">
                            <template x-for="notification in notifications" :key="notification.id">
                                <li class="px-4 py-3 text-sm text-gray-300">
                                    <span class="font-medium text-gray-200" x-text="notification.user_name"></span>
                                    <span x-text="notification.action"></span>
                                    <br>
                                    <span class="text-xs text-gray-500" x-text="notification.time"></span>
                                </li>
                            </template>
                            <template x-if="notifications.length === 0">
                                <li class="px-4 py-3 text-sm text-gray-400 text-center">No new notifications.</li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl font-bold text-red-400 mb-2">{{ $totalBookings }}</div>
                    <div class="text-sm font-medium text-gray-300 uppercase tracking-wide">Total Bookings</div>
                </div>
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl font-bold text-red-400 mb-2">{{ $totalUsers }}</div>
                    <div class="text-sm font-medium text-gray-300 uppercase tracking-wide">Total Users</div>
                </div>
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl font-bold text-red-400 mb-2">{{ $userBookings }}</div>
                    <div class="text-sm font-medium text-gray-300 uppercase tracking-wide">Your Bookings</div>
                </div>
            </div>

            <!-- Recent Bookings Section -->
            <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 mb-8">
                <h2 class="text-2xl font-semibold text-white mb-6 flex items-center gap-3">
                    <div class="w-1 h-8 bg-red-500 rounded"></div>
                    Recent Bookings
                </h2>
                
                @if($recentBookings->count())
                    <div class="space-y-4">
                        @foreach($recentBookings as $booking)
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-white mb-2">{{ $booking->title }}</h3>
                                        <div class="flex items-center gap-2 text-sm text-gray-300 mb-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y - h:i A') }}
                                        </div>
                                        @if($booking->description)
                                            <p class="text-gray-300 text-sm">{{ $booking->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('bookings.edit', $booking) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('bookings.destroy', $booking) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors" onclick="return confirm('Are you sure you want to delete this booking?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">No bookings yet!</h3>
                        <p class="text-gray-400 mb-6">Start planning your schedule by creating your first booking.</p>
                        <a href="{{ route('bookings.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create New Booking
                        </a>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('bookings.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Booking
                </a>
                <a href="{{ route('bookings.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View All Bookings
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs" defer></script>

</x-app-layout>
