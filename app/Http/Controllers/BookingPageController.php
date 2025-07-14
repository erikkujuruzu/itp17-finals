<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingPageController extends Controller
{
use AuthorizesRequests;

   public function index()
{
    $bookings = \App\Models\Booking::where('user_id', auth()->id())->get();
    return view('bookings.index', ['bookings' => $bookings]);
}




public function create()
{
    return view('bookings.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'selected_date' => 'required|date',
        'booking_time' => 'required',
    ]);

    // Combine date and time
    $bookingDateTime = $request->selected_date . ' ' . $request->booking_time . ':00';

    Booking::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'booking_date' => $bookingDateTime,
    ]);

    return redirect('/dashboard')->with('success', 'Booking created successfully!');
}


public function edit(Booking $booking)
{
    $this->authorize('update', $booking); // optional if using policy
    return view('bookings.edit', compact('booking'));
}

public function update(Request $request, Booking $booking)
{
    $this->authorize('update', $booking);
    
    $request->validate([
        'title' => 'required|string|max:255',
        'selected_date' => 'required|date',
        'booking_time' => 'required',
    ]);

    // Combine date and time
    $bookingDateTime = $request->selected_date . ' ' . $request->booking_time . ':00';

    $booking->update([
        'title' => $request->title,
        'description' => $request->description,
        'booking_date' => $bookingDateTime,
    ]);

    return redirect('/my-bookings')->with('success', 'Booking updated successfully!');
}

public function destroy(Booking $booking)
{
    $this->authorize('delete', $booking);
    $booking->delete();

    return redirect('/my-bookings')->with('success', 'Booking deleted.');
}


}
