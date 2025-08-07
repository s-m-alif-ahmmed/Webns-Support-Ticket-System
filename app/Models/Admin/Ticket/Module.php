<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;

    private static $module, $modules;

    public static function createModule($request)
    {
        try {
            self::$module       = new Module();
            self::saveBasicInfo(self::$module, $request);
            self::$module->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateModule($request, $id)
    {
        try {
            self::$module = Module::find($id);
            self::saveBasicInfo(self::$module, $request);
            self::$module->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteModule($id)
    {
        try {
            self::$module = Module::find($id);
            self::$module->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($module){
            $module->module_slug = Str::slug($module->name, '-');
        });
        self::updating(function($module){
            $module->module_slug = Str::slug($module->name, '-');
        });
    }

    private static function saveBasicInfo($module, $request)
    {
        self::$module->user_id           = $request->user_id;
        self::$module->update_user_id    = $request->update_user_id;
        self::$module->name              = $request->name;
        self::$module->module_code       = $request->module_code;
        self::$module->description       = $request->description;
    }

    public function sub_module()
    {
        return $this->belongsToMany(User::class);
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
