<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Businesse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // view page all service
    public function allservice()
    {

        $user = Auth::user();
        $business = Businesse::where('users_id', Auth::user()->id)->first();

        if ($business) {
            $allServices = Service::whereHas('businesses', function ($query) use ($business) {
                return $query->where('id', $business->id);
            })->get();

            return view('business.formservice.allservice', compact('allServices'));
        } else {
            // Handle the case where the user is not associated with a business
            return redirect()->back()->with('error', 'You are not associated with a business. Please contact the administrator.');
        }
    }

    // service add
    public function serviceAdd()
    {
        $data = DB::table('countries')->get();
        $service = DB::table('services')->get();
        return view('business.formservice.serviceadd', compact('data', 'service'));
    }

    // service edit
    public function serviceEdit($bkg_id)
    {
        $serviceEdit = DB::table('services')->where('bkg_id', $bkg_id)->first();
        return view('formservice.serviceedit', compact('serviceEdit'));
    }

    // service save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'service_name'   => 'required|string|max:100',
            'description'     => 'required|string',
            'prices' => 'required|numeric|decimal:2',
            'address' => 'required|string|max:200',
            'ward' => 'required|string|max:100',
            'district'  => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'country'      => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $service = new Service;
            $service->service_name = $request->service_name;
            $service->description     = $request->description;
            $service->prices  = $request->prices;
            $service->address  = $request->address;
            $service->ward  = $request->ward;
            $service->district   = $request->district;
            $service->city  = $request->city;
            $service->country       = $request->country;
            $business = Businesse::where('users_id', Auth::user()->id)->first();
            if ($business) {
                $service->businesses_id = $business->id;
            }
            // Assign the current business ID
            $service->save();

            DB::commit();
            Toastr::success('Create new service successfully :)', 'Success');
            return redirect()->route('form/allservice');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add service fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->fileupload)) {
                $photo = $request->fileupload;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/upload/'), $file_name);
            } else {
                $file_name = $request->hidden_fileupload;
            }

            $update = [
                'bkg_id' => $request->bkg_id,
                'name'   => $request->name,
                'room_type'  => $request->room_type,
                'total_numbers' => $request->total_numbers,
                'date'   => $request->date,
                'time'   => $request->time,
                'arrival_date'   => $request->arrival_date,
                'depature_date'  => $request->depature_date,
                'email'   => $request->email,
                'ph_number' => $request->phone_number,
                'fileupload' => $file_name,
                'message'   => $request->message,
            ];

            service::where('bkg_id', $request->bkg_id)->update($update);

            DB::commit();
            Toastr::success('Updated service successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update service fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record service
    public function deleteRecord(Request $request)
    {
        try {

            service::destroy($request->id);
            //unlink('assets/upload/' . $request->fileupload);
            Toastr::success('service deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('service delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
