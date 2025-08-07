<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin\User\CompanyUser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        try {
//            $permissionData = json_decode(Auth::user()->permission, true);
//            if($permissionData && isset($permissionData['user_profile']['profile_setting']) && $permissionData['user_profile']['profile_setting'] == 'profile_setting') {
                return view('admin.dashboard.setting', [
                    'user' => $request->user(),
                ]);
//            }else{
//                return view('admin.error.error');
//            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }

    }
    /**
     * Display the user's profile form.
     */
    public function editCompany(Request $request, $id): View
    {
        try {
            $company_user_id = Session('company_user_id');
            $company_admin = CompanyUser::find($company_user_id);
            $companyPermissionData = json_decode($company_admin->permission, true);
            if($companyPermissionData && isset($companyPermissionData['user_profile_user']['profile_setting_user']) && $companyPermissionData['user_profile_user']['profile_setting_user'] == 'profile_setting_user') {
                $decryptID = Crypt::decryptString($id);
                return view('company.dashboard.setting', [
                    'company_user' => CompanyUser::find($decryptID),
                ],compact('company_admin'));
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
