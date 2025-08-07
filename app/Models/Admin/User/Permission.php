<?php

namespace App\Models\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Permission extends Model
{
    use HasFactory;
    private static $user, $users, $permission, $permissions;
    private static $company_user, $company_users;

    public static function updatePermission($request, $id)
    {
        try {
            self::$user = User::find($id);
            self::saveBasicInfo(self::$user, $request);
            self::$user->update();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    private static function saveBasicInfo($user, $request)
    {
        self::$user->permission                  = $request->permission;
    }

    public static function updatePermissionCompanyUser($request, $id)
    {
        try {
            self::$company_user = CompanyUser::find($id);
            self::saveBasicInfoCompanyUser(self::$company_user, $request);
            self::$company_user->update();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    private static function saveBasicInfoCompanyUser($company_user, $request)
    {
//        self::$company_user->update_user_id              = $request->update_user_id;
        self::$company_user->permission                  = $request->permission;
    }


}
