<?php

namespace App\Models\Admin\Company;

use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class SubCompany extends Model
{
    use HasFactory;

    private static $sub_company, $sub_companies;
    private static $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                self::$image = $request->file('image');
                self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
                self::$directory = "admin/images/sub_company/";
                self::$image->move(self::$directory, self::$imageName);
                self::$imageUrl = self::$directory.self::$imageName;
                self::$imageUrl = self::$directory.self::$imageName;
                return self::$imageUrl;
            } else {
                self::$imageUrl = null;
                return self::$imageUrl;
            }
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createSubCompany($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$sub_company       = new SubCompany();
            self::saveBasicInfo(self::$sub_company, $request, self::$imageUrl);
            self::$sub_company->save();
            return self::$sub_company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateSubCompany($request, $id)
    {
        try {
            self::$sub_company = SubCompany::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$sub_company->image)){
                    unlink(self::$sub_company->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$sub_company->image;
            }
            self::saveBasicInfo(self::$sub_company, $request, self::$imageUrl);
            self::$sub_company->save();
            return self::$sub_company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteSubCompany($id)
    {
        try {
            self::$sub_company = SubCompany::find($id);
            if (file_exists(self::$sub_company->image))
            {
                unlink(self::$sub_company->image);
            }
            self::$sub_company->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($sub_company){
            $sub_company->sub_company_slug = Str::slug($sub_company->name, '-');
            $sub_company->sub_company_prefix = Str::slug($sub_company->name, '-');
            $sub_company->sub_company_code = self::generateRandomCode(15);

        });
        self::updating(function($sub_company){
            $sub_company->sub_company_slug = Str::slug($sub_company->name, '-');
            $sub_company->sub_company_prefix = Str::slug($sub_company->name, '-');
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

    private static function saveBasicInfo($sub_company, $request, $imageUrl)
    {
        self::$sub_company->image              = $imageUrl;
        self::$sub_company->industry_id        = $request->industry_id;
        self::$sub_company->company_id         = $request->company_id;
        self::$sub_company->user_id            = $request->user_id;
        self::$sub_company->update_user_id     = $request->update_user_id;
        self::$sub_company->name               = $request->name;
        self::$sub_company->email              = $request->email;
        self::$sub_company->number             = $request->number;
        self::$sub_company->web_slug           = $request->web_slug;
        self::$sub_company->sister_concern     = $request->sister_concern;
        self::$sub_company->branch             = $request->branch;
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function location()
    {
        return $this->belongsToMany(Location::class);
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
