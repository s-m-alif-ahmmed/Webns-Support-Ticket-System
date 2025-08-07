<?php

namespace App\Models\Admin\CompanyUser;

use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    private static $department, $departments;
    protected $fillable = [
        'create_user_id',
        'update_user_id',
        'sub_company_id',
        'location_id',
        'name',
    ];

    public static function createDepartment($request)
    {
        try {
            self::$department       = new Department();
            self::saveBasicInfo(self::$department, $request);
            self::$department->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateDepartment($request, $id)
    {
        try {
            self::$department = Department::find($id);
            self::saveBasicInfo(self::$department, $request);
            self::$department->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteDepartment($id)
    {
        try {
            self::$department = Department::find($id);
            self::$department->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($department){
            $department->department_slug = Str::slug($department->name, '-');
        });
        self::updating(function($department){
            $department->department_slug = Str::slug($department->name, '-');
        });
    }

    private static function saveBasicInfo($department, $request)
    {
        self::$department->create_user_id           = $request->has('create_user_id') ? $request->create_user_id : null;
        self::$department->update_user_id           = $request->has('update_user_id') ? $request->update_user_id : null;
        self::$department->sub_company_id           = $request->sub_company_id;
        self::$department->location_id              = $request->location_id;
        self::$department->name                     = $request->name;
    }

    public function subCompany()
    {
        return $this->belongsTo(SubCompany::class, 'sub_company_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function subCompanies()
    {
        return $this->belongsToMany(SubCompany::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function designations()
    {
        return $this->belongsToMany(Designation::class);
    }

    public function company_users()
    {
        return $this->belongsToMany(CompanyUser::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

}
