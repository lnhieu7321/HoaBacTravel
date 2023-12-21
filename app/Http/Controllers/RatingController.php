<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function allrating()
    {
        $user = Auth::user();
        $allRatings = Rating::with('customers', 'bookings')->whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })->get();

        return view('business.formrating.allrating', compact('allRatings'));
    }
}
