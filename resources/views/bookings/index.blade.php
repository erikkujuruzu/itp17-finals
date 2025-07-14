<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <!-- Header Section -->
        <div class="bg-gray-800 border-b border-gray-700 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-blue-400 mb-2">My Bookings</h1>
                    <p class="text-lg text-gray-300">Manage and view all your bookings</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $totalBookings }}</div>
                    <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Total Bookings</div>
                </div>
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $upcomingBookings }}</div>
                    <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Upcoming</div>
                </div>
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $pastBookings }}</div>
                    <div class="text-sm font-medium text-gray-400 uppercase tracking-wide">Past</div>
                </div>
            </div>

            <!-- List View -->
            <div>
                @if($bookings->count() > 0)
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold text-white mb-2">{{ $booking->title }}</h3>
                                        <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y - h:i A') }}
                                        </div>
                                        @if($booking->description)
                                            <p class="text-gray-300">{{ $booking->description }}</p>
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
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors" onclick="return confirm('Are you sure you want to delete this booking?')">
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
                        <h3 class="text-xl font-semibold text-white mb-2">No bookings found!</h3>
                        <p class="text-gray-400 mb-6">Start by creating your first booking.</p>
                        <a href="{{ route('bookings.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create New Booking
                        </a>
                    </div>
                @endif
            </div>

           
        </div>
    </div>

    
</x-app-layout>
