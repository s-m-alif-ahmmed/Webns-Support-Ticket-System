<?php

namespace App\Http\Controllers\Admin\CompanyUser;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\User\CompanyUser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_users_all']['department_all']['department_manage']) && $permissionData['company_users_all']['department_all']['department_manage'] == 'department_manage'){
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                return view('admin.company-user.department.manage',[
                    'departments' => Department::all(),
                    'locations' => $locations,
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
                'create_user_id' => 'nullable',
                'update_user_id' => 'nullable',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'name' => 'required|max:255',
            ]);

            Department::createDepartment($request);
            return redirect('/admin/department')->with('message', 'Department saved successfully.');
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
            if($permissionData && isset($permissionData['company_users_all']['department_all']['department_detail']) && $permissionData['company_users_all']['department_all']['department_detail'] == 'department_detail'){
                $decryptID = Crypt::decryptString($id);
                $department = Department::find($decryptID);
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();

                if ($department) {
                    return view('admin.company-user.department.detail', [
                        'department' => $department,
                        'sub_companies' => $sub_companies,
                        'locations' => $locations,
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
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'name' => 'required|max:255',
            ]);
            Department::updateDepartment($request, $decryptID);
            return back()->with('message','Department update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeDepartmentStatus($id)
    {
        try {
            $department = Department::select('status')->where('id',$id)->first();
            if($department->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($department->status == 'Draft')
            {
                $status = 'Published';
            }
            Department::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected department status changed successfully.');
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
            Department::deleteDepartment($id);
            return redirect('/admin/department')->with('message','Department delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

}
