<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\CompanyUser;
use App\Models\Admin\User\Permission;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PermissionController extends Controller
{
//    User

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Get the user
            $user = User::find($id);

            // Convert array of permissions to JSON
            $permissions = json_encode($request->input('permission'));

            // Update user's permission
            $user->update(['permission' => $permissions]);

            Permission::updatePermission($request, $id);

            return back()->with('message','User permission info update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

//    User - Company User

    /**
     * Show the form for editing the specified resource.
     */
    public function companyUserEdit(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company_users_all']['company_all_user']['company_user_permission']) && $permissionData['company_users_all']['company_all_user']['company_user_permission'] == 'company_user_permission'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                return view('admin.company-user.company-user.permission',[
                    'company_user' => $company_user,
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            $decryptID = Crypt::decryptString($id);
            return view('admin.error.error',[
                'user' => User::find($decryptID),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function companyUserUpdate(Request $request, string $id)
    {
        try {
            // Get the user
            $company_user = CompanyUser::find($id);

            // Convert array of permissions to JSON
            $permissions = json_encode($request->input('permission'));

            // Update user's permission
            $company_user->update(['permission' => $permissions]);

            Permission::updatePermissionCompanyUser($request, $id);

            return back()->with('message','Company User permission update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

//    Company User - Admin

    /**
     * Show the form for editing the specified resource.
     */
    public function companyUserPermissionEdit(string $id)
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['company_users_all_user']['company_user_permission_user']) && $companyPermissionData['company_users_all_user']['company_user_permission_user'] == 'company_user_permission_user'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                return view('company.company-user.company-user.permission',[
                    'company_user' => $company_user,
                ],compact('company_admin'));
            }else{
                return view('company.error.error');
            }
        }catch (DecryptException $e){
            $decryptID = Crypt::decryptString($id);
            return view('company.error.error',[
                'user' => User::find($decryptID),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function companyUserPermissionUpdate(Request $request, string $id)
    {
        try {
            // Get the user
            $company_user = CompanyUser::find($id);

            // Convert array of permissions to JSON
            $permissions = json_encode($request->input('permission'));

            // Update user's permission
            $company_user->update(['permission' => $permissions]);

            Permission::updatePermissionCompanyUser($request, $id);

            return back()->with('message','Company User permission info update successfully.');
        }catch (DecryptException $e){
            return view('company.error.error');
        }
    }

}
