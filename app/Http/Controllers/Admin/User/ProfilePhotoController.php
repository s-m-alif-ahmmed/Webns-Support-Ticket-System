<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\CompanyUser;
use App\Models\Admin\User\CompanyUserProfilePhoto;
use App\Models\Admin\User\UserProfilePhoto;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.dashboard.setting',['users' => User::all()]);
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.dashboard.setting');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'photo' => [
                    'required',
                    'unique:' . User::class . ',photo,NULL,id', // Adjust the column names and table name as needed
                ],
            ], [
                'photo.unique' => 'This image already taken.',
            ]);

            UserProfilePhoto::createProfilePhoto($request);
            return back()->with('create-message','Profile info save successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return view('admin.dashboard.settings',[
                'user' => User::find($id),
            ]);
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
            UserProfilePhoto::updateProfilePhoto($request, $id);
            return back()->with('update-message', 'Profile image updated successfully.');
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
            UserProfilePhoto::deleteProfilePhoto($id);
            return back()->with('delete-message', 'Profile image remove successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

//    Company User

    /**
     * Store a newly created resource in storage.
     */
    public function storeCompany(Request $request)
    {
        try {
            $request->validate([
                'photo' => [
                    'required',
                    'unique:' . CompanyUser::class . ',photo,NULL,id', // Adjust the column names and table name as needed
                ],
            ], [
                'photo.unique' => 'This image already taken.',
            ]);

            CompanyUserProfilePhoto::createProfilePhoto($request);
            return back()->with('create-message','Profile image save successfully.');
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
            CompanyUserProfilePhoto::updateProfilePhoto($request, $id);
            return back()->with('update-message', 'Profile image updated successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCompany(string $id)
    {
        try {
            CompanyUserProfilePhoto::deleteProfilePhoto($id);
            return back()->with('delete-message', 'Profile image remove successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }
}
