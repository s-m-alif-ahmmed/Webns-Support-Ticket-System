<?php

namespace App\Models\Admin\Company;

use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    private static $location, $locations;

    public static function createLocation($request)
    {
        try {
            self::$location       = new Location();
            self::saveBasicInfo(self::$location, $request);
            self::$location->save();
            return self::$location;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateLocation($request, $id)
    {
        try {
            self::$location = Location::find($id);
            self::saveBasicInfo(self::$location, $request);
            self::$location->save();
            return self::$location;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteLocation($id)
    {
        try {
            self::$location = Location::find($id);
            self::$location->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($location){
            $location->location_code = self::generateRandomCode(15);
        });
    }

    private static function generateRandomCode($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return substr($randomString, 0, $length); // Ensure the string length is exactly 15
    }

    private static function saveBasicInfo($location, $request)
    {
        self::$location->industry_id        = $request->industry_id;
        self::$location->company_id         = $request->company_id;
        self::$location->sub_company_id     = $request->sub_company_id;
        self::$location->user_id            = $request->user_id;
        self::$location->update_user_id     = $request->update_user_id;
        self::$location->location           = $request->location;
        self::$location->branch_code        = $request->branch_code;
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function subCompany()
    {
        return $this->belongsTo(SubCompany::class, 'sub_company_id');
    }

    public function department()
    {
        return $this->belongsToMany(Department::class);
    }

    public function companyUser()
    {
        return $this->belongsToMany(CompanyUser::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

}
