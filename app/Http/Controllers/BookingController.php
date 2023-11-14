<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function allbooking()
    {
        $user = Auth::user();
        $allBookings = Booking::with('customers')->whereHas('services.businesses', function ($query) use ($user) {
            $query->where('businesses.users_id', $user->id);
        })->get();

        return view('business.formbooking.allbooking', compact('allBookings'));
    }

    public function dashboard()
    {
        $bookings = $this->get_bookings();

        return view('business.home.dashboard')->with('bookings', $bookings);
    }



    // booking edit
    public function bookingEdit($status_book)
    {
        $bookingEdit = DB::table('bookings')->where('status_book', $status_book)->first();
        return view('business.formbooking.bookingedit', compact('bookingEdit'));
    }

    // booking save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'type_of_day'   => 'required|string|max:255',
            'number_of_adults'     => 'required|int|max:11',
            'number_of_children' => 'required|int|max:11',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_cost'  => 'required|decimal',
            'status_book' => 'required|string|max:50'

        ]);

        DB::beginTransaction();
        try {

            $booking = new Booking;
            $booking->type_of_day = $request->type_of_day;
            $booking->number_of_adults     = $request->number_of_adults;
            $booking->number_of_children  = $request->number_of_children;
            $booking->start_date  = $request->start_date;
            $booking->end_date  = $request->end_date;
            $booking->total_cost   = $request->total_cost;
            $booking->status_book = $request->status_book;
            $booking->save();

            DB::commit();
            Toastr::success('Create new booking successfully :)', 'Success');
            return redirect()->route('form/allbooking');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Booking fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {


            $update = [
                'type_of_day' => $request->type_of_day,
                'number_of_adults'   => $request->number_of_adults,
                'number_of_children'  => $request->number_of_children,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'total_cost'   => $request->total_cost,
                'status_book' => $request->status_book,
            ];

            Booking::where('status_book', $request->status_book)->update($update);

            DB::commit();
            Toastr::success('Updated booking successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update booking fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record booking
    public function deleteRecord(Request $request)
    {
        try {

            Booking::destroy($request->id);
            Toastr::success('Booking deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Booking delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    // Approve booking
    public function approveBooking(Request $request)
    {
        $ids = $request->route('id');
        $booking = Booking::where('id', $ids)->first();
        if ($booking) {
            $booking->status_book = 'đã duyệt';
            $booking->save();

            Toastr::success('Booking approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Booking not found :)', 'Error');
            return redirect()->back();
        }
    }


    // Cancel booking
    public function cancelBooking(Request $request)
    {
        $ids = $request->route('id');
        $booking = Booking::where('id', $ids)->first();
        if ($booking) {
            $booking->status_book = 'từ chối';
            $booking->save();

            Toastr::success('Booking approved successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Booking not found :)', 'Error');
            return redirect()->back();
        }
    }
}
