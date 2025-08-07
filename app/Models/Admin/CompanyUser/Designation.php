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

class Designation extends Model
{
    use HasFactory;

    private static $designation, $designations;
    protected $fillable = [
        'create_user_id',
        'update_user_id',
        'sub_company_id',
        'location_id',
        'department_id',
        'name',
    ];

    public static function createDesignation($request)
    {
        try {
            self::$designation       = new Designation();
            self::saveBasicInfo(self::$designation, $request);
            self::$designation->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateDesignation($request, $id)
    {
        try {
            self::$designation = Designation::find($id);
            self::saveBasicInfo(self::$designation, $request);
            self::$designation->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteDesignation($id)
    {
        try {
            self::$designation = Designation::find($id);
            self::$designation->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($designation){
            $designation->designation_slug = Str::slug($designation->name, '-');
        });
        self::updating(function($designation){
            $designation->designation_slug = Str::slug($designation->name, '-');
        });
    }

    private static function saveBasicInfo($designation, $request)
    {
        self::$designation->create_user_id     = $request->has('create_user_id') ? $request->create_user_id : null;
        self::$designation->update_user_id     = $request->has('update_user_id') ? $request->update_user_id : null;
        self::$designation->sub_company_id     = $request->sub_company_id;
        self::$designation->location_id        = $request->location_id;
        self::$designation->department_id      = $request->department_id;
        self::$designation->name               = $request->name;
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

    public function subCompanies()
    {
        return $this->belongsToMany(SubCompany::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function company_user()
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
