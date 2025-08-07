<?php

namespace App\Models\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserProfilePhoto extends Model
{
    use HasFactory;

    private static $user, $users, $photo, $directory, $photoName, $photoUrl;

    public static function uploadPhoto($request)
    {
        try {
            self::$photo = $request->file('photo');
            self::$photoName = self::$photo->getClientOriginalName();
            self::$directory = "admin/save_images/profile_photo/";
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
            self::$user                          = new User();
            self::saveBasicInfo(new User(), $request, self::$photoUrl);
            self::$user->photo = self::$photoUrl;
            self::$user->save();
            return self::$user;
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    public static function updateProfilePhoto($request, $id)
    {
        try {
            self::$user = User::find($id);
            if($request->file('photo'))
            {
                if(file_exists(self::$user->photo)){
                    unlink(self::$user->photo);
                }
                self::$photoUrl = self::uploadPhoto($request);
            }
            else{
                self::$photoUrl = self::$user->photo;
            }
            self::saveBasicInfo(self::$user, $request, self::$photoUrl);
            self::$user->photo = self::$photoUrl;
            self::$user->update();
        } catch (ModelNotFoundException $e) {
            return view('error');
        }

    }

    public static function deleteProfilePhoto($id)
    {
        try {
            $user = User::findOrFail($id); // Find the user or fail if not found

            if (file_exists($user->photo)) {
                unlink($user->photo); // Delete the photo from the file system
            }

            $user->photo = null; // Set the photo attribute to null
            $user->save(); // Save the user model

        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    private static function saveBasicInfo($user, $request, $photoUrl)
    {
        self::$user->photo                  = $photoUrl;
        self::$user->name                   = $request->name;
        self::$user->email                  = $request->email;
    }

}
