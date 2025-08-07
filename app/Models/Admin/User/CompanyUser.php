<?php

namespace App\Models\Admin\User;

use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Industry;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\CompanyUser\Department;
use App\Models\Admin\CompanyUser\Designation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class CompanyUser extends Authenticatable
{
    use HasFactory;

    private static $company_user, $company_users;
    private static $image, $directory, $imageName, $imageUrl;

    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
        'number',
        'gender',
        'role',
    ];

    public static function uploadImage($request)
    {
        try {
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                self::$image = $request->file('photo');
                self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
                self::$directory = "admin/images/company_user/";
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

    public static function createCompanyUser($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$company_user       = new CompanyUser();
            self::saveBasicInfo(self::$company_user, $request, self::$imageUrl);
            self::$company_user->save();
            return self::$company_user;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateCompanyUser($request, $id)
    {
        try {
            self::$company_user = CompanyUser::find($id);
            if($request->file('photo'))
            {
                if(file_exists(self::$company_user->photo)){
                    unlink(self::$company_user->photo);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$company_user->photo;
            }
            self::saveBasicInfo(self::$company_user, $request, self::$imageUrl);
            self::$company_user->save();
            return self::$company_user;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteCompanyUser($id)
    {
        try {
            self::$company_user = CompanyUser::find($id);
            if (file_exists(self::$company_user->photo))
            {
                unlink(self::$company_user->photo);
            }
            self::$company_user->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($company_user, $request, $imageUrl)
    {
        self::$company_user->photo                   = $imageUrl;
        self::$company_user->company_id              = $request->company_id;
        self::$company_user->sub_company_id          = $request->sub_company_id;
        self::$company_user->location_id             = $request->location_id;
        self::$company_user->department_id           = $request->department_id;
        self::$company_user->designation_id          = $request->designation_id;
        self::$company_user->user_id                 = $request->has('user_id') ? $request->user_id : null;
        self::$company_user->update_user_id          = $request->has('update_user_id') ? $request->update_user_id : null;
        self::$company_user->company_user_id         = $request->has('company_user_id') ? $request->company_user_id : null;
        self::$company_user->update_company_user_id  = $request->has('update_company_user_id') ? $request->update_company_user_id : null;
        self::$company_user->employee_id             = $request->employee_id ?? '';
        self::$company_user->name                    = $request->name;
        self::$company_user->email                   = $request->email;
        self::$company_user->password                = $request->password;
        self::$company_user->number                  = $request->number;
        self::$company_user->gender                  = $request->gender;
        self::$company_user->role                    = $request->role;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function subCompany()
    {
        return $this->belongsTo(SubCompany::class, 'sub_company_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

    public function createdByCompany()
    {
        return $this->belongsTo(CompanyUser::class, 'company_user_id');
    }

    public function updatedByCompany()
    {
        return $this->belongsTo(CompanyUser::class, 'company_update_user_id');
    }

}
