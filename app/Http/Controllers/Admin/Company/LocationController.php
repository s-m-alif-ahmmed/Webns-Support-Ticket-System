<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Industry;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LocationController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_manage']) && $permissionData['company_everything_all']['location_all']['location_manage'] == 'location_manage'){
                $industries = Industry::where('status', 'Published')->latest()->get();
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                return view('admin.company.location.manage',[
                    'locations' => Location::all(),
                    'industries' => $industries,
                    'companies' => $companies,
                    'sub_companies' => $sub_companies,
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'industry_id' => 'required',
                'company_id' => 'required',
                'sub_company_id' => 'required',
                'location' => 'required',
                'branch_code' => 'required|max:255',
            ]);

            Location::createLocation($request);
            return redirect('/admin/locations')->with('message', 'Location saved successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_everything_all']['location_all']['location_detail']) && $permissionData['company_everything_all']['location_all']['location_detail'] == 'location_detail'){
                $decryptID = Crypt::decryptString($id);
                $location = Location::find($decryptID);
                $industries = Industry::where('status', 'Published')->latest()->get();
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_company = SubCompany::where('status', 'Published')->latest()->get();

                if ($location) {
                    return view('admin.company.location.detail', [
                        'location' => $location,
                        'industries' => $industries,
                        'companies' => $companies,
                        'sub_companies' => $sub_company,
                    ]);
                } else {
                    return view('admin.error.error');
                }
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $validated = $request->validate([
                'industry_id' => 'required',
                'company_id' => 'required',
                'sub_company_id' => 'required',
                'location' => 'required',
                'branch_code' => 'required|max:255',
            ]);
            Location::updateLocation($request, $decryptID);
            return redirect('/admin/locations')->with('message','Location update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeLocationStatus($id)
    {
        try {
            $location = Location::select('status')->where('id',$id)->first();
            if($location->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($location->status == 'Draft')
            {
                $status = 'Published';
            }
            Location::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected location status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Location::deleteLocation($id);
            return redirect('/admin/locations')->with('message','Location delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }



}
