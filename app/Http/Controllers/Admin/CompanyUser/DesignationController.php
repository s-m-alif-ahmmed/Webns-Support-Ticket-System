<?php

namespace App\Http\Controllers\Admin\CompanyUser;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DesignationController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_manage']) && $permissionData['company_users_all']['designation_all']['designation_manage'] == 'designation_manage'){
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $departments = Department::where('status', 'Published')->latest()->get();
                return view('admin.company-user.designation.manage',[
                    'designations' => Designation::all(),
                    'sub_companies' => $sub_companies,
                    'locations'   => $locations,
                    'departments' => $departments,
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
                'create_user_id' => 'nullable',
                'update_user_id' => 'nullable',
                'department_id' => 'required',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'name' => 'required|max:255',
            ]);

            Designation::createDesignation($request);
            return redirect('/admin/designation')->with('message', 'Designation saved successfully.');
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
            if($permissionData && isset($permissionData['company_users_all']['designation_all']['designation_detail']) && $permissionData['company_users_all']['designation_all']['designation_detail'] == 'designation_detail'){
                $decryptID = Crypt::decryptString($id);
                $designation = Designation::find($decryptID);
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $departments = Department::where('status', 'Published')->latest()->get();

                if ($designation) {
                    return view('admin.company-user.designation.detail', [
                        'designation' => $designation,
                        'sub_companies' => $sub_companies,
                        'locations'   => $locations,
                        'departments' => $departments,
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
                'department_id' => 'required',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'name' => 'required|max:255',
            ]);
            Designation::updateDesignation($request, $decryptID);
            return back()->with('message','Designation update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeDesignationStatus($id)
    {
        try {
            $designation = Designation::select('status')->where('id',$id)->first();
            if($designation->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($designation->status == 'Draft')
            {
                $status = 'Published';
            }
            Designation::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected designation status changed successfully.');
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
            Designation::deleteDesignation($id);
            return redirect('/admin/designation')->with('message','Designation delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

}
