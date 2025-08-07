<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Crypt;

class CompanyUserProfilePhoto extends Model
{
    use HasFactory;

    private static $company_photo, $company_photos, $photo, $directory, $photoName, $photoUrl;

    public static function uploadPhoto($request)
    {
        try {
            self::$photo = $request->file('photo');
            self::$photoName = self::$photo->getClientOriginalName();
            self::$directory = "admin/images/company_user/profile_photo/";
            self::$photo->move(self::$directory, self::$photoName);
            self::$photoUrl = self::$directory.self::$photoName;
            return self::$directory.self::$photoName;
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    public static function createProfilePhoto($request)
    {
        try {
            self::$company_photo    = new CompanyUser();
            self::saveBasicInfo(new CompanyUser(), $request, self::$photoUrl);
            self::$company_photo->photo = self::$photoUrl;
            self::$company_photo->save();
            return self::$company_photo;
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    public static function updateProfilePhoto($request, $id)
    {
        try {
//            self::$company_photo = CompanyUser::find($id);
            $decryptedId = Crypt::decryptString($id);
            self::$company_photo = CompanyUser::findOrFail($decryptedId);
            if($request->file('photo'))
            {
                if(file_exists(self::$company_photo->photo)){
                    unlink(self::$company_photo->photo);
                }
                self::$photoUrl = self::uploadPhoto($request);
            }
            else{
                self::$photoUrl = self::$company_photo->photo;
            }
            self::saveBasicInfo(self::$company_photo, $request, self::$photoUrl);
            self::$company_photo->photo = self::$photoUrl;
            self::$company_photo->update();
        } catch (ModelNotFoundException $e) {
            return view('error');
        }

    }

    public static function deleteProfilePhoto($id)
    {
        try {
            $company_photo = CompanyUser::findOrFail($id); // Find the user or fail if not found

            if (file_exists($company_photo->photo)) {
                unlink($company_photo->photo); // Delete the photo from the file system
            }

            $company_photo->photo = null; // Set the photo attribute to null
            $company_photo->save(); // Save the user model

        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    private static function saveBasicInfo($company_photo, $request, $photoUrl)
    {
        self::$company_photo->photo                  = $photoUrl;
//        self::$company_photo->name                   = $request->name;
//        self::$company_photo->email                  = $request->email;
    }

}
