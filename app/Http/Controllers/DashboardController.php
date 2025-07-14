<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $userBookings = Booking::where('user_id', auth()->id())->count();
        
        // Get recent bookings for the current user
        $recentBookings = Booking::where('user_id', auth()->id())
            ->orderBy('booking_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalBookings', 'totalUsers', 'userBookings', 'recentBookings'));
    }

    public function getBookingDates()
    {
        $bookings = Booking::select('booking_date', 'title')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($booking) {
                return [
                    'date' => $booking->booking_date->format('Y-m-d'),
                    'title' => $booking->title,
                    'formatted_date' => $booking->booking_date->format('F d, Y - h:i A')
                ];
            });

        return response()->json($bookings);
    }
} 