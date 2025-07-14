<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-800 to-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-black mb-2">Create New Booking</h1>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Bookings
                    </a>
                </div>
            </div>



            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Booking Form -->
                <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6">
                    <h2 class="text-xl font-semibold text-white mb-6">Booking Details</h2>
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6" id="bookingForm">
                        @csrf
                        <!-- Title -->
<div>
    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Booking Title</label>
    <input type="text" id="title" name="title" value="{{ old('title') }}"
        class="w-full px-3 py-2 border border-gray-600 bg-gray-800 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Enter booking title" required>
    @error('title')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

                        <input type="hidden" id="booking_date" name="booking_date" value="{{ old('booking_date') }}">
                        <input type="hidden" id="booking_time" name="booking_time" value="{{ old('booking_time') }}">

                        <!-- Time Picker Modal -->
                        <div id="timePickerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50 hidden">
                            <div class="bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-xs">
                                <h3 class="text-lg font-semibold mb-4 text-white">Select a Time</h3>
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    @foreach(['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'] as $time)
                                        <button type="button" class="time-option px-4 py-2 rounded bg-gray-700 text-white hover:bg-red-600" data-time="{{ $time }}">{{ date('g:i A', strtotime($time)) }}</button>
                                    @endforeach
                                </div>
                                <button type="button" id="closeTimePicker" class="mt-2 w-full px-4 py-2 rounded bg-gray-600 hover:bg-gray-500">Cancel</button>
                            </div>
                        </div>

                        <!-- Description -->
<div>
    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
    <textarea id="description" name="description" rows="4"
        class="w-full px-3 py-2 border border-gray-600 bg-gray-800 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Tell us about your appointment needs...">{{ old('description') }}</textarea>
    @error('description')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create Booking
                            </button>
                            <a href="{{ route('bookings.index') }}" class="text-gray-400 hover:text-gray-300 text-sm">Cancel</a>
                        </div>
                    </form>
                </div>

                <!-- Calendar Section -->
                <div class="space-y-6">
                    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6">
                        <h2 class="text-xl font-semibold text-white mb-6">Select Date</h2>
                        <div id="fullcalendar" class="bg-gray-900 rounded-md p-2"></div>
                        <div id="selectedDateDisplay" class="mt-4 text-center text-green-400 font-semibold"></div>
                    </div>

                    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Available Times</h3>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="text-center p-3 bg-green-800 rounded-lg">
                                <p class="text-sm font-medium text-green-300">Morning</p>
                                <p class="text-xs text-green-400">9:00 AM - 12:00 PM</p>
                            </div>
                            <div class="text-center p-3 bg-blue-800 rounded-lg">
                                <p class="text-sm font-medium text-blue-300">Afternoon</p>
                                <p class="text-xs text-blue-400">1:00 PM - 4:00 PM</p>
                            </div>
                            <div class="text-center p-3 bg-purple-800 rounded-lg">
                                <p class="text-sm font-medium text-purple-300">Evening</p>
                                <p class="text-xs text-purple-400">4:00 PM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedDate = null;
            let selectedTime = null;
            let bookedDates = [];
            // Fetch booked dates from API
            fetch('/api/booking-dates')
                .then(response => response.json())
                .then(data => {
                    bookedDates = (data.dates || data).map(d => d.date || d); // support both [{date:...}] and [date,...]
                    renderCalendar();
                })
                .catch(error => {
                    bookedDates = [];
                    renderCalendar();
                });
            function renderCalendar() {
                let calendarEl = document.getElementById('fullcalendar');
                calendarEl.innerHTML = '';
                let calendar = new window.FullCalendar.Calendar(calendarEl, {
                    plugins: [ window.FullCalendar.dayGridPlugin, window.FullCalendar.interactionPlugin ],
                    initialView: 'dayGridMonth',
                    selectable: true,
                    selectOverlap: false,
                    selectAllow: function(info) {
                        // Prevent selecting booked dates
                        return !bookedDates.includes(info.startStr);
                    },
                    dateClick: function(info) {
                        if (bookedDates.includes(info.dateStr)) return;
                        selectedDate = info.dateStr;
                        document.getElementById('booking_date').value = selectedDate;
                        document.getElementById('selectedDateDisplay').textContent = 'Selected: ' + new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                        // Show time picker modal
                        document.getElementById('timePickerModal').classList.remove('hidden');
                    },
                    dayCellClassNames: function(arg) {
                        if (bookedDates.includes(arg.date.toISOString().split('T')[0])) {
                            return [ 'bg-red-100', 'text-red-600', 'cursor-not-allowed', 'relative', 'font-semibold' ];
                        }
                        return [];
                    },
                });
                calendar.render();
            }
            // Time picker modal logic
            document.querySelectorAll('.time-option').forEach(btn => {
                btn.addEventListener('click', function() {
                    selectedTime = this.getAttribute('data-time');
                    document.getElementById('booking_time').value = selectedTime;
                    document.getElementById('timePickerModal').classList.add('hidden');
                });
            });
            document.getElementById('closeTimePicker').addEventListener('click', function() {
                document.getElementById('timePickerModal').classList.add('hidden');
            });
        });
    </script>
</x-app-layout>