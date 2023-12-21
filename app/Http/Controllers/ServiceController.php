<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Businesse;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;

class ServiceController extends Controller
{
    // view page all service
    public function allservice()
    {

        $user = Auth::user();
        $business = Businesse::where('users_id', Auth::user()->id)->first();

        if ($business) {
            $allServices = Service::with('images')
                ->whereHas('businesses', function ($query) use ($business) {
                    return $query->where('id', $business->id);
                })
                ->get();

            return view('business.formservice.allservice', compact('allServices'));
        } else {
            // Handle the case where the user is not associated with a business
            return redirect()->back()->with('error', 'You are not associated with a business. Please contact the administrator.');
        }
    }

    // service add
    public function serviceAdd()
    {

        $service = DB::table('services')->get();
        return view('business.formservice.serviceadd', compact('service'));
    }

    // service edit
    public function serviceEdit($id)
    {

        $service = DB::table('services')->where('id', $id)->first();
        $services = Service::with('images')->find($id);
        $imageUrls = $services->images->pluck('url');
        return view('business.formservice.serviceedit', compact('service', 'services', 'imageUrls'));
    }

    // service save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'service_name'   => 'required|string|max:100',
            'description'     => 'required|string',
            'price' => 'required|numeric|decimal:0',
            'address' => 'required|string|max:200',
            'ward' => 'required|string|max:100',
            'district'  => 'required|string|max:100',
            'city' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $service = new Service;
            $service->service_name = $request->service_name;
            $service->description     = $request->description;
            $service->price  = $request->price;
            $service->address  = $request->address;
            $service->ward  = $request->ward;
            $service->district   = $request->district;
            $service->city  = $request->city;
            $business = Businesse::where('users_id', Auth::user()->id)->first();
            if ($business) {
                $service->businesses_id = $business->id;
            }

            $service->save();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = rand() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/assets/upload/'), $imageName);


                $image = new Image;
                $image->url = $imageName;
                $image->image_type = 'chính';
                $image->services_id = $service->id; // Lưu services_id vào bảng images
                $image->save();
            }
            // Assign the current business ID


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



            $update = [
                'id' => $request->id,
                'service_name'   => $request->service_name,
                'description'  => $request->description,
                'price' => $request->price,
                'address'   => $request->address,
                'ward'   => $request->ward,
                'district'   => $request->district,
                'city'  => $request->city,

            ];

            service::where('id', $request->id)->update($update);

            $images = $request->file('images');
            if ($images) {
                foreach ($images as $image) {
                    // Check if it's a new image or an update
                    if (array_key_exists('id', $image)) {
                        // Existing image: update the URL
                        Image::where('id', $image['id'])->update([
                            'url' => $image->store('images'),
                        ]);
                    } else {
                        // New image: create a new record
                        $imageData = [
                            'url' => $image->store('images'),
                            'image_type' => $image->getClientOriginalExtension(),
                            'services_id' => $request->id,
                        ];
                        Image::create($imageData);
                    }
                }
            }


            DB::commit();
            Toastr::success('Updated service successfully :)', 'Success');
            return redirect()->route('form/allservice');
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
