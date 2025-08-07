<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class TicketNature extends Model
{
    use HasFactory;

    private static $ticket_nature, $ticket_natures;

    public static function createTicketNature($request)
    {
        try {
            self::$ticket_nature       = new TicketNature();
            self::saveBasicInfo(self::$ticket_nature, $request);
            self::$ticket_nature->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateTicketNature($request, $id)
    {
        try {
            self::$ticket_nature = TicketNature::find($id);
            self::saveBasicInfo(self::$ticket_nature, $request);
            self::$ticket_nature->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteTicketNature($id)
    {
        try {
            self::$ticket_nature = TicketNature::find($id);
            self::$ticket_nature->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($ticket_nature){
            $ticket_nature->ticket_nature_slug = Str::slug($ticket_nature->name, '-');
        });
        self::updating(function($ticket_nature){
            $ticket_nature->ticket_nature_slug = Str::slug($ticket_nature->name, '-');
        });
    }

    private static function saveBasicInfo($ticket_nature, $request)
    {
        self::$ticket_nature->user_id           = $request->user_id;
        self::$ticket_nature->update_user_id    = $request->update_user_id;
        self::$ticket_nature->name              = $request->name;
    }

//    public function sub_module()
//    {
//        return $this->belongsToMany(User::class);
//    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

}
