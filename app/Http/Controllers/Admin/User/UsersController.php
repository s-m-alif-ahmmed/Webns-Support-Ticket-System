<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * Show all users resource.
     */
    public function users()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_manage']) && $permissionData['users_all']['employ_manage'] == 'employ_manage'){
                return view('admin.users.user.manage',[
                    'users' => User::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show all users resource.
     */
    public function usersRegistration()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_create']) && $permissionData['users_all']['employ_create'] == 'employ_create'){
                return view('admin.users.user.registration');
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
    public function usersRegistrationStore(Request $request)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_create']) && $permissionData['users_all']['employ_create'] == 'employ_create'){
                User::createUser($request);
                return redirect('/users')->with('message', 'User saved successfully.');
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the user detail resource.
     */
    public function usersDetail($id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_detail']) && $permissionData['users_all']['employ_detail'] == 'employ_detail'){
                $decryptID = Crypt::decryptString($id);
                $user = User::find($decryptID);

                if (!$user) {
                    // Handle the case where the user is not found
                    return view('admin.error.error');
                }

                return view('admin.users.user.detail',[
                    'user' => $user,
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            User::updateUser($request, $id);
            return back()->with('message','User info update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCompany(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'department_id' => 'required',
                'designation_id' => 'required',
                'employee_id' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($id),
                ],
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'max:255',
                    Rule::unique('company_users')->ignore($id),
                ],
            ]);
            CompanyUser::updateCompanyUser($request, $id);
            return back()->with('message','Company User info update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show user detail resource.
     */
    public function profile($id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            return view('admin.dashboard.profile',[
                'user' => User::find($decryptID),
            ]);
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

//    Company User

    /**
     * Show user detail resource.
     */
    public function profileCompany($id)
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $departments = Department::where('status', 'Published')->where('sub_company_id', $company_admin->sub_company_id)->latest()->get();
            $designations = Designation::where('status', 'Published')->latest()->get();

            $decryptID = Crypt::decryptString($id);
            return view('company.dashboard.profile',[
                'company_user' => CompanyUser::find($decryptID),
                'departments' => $departments,
                'designations' => $designations,
            ],compact('company_admin'));
        }catch (DecryptException $e){
            return view('company.error.error');
        }
    }

    /**
     * Show user detail resource.
     */
    public function profileEditCompany($id)
    {
        try{
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
//            $permissionData = json_decode(Auth::user()->permission, true);
//            if($permissionData && isset($permissionData['user_profile']['profile_edit']) && $permissionData['user_profile']['profile_edit'] == 'profile_edit'){
                $decryptID = Crypt::decryptString($id);
                $company_user = CompanyUser::find($decryptID);
                return view('company.dashboard.edit',[
                    'company_user' => $company_user,
                ],compact('company_admin'));
//            }else{
//                return view('admin.error.error');
//            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * change the user role resource.
     */
    public function changeRole($id)
    {
        try {
            User::where('id',$id)->update(['role'=>$role]);
            return back()->with('message','Role changed successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * change the user ban resource.
     */
    public function changeBanStatus($id)
    {
        try {
            $banned = User::select('ban_status')->where('id',$id)->first();
            if($banned->ban_status == 1)
            {
                $banStatus = 0;
            }
            elseif($banned->ban_status == 0)
            {
                $banStatus = 1;
            }
            User::where('id',$id)->update(['ban_status'=>$banStatus]);
            return back()->with('message','Selected user restriction status changed successfully.');
        }catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


    /**
     * the user change password resource.
     */
    public function passwordChange(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:25',
                    'confirmed',
                ],
            ]);

            // Retrieve the user by ID
            $user = User::find($id);

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
            ])->save();

            return back()->with('message', 'Password changed successfully.');
        } catch (DecryptException $e) {
            // Handle decryption errors
            return view('admin.error.error');
        }
    }


    /**
     * delete the specified resource in storage.
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect('/users')->with('message', 'User not found.');
            }

            $user->delete();

            return redirect('/users')->with('message', 'User delete successfully');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }


    public function passwordUpdate(Request  $request): RedirectResponse
    {
        $user = $request->user();

        try {
            // Validate the request
            $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'string'],
                'password' => ['required', 'string', 'confirmed', 'min:8'],
            ]);

            // Check if the current password matches
            if ($request->current_password !== $user->password) {
                return redirect()->route('profile.edit')->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            // Update the user's password
            if ($request->password === $request->password_confirmation) {
                $user->update(['password' => $request->password]);
                return redirect()->route('profile.edit')->with('status', 'password-updated');
            } else {
                return redirect()->route('profile.edit')->withErrors(['password_confirmation' => 'Password confirmation does not match.']);
            }

        } catch (ValidationException $e) {
            return redirect()->route('profile.edit')->withErrors($e->errors());
        }
    }

    public function passwordUpdateCompany(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:25',
                    'confirmed',
                ],
            ]);

            $company_user_id = Session('company_user_id');

            // Retrieve the company user object from the database
            $company_user = CompanyUser::find($company_user_id);

            if (!$company_user) {
                // Handle the case where the user is not found
                return back()->with('message', 'User not found.');
            }

            // Check if the current password matches
            if ($request->input('current_password') !== $company_user->password) {
                return redirect()->route('profile.edit.company', ['id' => $id])->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            // Check if the password and password confirmation match
            if ($request->input('password') !== $request->input('password_confirmation')) {
                // Handle the case where the passwords do not match
                return back()->with('message', 'Password and confirmation do not match.');
            }

            // Update the user's password
            $company_user->forceFill([
                'password' => $request->input('password'),
                'update_company_user_id' => $request->input('update_company_user_id'),
            ])->save();

            Session::forget('company_user_id');
            Session::forget('company_user_name');

            return redirect('/')->with('message', 'Password changed successfully.');

        } catch (DecryptException $e) {
            // Handle decryption errors
            return view('company.error.error');
        }
    }

    public function dashboardError()
    {
        try {
            return view('admin.error.error');
        }catch (DecryptException $e) {
            return abort(404);
        }
    }

    public function companyDashboardError()
    {
        try {
            return view('company.error.error');
        }catch (DecryptException $e) {
            return abort(404);
        }
    }
}
