<?php

namespace App\Models\Admin\Company;

use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    private static $company, $companies;
    private static $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/company/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$imageUrl;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createCompany($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$company       = new Company();
            self::saveBasicInfo(self::$company, $request, self::$imageUrl);
            self::$company->save();
            return self::$company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateCompany($request, $id)
    {
        try {
            self::$company = Company::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$company->image)){
                    unlink(self::$company->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$company->image;
            }
            self::saveBasicInfo(self::$company, $request, self::$imageUrl);
            self::$company->save();
            return self::$company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteCompany($id)
    {
        try {
            self::$company = Company::find($id);
            if (file_exists(self::$company->image))
            {
                unlink(self::$company->image);
            }
            self::$company->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($company){
            $company->company_slug = Str::slug($company->name, '-');
            $company->company_prefix = Str::slug($company->name, '-');
            $company->company_code = self::generateRandomCode(15);

        });
        self::updating(function($company){
            $company->company_slug = Str::slug($company->name, '-');
            $company->company_prefix = Str::slug($company->name, '-');
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

    private static function saveBasicInfo($company, $request, $imageUrl)
    {
        self::$company->image              = $imageUrl;
        self::$company->industry_id        = $request->industry_id;
        self::$company->user_id            = $request->user_id;
        self::$company->update_user_id     = $request->update_user_id;
        self::$company->name               = $request->name;
        self::$company->web_slug           = $request->web_slug;
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function subCompany()
    {
        return $this->belongsToMany(SubCompany::class);
    }
    public function companyUser()
    {
        return $this->belongsToMany(CompanyUser::class);
    }

    public function location()
    {
        return $this->belongsToMany(Location::class);
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
