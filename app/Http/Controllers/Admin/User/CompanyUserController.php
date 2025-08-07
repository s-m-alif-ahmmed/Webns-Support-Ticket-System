<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use App\Models\Admin\User\CompanyUser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;


class CompanyUserController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_manage']) && $permissionData['company_users_all']['company_all_user']['company_user_manage'] == 'company_user_manage'){
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $departments = Department::where('status', 'Published')->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();
                return view('admin.company-user.company-user.manage',[
                    'company_users' => CompanyUser::all(),
                    'companies' => $companies,
                    'sub_companies' => $sub_companies,
                    'locations' => $locations,
                    'departments' => $departments,
                    'designations' => $designations,
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
                'company_id' => 'required',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
                'employee_id' => 'required|max:255|unique:company_users',
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:company_users',
                'password' => 'required',
                ]);

            CompanyUser::createCompanyUser($request);
            return redirect('/company-users')->with('message', 'Company User create successfully.');
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
            if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_detail']) && $permissionData['company_users_all']['company_all_user']['company_user_detail'] == 'company_user_detail'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                $companies = Company::where('status', 'Published')->latest()->get();
                $sub_companies = SubCompany::where('status', 'Published')->latest()->get();
                $locations = Location::where('status', 'Published')->latest()->get();
                $departments = Department::where('status', 'Published')->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();

                if ($company_user) {
                    return view('admin.company-user.company-user.detail', [
                        'company_user' => $company_user,
                        'companies' => $companies,
                        'sub_companies' => $sub_companies,
                        'locations' => $locations,
                        'departments' => $departments,
                        'designations' => $designations,
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
                'company_id' => 'required',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
                'employee_id' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($decryptID),
                ],
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($decryptID),
                ],
            ]);
            CompanyUser::updateCompanyUser($request, $decryptID);
            return back()->with('message','Company User update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeCompanyUserStatus($id)
    {
        try {
            $company_user = CompanyUser::select('status')->where('id',$id)->first();
            if($company_user->status == 'Published')
            {
                $status = 'Draft';
            }
            elseif($company_user->status == 'Draft')
            {
                $status = 'Published';
            }
            CompanyUser::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected company user status changed successfully.');
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
            CompanyUser::deleteCompanyUser($id);
            return redirect('/company-users')->with('message','Company User delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    public function CompanyUserPasswordUpdate(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:3',
                    'max:50',
                    'confirmed',
                ],
            ]);

            $decryptID = Crypt::decryptString($id);
            // Retrieve the user by ID
            $company_user = CompanyUser::find($decryptID);

            if (!$company_user) {
                // Handle the case where the user is not found
                return back()->with('message', 'User not found.');
            }

            // Check if the password and password confirmation match
            if ($request->input('password') !== $request->input('password_confirmation')) {
                // Handle the case where the passwords do not match
                return back()->with('message', 'Password and confirmation do not match.');
            }

            // Update the user's password
            $company_user->forceFill([
                'password' => $request->input('password'),
                'update_user_id' => $request->input('update_user_id'),
            ])->save();

            return back()->with('message', 'Password changed successfully.');
        } catch (DecryptException $e) {
            // Handle decryption errors
            return view('admin.error.error');
        }
    }

//    Company User

    public function indexCompany()
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_manage_user']) && $companyPermissionData['company_users_all_user']['company_user_manage_user'] == 'company_user_manage_user'){
                $departments = Department::where('status', 'Published')->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();
                return view('company.company-user.company-user.manage',[
                    'company_users' => CompanyUser::where('sub_company_id', $company_admin->sub_company_id)->get(),
                    'departments' => $departments,
                    'designations' => $designations,
                ],compact('company_admin'));
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCompanyUser()
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_create_user']) && $companyPermissionData['company_users_all_user']['company_user_create_user'] == 'company_user_create_user'){
                $departments = Department::where('status', 'Published')->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();
                return view('company.company-user.company-user.index',[
                    'departments' => $departments,
                    'designations' => $designations,
                ],compact('company_admin'));
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCompanyUser(Request $request)
    {
        try {

            $validated = $request->validate([
                'company_id' => 'required',
                'sub_company_id' => 'required',
                'location_id' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
                'employee_id' => 'required|max:255|unique:company_users',
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:company_users',
                'password' => 'required',
                ]);

            CompanyUser::createCompanyUser($request);
            return redirect('/company/users/manage')->with('message', 'Company User create successfully.');
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function companyUserShow(string $id)
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_detail_user']) && $companyPermissionData['company_users_all_user']['company_user_detail_user'] == 'company_user_detail_user'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                $departments = Department::where('status', 'Published')->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();

                if ($company_user) {
                    return view('company.company-user.company-user.detail', [
                        'company_user' => $company_user,
                        'departments' => $departments,
                        'designations' => $designations,
                    ],compact('company_admin'));
                } else {
                    return view('company.error.error');
                }
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCompanyUser(string $id)
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_edit_user']) && $companyPermissionData['company_users_all_user']['company_user_edit_user'] == 'company_user_edit_user'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                $departments = Department::where('status', 'Published')->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();
                $designations = Designation::where('status', 'Published')->latest()->get();

                if ($company_user) {
                    return view('company.company-user.company-user.edit', [
                        'company_user' => $company_user,
                        'departments' => $departments,
                        'designations' => $designations,
                    ],compact('company_admin'));
                } else {
                    return view('company.error.error');
                }
            }else{
                return view('company.error.error');
            }
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateCompanyUser(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $validated = $request->validate([
                'department_id' => 'required',
                'designation_id' => 'required',
                'employee_id' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($decryptID),
                ],
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($decryptID),
                ],
            ]);
            CompanyUser::updateCompanyUser($request, $decryptID);
            return back()->with('message','User update successfully.');
        } catch (DecryptException $e) {
            return view('company.error.error');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCompanyUser(string $id)
    {
        try {
            CompanyUser::deleteCompanyUser($id);
            return redirect('/company/users/manage')->with('message',' User delete successfully.');
        } catch (DecryptException $e) {
            return view('company.error.error');
        }
    }

    public function CompanyUserPasswordUser($id)
    {
        $company_user_id = Session('company_user_id');
        $company_admin = CompanyUser::find($company_user_id);
        $companyPermissionData = json_decode($company_admin->permission, true);
        if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_change_password_user']) && $companyPermissionData['company_users_all_user']['company_user_change_password_user'] == 'company_user_change_password_user'){
            $decryptID = Crypt::decryptString($id);
            $company_user = CompanyUser::findOrFail($decryptID);
            return view('company.company-user.company-user.password',[
                'company_user' => $company_user,
            ],compact('company_admin'));
        }else{
            return view('company.error.error');
        }
    }

    public function CompanyUserPasswordUpdateUser(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:3',
                    'max:50',
                    'confirmed',
                ],
            ]);

            // Retrieve the user by ID
            $user = CompanyUser::find($id);

            if (!$user) {
                // Handle the case where the user is not found
                return back()->with('message', 'User not found.');
            }

            // Check if the password and password confirmation match
            if ($request->input('password') !== $request->input('password_confirmation')) {
                // Handle the case where the passwords do not match
                return back()->with('message', 'Password and confirmation do not match.');
            }

            // Update the user's password
            $user->forceFill([
                'password' => $request->input('password'),
                'update_company_user_id' => $request->input('update_company_user_id'),
            ])->save();

            return back()->with('message', 'Password changed successfully.');
        } catch (DecryptException $e) {
            // Handle decryption errors
            return view('company.error.error');
        }
    }


}
