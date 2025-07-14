<x-app-layout>  
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-black text-white">
        <!-- Header Section -->
        <div class="bg-gray-800 border-b border-gray-700 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-blue-500 mb-2">Edit Booking</h1>
                    <p class="text-lg text-gray-300">Update your booking details</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-8">
                <!-- Update Form -->
                <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Booking Details -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Booking Details
                            </h3>
                            
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $booking->title) }}" 
                                       class="w-full px-3 py-2 bg-black text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('title')
                                    <p class="text-blue-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                                <textarea id="description" name="description" rows="4" 
                                          class="w-full px-3 py-2 bg-black text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $booking->description) }}</textarea>
                                @error('description')
                                    <p class="text-blue-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date & Time Selection -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Schedule
                            </h3>
                            
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                                <input type="date" id="booking_date" name="booking_date" 
                                       value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) }}" 
                                       class="w-full px-3 py-2 bg-black text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                @error('booking_date')
                                    <p class="text-blue-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-300 mb-2">Time</label>
                                <select id="booking_time" name="booking_time" 
                                        class="w-full px-3 py-2 bg-black text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Select a time</option>
                                    @php
                                        $currentTime = \Carbon\Carbon::parse($booking->booking_time)->format('H:i');
                                    @endphp
                                    @foreach(['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'] as $time)
                                        <option value="{{ $time }}" {{ old('booking_time', $currentTime) == $time ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('g:i A') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('booking_time')
                                    <p class="text-blue-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                        <div class="flex gap-4">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gray font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white-600">Update Booking</span>
                            </button>

                            <a href="{{ route('bookings.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Separate Delete Form -->
                <div class="mt-4 text-right">
                    <form method="POST" action="{{ route('bookings.destroy', $booking) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors" 
                                onclick="return confirm('Are you sure you want to delete this booking?')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
