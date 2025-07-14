<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()->orderBy('booking_date', 'desc')->get();
        $totalBookings = $bookings->count();
        $upcomingBookings = $bookings->where('booking_date', '>=', now())->count();
        $pastBookings = $bookings->where('booking_date', '<', now())->count();
        
        return view('bookings.index', compact('bookings', 'totalBookings', 'upcomingBookings', 'pastBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required',
            'description' => 'nullable|string',
        ]);

        // Combine date and time
        $bookingDateTime = $request->booking_date . ' ' . $request->booking_time . ':00';

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'booking_date' => $bookingDateTime,
        ]);

        $request->user()->notify(new BookingCreated($booking));

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'description' => 'nullable|string',
        ]);

        // Combine date and time
        $bookingDateTime = $request->booking_date . ' ' . $request->booking_time . ':00';

        $booking->update([
            'title' => $request->title,
            'description' => $request->description,
            'booking_date' => $bookingDateTime,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        
        $booking->delete();
        
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}
