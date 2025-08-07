<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class SubModule extends Model
{
    use HasFactory;

    private static $sub_module, $sub_modules;

    public static function createSubModule($request)
    {
        try {
            self::$sub_module       = new SubModule();
            self::saveBasicInfo(self::$sub_module, $request);
            self::$sub_module->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateSubModule($request, $id)
    {
        try {
            self::$sub_module = SubModule::find($id);
            self::saveBasicInfo(self::$sub_module, $request);
            self::$sub_module->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteSubModule($id)
    {
        try {
            self::$sub_module = SubModule::find($id);
            self::$sub_module->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($sub_module){
            $sub_module->sub_module_slug = Str::slug($sub_module->name, '-');
        });
        self::updating(function($sub_module){
            $sub_module->sub_module_slug = Str::slug($sub_module->name, '-');
        });
    }

    private static function saveBasicInfo($sub_module, $request)
    {
        self::$sub_module->user_id           = $request->user_id;
        self::$sub_module->update_user_id    = $request->update_user_id;
        self::$sub_module->module_id         = $request->module_id;
        self::$sub_module->name              = $request->name;
        self::$sub_module->sub_module_code   = $request->sub_module_code;
        self::$sub_module->description       = $request->description;
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
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
