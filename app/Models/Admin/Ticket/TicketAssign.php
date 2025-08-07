<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Company\Company;
use App\Models\Admin\Company\Location;
use App\Models\Admin\Company\SubCompany;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class TicketAssign extends Model
{
    use HasFactory;
    private static $ticket_assign, $ticket_assigns;

    protected $fillable = [
        'create_user_id',
        'update_user_id',
        'ticket_id',
        'assign_user_id',
        'work_role',
        'approx_end_time',
        'updated_approx_end_time',
        'work_end_time',
    ];

    public static function createTicketAssign($request)
    {
        try {
            self::$ticket_assign = new TicketAssign();
            self::saveBasicInfo(self::$ticket_assign, $request);
            self::$ticket_assign->save();
            return self::$ticket_assign;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateTicketAssign($request, $id)
    {
        try {
            self::$ticket_assign = TicketAssign::find($id);
            self::saveBasicInfo(self::$ticket_assign, $request);
            self::$ticket_assign->save();
            return self::$ticket_assign;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteTicketAssign($id)
    {
        try {
            self::$ticket_assign = TicketAssign::find($id);
            self::$ticket_assign->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($ticket_assign, $request)
    {
        self::$ticket_assign->create_user_id            = $request->create_user_id;
        self::$ticket_assign->update_user_id            = $request->update_user_id;
        self::$ticket_assign->ticket_id                 = $request->ticket_id;
        self::$ticket_assign->assign_user_id            = $request->assign_user_id;
        self::$ticket_assign->work_role                 = $request->work_role;
        self::$ticket_assign->approx_end_time           = $request->approx_end_time;
        self::$ticket_assign->updated_approx_end_time   = $request->updated_approx_end_time;
        self::$ticket_assign->work_end_time             = $request->work_end_time;
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function assignUser()
    {
        return $this->belongsTo(User::class, 'assign_user_id');
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
