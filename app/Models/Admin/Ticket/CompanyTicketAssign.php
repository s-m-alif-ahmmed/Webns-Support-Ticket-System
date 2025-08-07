<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyTicketAssign extends Model
{
    use HasFactory;

    private static $company_ticket_assign, $company_ticket_assigns;

    protected $fillable = [
        'create_user_id',
        'update_user_id',
        'company_user_id',
        'update_company_user_id',
        'ticket_id',
        'assign_user_id',
        'work_role',
        'approx_end_time',
    ];

    public static function createCompanyTicketAssign($request)
    {
        try {
            self::$company_ticket_assign = new CompanyTicketAssign();
            self::saveBasicInfo(self::$company_ticket_assign, $request);
            self::$company_ticket_assign->save();
            return self::$company_ticket_assign;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateCompanyTicketAssign($request, $id)
    {
        try {
            self::$company_ticket_assign = CompanyTicketAssign::find($id);
            self::saveBasicInfo(self::$company_ticket_assign, $request);
            self::$company_ticket_assign->save();
            return self::$company_ticket_assign;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteCompanyTicketAssign($id)
    {
        try {
            self::$company_ticket_assign = CompanyTicketAssign::find($id);
            self::$company_ticket_assign->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($company_ticket_assign, $request)
    {
        self::$company_ticket_assign->create_user_id            = $request->create_user_id;
        self::$company_ticket_assign->update_user_id            = $request->update_user_id;
        self::$company_ticket_assign->company_user_id           = $request->company_user_id;
        self::$company_ticket_assign->update_company_user_id    = $request->update_company_user_id;
        self::$company_ticket_assign->ticket_id                 = $request->ticket_id;
        self::$company_ticket_assign->assign_user_id            = $request->assign_user_id;
        self::$company_ticket_assign->work_role                 = $request->work_role;
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function assignCompanyUser()
    {
        return $this->belongsTo(CompanyUser::class, 'assign_user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_user_id');
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
        return $this->belongsTo(CompanyUser::class, 'update_company_user_id');
    }
}
