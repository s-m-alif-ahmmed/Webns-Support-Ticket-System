<?php

namespace App\Models\Admin\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Industry extends Model
{
    use HasFactory;

    private static $industry, $industries;

    public static function createIndustry($request)
    {
        try {
            self::$industry       = new Industry();
            self::saveBasicInfo(self::$industry, $request);
            self::$industry->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateIndustry($request, $id)
    {
        try {
            self::$industry = Industry::find($id);
            self::saveBasicInfo(self::$industry, $request);
            self::$industry->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteIndustry($id)
    {
        try {
            self::$industry = Industry::find($id);
            self::$industry->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($industry){
            $industry->slug = Str::slug($industry->name, '-');
            $industry->prefix = Str::slug($industry->name, '-');
        });
        self::updating(function($industry){
            $industry->slug = Str::slug($industry->name, '-');
            $industry->prefix = Str::slug($industry->name, '-');
        });
    }

    private static function saveBasicInfo($industry, $request)
    {
        self::$industry->user_id            = $request->user_id;
        self::$industry->update_user_id     = $request->update_user_id;
        self::$industry->name               = $request->name;
    }

    public function company()
    {
        return $this->belongsToMany(Company::class);
    }

    public function subCompany()
    {
        return $this->belongsToMany(SubCompany::class);
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
